<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-EN">
<head>
<title>Kubisys API</title>
<link href="css/api.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/api.js"></script>
</head>
<body>
<div id="nav">
    <div class="navsection">
        <p><a href="#domains">Domains</a></p>
        <div class="navsubsection">
            <p><a href="#domain-obj">Domain object</a></p>
            <p><a href="#create-domain">Create domain</a><p>
            <p><a href="#read-domain">Read domain</a></p>
            <p><a href="#update-domain">Update domain</a></p>
            <p><a href="#discover-domain">Discover domain</a></p>
            <p><a href="#list-domains">List domains</a></p>
            <p><a href="#list-domain-servers">List domain servers</a></p>
            <p><a href="#delete-domain">Delete domain</a></p>
        </div>
    </div>
</div>
<div id="content">
    <div class="section">
        <div class="main">
            <h1 id="domains">Domains</h1>
            <p>Domains are blah blah blah</p>
        </div>
        <div class="side">
        </div>
    </div>
    <div class="section">
        <div class="main">
            <h2 id="domain-obj">Domain object</h2>
<?php
$table = array(array("name" => "id",
                     "text" => "ID of the domain object. Automatically generated when created.",
                     "type" => array("unique" => 1, "type" => "int")),
               array("name" => "name",
                     "text" => "Fully qualified domain name.",
                     "type" => array("unique" => 1, "type" => "string")),
               array("name" => "dc_ip",
                     "text" => "IP of a domain controller on the domain (preferably the primary DC). This IP will be sent an LDAP query when the domain is discovered.",
                     "type" => array("type" => "string")),
               array("name" => "filter",
                     "text" => "Filter that is applied to the LDAP query when the domain is discovered.",
                     "type" => array("type" => "string")),
               array("name" => "ldap_credential",
                     "text" => "Credential object that is applied to LDAP queries",
                     "type" => array("custom" => "credential-obj", "type" => "credential object")),
               array("name" => "winexe_credential",
                     "text" => "Credential object that is applied to servers in this domain for remote executions.",
                     "type" => array("custom" => "credential-obj", "type" => "credential object")),
               array("name" => "smb_credential",
                     "text" => "Credential object that is applied to servers in this domain for SMB connections.",
                     "type" => array("custom" => "credential-obj", "type" => "credential object")),
               array("name" => "discovered_at",
                     "text" => "When the domain was last discovered. <span>null</span> if never discovered.",
                     "type" => array("type" => "timestamp")),
               array("name" => "created_at",
                     "text" => "When the domain was created.",
                     "type" => array("type" => "timestamp")),
               array("name" => "updated_at",
                     "text" => "When the domain was last modified.",
                     "type" => array("type" => "timestamp")));
attribute_table($table);
?>
        </div>
        <div class="side">
            <h3>Example response</h3>
            <div class="code-json">
{
    "id": 1234,
    "name": "kubisyslab.local",
    "dc_ip": "172.16.0.7",
    "filter": "",
    "ldap_credential": {
        "id": 2345,
        "domain": "kubisyslab",
        "username": "svckubisys"
    },
    "winexe_credential": {
        "id": 2345,
        "domain": "kubisyslab",
        "username": "svckubisys"
    },
    "smb_credential": {
        "id": 2345,
        "domain": "kubisyslab",
        "username": "svckubisys"
    },
    "discovered_at": null,
    "created_at": 1442346381,
    "updated_at": 1442346381
}
            </div>
        </div>
    </div>
    <div class="section">
        <div class="main">
            <h2 id="create-domain">Create domain</h2>
            <p>Creating a domain is blah blah blah</p>
<?php
$table = array(array("name" => "name",
                     "text" => "Fully qualified domain name. Returns an error if a domain with the name provided already exists.",
                     "type" => array("required" => 1, "type" => "string")),
               array("name" => "dc_ip",
                     "text" => "IP of a domain controller on the domain. Returns an error if the IP is formatted incorrectly.",
                     "type" => array("required" => 1, "type" => "string")),
               array("name" => "ldap_credential",
                     "text" => "ID of the credential object that will be applied to LDAP queries. Returns an error if the ID doesn't exist.",
                     "type" => array("required" => 1, "type" => "int")),
               array("name" => "winexe_credential",
                     "text" => "ID of the credential object that will be applied to servers in this domain for remote executions. Returns an error if the ID doesn't exist.",
                     "type" => array("required" => 1, "type" => "int")),
               array("name" => "smb_credential",
                     "text" => "ID of the credential object that will be applied to servers in this domain for SMB connections. Returns an error if the ID doesn't exist.",
                     "type" => array("required" => 1, "type" => "int")),
               array("name" => "filter",
                     "text" => "Filter that will be applied to the LDAP query when the domain is discovered.<br/><br/>Default: <span>\"\"</span>",
                     "type" => array("optional" => 1, "type" => "string")));
attribute_table($table);
?>
            <h3>Returns</h3>
            <p>Returns the new domain object if the creation was successful. Returns an error otherwise.<p>
        </div>
        <div class="side">
            <h3>Definition</h3>
            <div class="code"><span class="json-key">POST</span> http://<span class="json-token">kubisys_ip</span>/api/domains</div>
            <h3>Example request</h3>
            <div class="code-json">
{
    "name": "acme.com",
    "dc_ip": "172.16.99.9",
    "ldap_credential": 23,
    "winexe_credential": 24,
    "smb_credential": 25,
    "filter": ""
}
            </div>
            <h3>Example response</h3>
            <div class="code-json">
{
    "id": 55,
    "name": "acme.com",
    "dc_ip": "172.16.99.9",
    "filter": "",
    "ldap_credential": {
        "id": 23,
        "domain": "acme",
        "username": "svc_ldap"
    },
    "winexe_credential": {
        "id": 24,
        "domain": "acme",
        "username": "svc_winexe"
    },
    "smb_credential": {
        "id": 25,
        "domain": "acme",
        "username": "svc_smb"
    },
    "discovered_at": null,
    "created_at": 1442346381,
    "updated_at": 1442346381
}
            </div>
        </div>
    </div>
    <div class="section">
        <div class="main">
            <h2 id="read-domain">Read domain</h2>
            <p>Reading a domain is blah blah blah</p>
<?php
$table = array(array("name" => "id",
                     "text" => "ID of the domain object. This argument is passed via the URL.",
                     "type" => array("required" => 1, "type" => "int")));
attribute_table($table);
?>
            <h3>Returns</h3>
            <p>Returns the domain object associated with the provided ID.</p>
        </div>
        <div class="side">
            <h3>Definition</h3>
            <div class="code"><span class="json-key">GET</span> http://<span class="json-token">kubisys_ip</span>/api/domains/<span class="json-token">domain.id</span></div>
            <h3>Example request</h3>
            <div class="code"><span class="json-key">GET</span> http://<span class="json-token">kubisys_ip</span>/api/domains/23</div>
            <h3>Example response</h3>
            <div class="code-json">
{
    "id": 23,
    "name": "acme.com",
    "dc_ip": "172.16.99.9",
    "filter": "",
    "ldap_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "winexe_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "smb_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "discovered_at": null,
    "created_at": 1442346381,
    "updated_at": 1442346381
}
            </div>
        </div>
    </div>
    <div class="section">
        <div class="main">
        <h2 id="update-domain">Update domain</h2>
        <p>Updating a domain is blah blah blah</p>
<?php
$table = array(array("name" => "id",
                     "text" => "ID of the domain object. This argument is passed via the URL.",
                     "type" => array("required" => 1, "type" => "int")),
               array("name" => "name",
                     "text" => "Fully qualified domain name. Returns an error if a domain with the name provided already exists.",
                     "type" => array("optional" => 1, "type" => "string")),
               array("name" => "dc_ip",
                     "text" => "IP of a domain controller on the domain. Returns an error if the IP is formatted incorrectly.",
                     "type" => array("optional" => 1, "type" => "string")),
               array("name" => "ldap_credential",
                     "text" => "ID of the credential object that will be applied to LDAP queries. Returns an error if the ID doesn't exist.",
                     "type" => array("optional" => 1, "type" => "int")),
               array("name" => "winexe_credential",
                     "text" => "ID of the credential object that will be applied to servers in this domain for remote executions. Returns an error if the ID doesn't exist.",
                     "type" => array("optional" => 1, "type" => "int")),
               array("name" => "smb_credential",
                     "text" => "ID of the credential object that will be applied to servers in this domain for SMB connections. Returns an error if the ID doesn't exist.",
                     "type" => array("optional" => 1, "type" => "int")),
               array("name" => "filter",
                     "text" => "Filter that will be applied to the LDAP query when the domain is discovered.",
                     "type" => array("optional" => 1, "type" => "string")));
attribute_table($table);
?>
        <h3>Returns</h3>
        <p>Returns the modified domain object if the update was successful. Returns an error otherwise.
        </div>
        <div class="side">
            <h3>Definition</h3>
            <div class="code"><span class="json-key">POST</span> http://<span class="json-token">kubisys_ip</span>/api/domains/<span class="json-token">domain.id</span></div>
            <h3>Example request</h3>
            <div class="code"><span class="json-key">POST</span> http://<span class="json-token">kubisys_ip</span>/api/domains/23</div>
            <div class="code-json">
{
    "name": "acme2.com",
    "dc_ip": "172.16.77.7",
    "ldap_credential": 23
}
            </div>
            <h3>Example response</h3>
            <div class="code-json">
{
    "id": 23,
    "name": "acme2.com",
    "dc_ip": "172.16.77.7",
    "filter": "",
    "ldap_credential": {
        "id": 23,
        "domain": "acme",
        "username": "svc_ldap"
    },
    "winexe_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "smb_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "discovered_at": null,
    "created_at": 1442346381,
    "updated_at": 1442399999
}
            </div>
        </div>
    </div>
    <div class="section">
        <div class="main">
            <h2 id="discover-domain">Discover domain</h2>
            <p>Discovering a domain is blah blah blah</p>
<?php
$table = array(array("name" => "id",
                     "text" => "ID of the domain object. This argument is passed via the URL.",
                     "type" => array("required" => 1, "type" => "int")));
attribute_table($table);
?>
            <h3>Returns</h3>
            <p>Returns the domain object associated with the ID provided if the discover process was successful. Returns an error otherwise.<p>
        </div>
        <div class="side">
            <h3>Definition</h3>
            <div class="code"><span class="json-key">POST</span> http://<span class="json-token">kubisys_ip</span>/api/domains/<span class="json-token">domain.id</span>/discover</div>
            <h3>Example request</h3>
            <div class="code"><span class="json-key">POST</span> http://<span class="json-token">kubisys_ip</span>/api/domains/23/discover</div>
            <h3>Example response</h3>
            <div class="code-json">
{
    "id": 23,
    "name": "acme.com",
    "dc_ip": "172.16.99.9",
    "filter": "",
    "ldap_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "winexe_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "smb_credential": {
        "id": 12,
        "domain": "acme",
        "username": "svc_acme"
    },
    "discovered_at": 1442399999,
    "created_at": 1442346381,
    "updated_at": 1442346381
}
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

function attribute_table($table) {
?>
<table class="attr-list">
    <tbody>
<?php
    foreach ($table as $item) {
        $type = markup_attr_type($item['type']);
?>
        <tr>
            <td class="attr-name"><?= $item['name'] ?></td>
            <td rowspan="2" class="attr-def"><?= $item['text'] ?></td>
        </tr>
        <tr>
            <td class="attr-type"><?= $type ?></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<?php
}

function markup_attr_type($attr) {
    $ret = "";
    if (@$attr['unique']) $ret .= "<b>UNIQUE</b> ";
    if (@$attr['required']) $ret .= "<b>REQUIRED</b> ";
    if (@$attr['optional']) $ret .= "optional ";
    if (@$attr['custom']) {
        $ret .= "<a href='#" . $attr['custom'] . "'>" . $attr['type'] . "</a>";
    } else {
        $ret .= "<span>" . $attr['type'] . "</span>";
    }
    return $ret;
}

?>
