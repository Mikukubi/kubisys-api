<?php
error_reporting(E_ALL);

$internal_data_types = array('int', 'string', 'timestamp', 'datetime', 'float');

##
# Build labels for special strictions
function generate_type($attr) {
    global $internal_data_types;
    $ret = '';
    $attrs = explode(' ', trim($attr));
    $data_type = array_shift($attrs);
    if (in_array('unique', $attrs)) $ret .= '<b>UNIQUE</b> ';
    if (in_array('required', $attrs)) $ret .= '<b>REQUIRED</b> ';
    if (in_array('optional', $attrs)) $ret .= 'optional ';
    if (in_array($data_type, $internal_data_types)) {
        $ret .= "<span>" . $data_type . "</span>";
    } else {
        $ret .= '<a href="#' . $data_type . '-obj">' . $data_type . '</a>';
    }
    return $ret;
}

##
#
function cleanup_def($def) {
    # Split by lines
    $lines = explode("\n", trim($def));
    $lines = array_map(function ($l) {
        $l = trim($l);
        if (empty($l)) return '<br />';
        $l = preg_replace("!`([^`]+)`!", "<span>$1</span>", $l);
        return $l;
    }, $lines);
    return join(' ', $lines);
}

##
# Build attribute table
function generate_table($buffer) {
    $rows = preg_split('!\n\s*(#)(\w+)\s*(.*)!', $buffer, 0, PREG_SPLIT_DELIM_CAPTURE);
    $rowstring = array();
    $row = array();
    while (count($rows) > 0) {
        $capture = array_shift($rows);
        if ($capture == '#') {
            $rowstring[] = generate_row($row);
            $row = array();
        }
        else
            $row[] = $capture;
    }
    $rowstring[] = generate_row($row);
    return '<table class="attr-list"><tbody>' . join('', $rowstring) . '</tbody></table>';
}

##
# Build table row
function generate_row($row) {
    if (count($row) < 2)
        return '';
    list($name, $attr, $def) = $row;
    $def = cleanup_def($def);
    $type = generate_type($attr);
    return <<<EOT
    <tr>
        <td class="attr-name">$name</td>
        <td rowspan="2" class="attr-def">$def</td>
    </tr>
    <tr>
        <td class="attr-type">${type}</td>
    </tr>
EOT;
}

##
# Generate TOC from h1 and h2 tags
function generate_toc($buffer) {
    $last_level = 1;
    preg_match_all('!<h(1|2)[^>]+id="([^"]+)"[^>]*>(.+)</h.>!', $buffer, $matches, PREG_SET_ORDER);
    $s = array('');
    foreach ($matches as $match) {
        $level = intval($match[1]);
        $link = $match[2];
        $title = $match[3];
        if ($level > $last_level)
            $s[] = '<div class="navsubsection">';
        elseif ($level < $last_level)
            $s[] = '</div>';
        
        $s[] = "<p><a href=\"#${link}\">${title}</a></p>";
        $last_level = $level;
    }
    while (--$last_level) {
        $s[] = '</div>';
    }
    $s[] = '';
    return join(PHP_EOL, $s);
}

##
# Parse web page, pick JSONs out, and do some fancy stuff
function html_filter($buffer) {
    $new_buffer = preg_replace_callback(
        '!<summary class="spec">(.*?)</summary>!s',
        function ($matches) {
            return generate_table($matches[1]);
        },
        $buffer
    );
    $new_buffer = preg_replace_callback(
        '!<div class="navsection">(.*?)</div>!s',
        function ($matches) use ($new_buffer) {
            return '<div class="navsection">' . generate_toc($new_buffer) . '</div>';
        },
        $new_buffer
    );

    return $new_buffer;
}

ob_start('html_filter');
