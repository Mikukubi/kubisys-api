$(function() {
    $(".code-json").each(function() {
        var json = $.parseJSON($(this).text());
        var html = markup_json(json, "");
        $(this).html(html);
    });

    $(".section").each(function() {
        var main = $(this).children(".main");
        var side = $(this).children(".side");
        if (main.height() < side.height()) {
            main.height(side.height());
        }
    });

    function markup_json(obj, ind) {
        var ret = "";
        var new_ind = ind + "&nbsp; ";
        if ($.isArray(obj)) {
            ret += "[<br/>\n";
            for (var i=0; i<obj.length; i++) {
                if (typeof obj[i] == "string") {
                    ret += new_ind + "\"" + obj[i] + "\"";
                } else if (obj[i] === null) {
                    ret += new_ind + "<span class='json-token'>null</span>";
                } else if (typeof obj[i] == "object") {
                    ret += new_ind + markup_json(obj[i], new_ind);
                } else {
                    ret += new_ind + "<span class='json-token'>" + obj[i] + "</span>";
                }
                ret += (i < obj.length-1) ? ",<br/>\n" : "<br/>\n";
            }
            ret += ind + "]";
        } else {
            ret += "{<br/>\n";
            var keys = [];
            for (var k in obj) keys.push(k);
            for (var i=0; i<keys.length; i++) {
                ret += new_ind + "<span class='json-key'>\"" + keys[i] + "\"</span>: ";
                if (typeof obj[keys[i]] == "string") {
                    ret += "\"" + obj[keys[i]] + "\"";
                } else if (obj[keys[i]] === null) {
                    ret += "<span class='json-token'>null</span>";
                } else if (typeof obj[keys[i]] == "object") {
                    ret += markup_json(obj[keys[i]], new_ind);
                } else {
                    ret += "<span class='json-token'>" + obj[keys[i]] + "</span>";
                }
                ret += (i < keys.length-1) ? ",<br/>\n" : "<br/>\n";
            }
            ret += ind + "}";
        }
        return ret;
    }
});
