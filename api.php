<?php
require 'api_functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Kubisys API</title>
    <link href="css/api.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.11.1.min.js" type="application/javascript"></script>
    <script src="js/api.js" type="application/javascript"></script>
</head>
<body>
<div id="nav">
    <div class="navsection"><!-- Placeholder --></div>
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
                <summary class="spec">
#id int unique
    ID of the domain object. Automatically generated when created.

#name string unique
    Fully qualified domain name.

#dc_ip string
    IP of a domain controller on the domain (preferably the primary DC).
    This IP will be sent an LDAP query when the domain is discovered.

#filter string
    Filter that is applied to the LDAP query when the domain is discovered.

#ldap_credential credential
    Credential object that is applied to LDAP queries

#winexe_credential credential
    Credential object that is applied to servers in this domain for remote executions.

#smb_credential credential
    Credential object that is applied to servers in this domain for SMB connections.

#discovered_at timestamp
    When the domain was last successfully discovered. `null` if never successfully discovered.

#created_at timestamp
    When the domain was created.

#updated_at timestamp
    When the domain was last modified.
                </summary>
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
            <h2 id="list-domain">List domains</h2>
            <p>Listing a domain is blah blah blah</p>
            <h3>Returns</h3>
            <p>TODO</p>
        </div>
        <div class="side">
        </div>
    </div>
    <div class="section">
        <div class="main">
            <h2 id="create-domain">Create domain</h2>
            <p>Creating a domain is blah blah blah</p>
                <summary class="spec">
#name string required
    Fully qualified domain name. Returns an error if a domain with the name provided already exists.

#dc_ip string required
    IP of a domain controller on the domain. Returns an error if the IP is formatted incorrectly.

#ldap_credential int required
    ID of the credential object that will be applied to LDAP queries. Returns an error if the ID doesn't exist.

#winexe_credential int required
    ID of the credential object that will be applied to servers in this domain for remote executions. Returns an error if the ID doesn't exist.

#smb_credential int required
    ID of the credential object that will be applied to servers in this domain for SMB connections. Returns an error if the ID doesn't exist.

#filter string optional
    Filter that will be applied to the LDAP query when the domain is discovered.


    Default: `""`
                </summary>
            <h3>Returns</h3>
            <p>Returns the new domain object if the creation was successful. Returns an error otherwise.</p>
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
                <summary class="spec">
#id int required
    ID of the domain object. This argument is passed via the URL.
                </summary>
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
            <summary class="spec">
#id int required
    ID of the domain object. This argument is passed via the URL.

#name string optional
    Fully qualified domain name. Returns an error if a domain with the name provided already exists.

#dc_ip string optional
    IP of a domain controller on the domain. Returns an error if the IP is formatted incorrectly.

#ldap_credential int optional
    ID of the credential object that will be applied to LDAP queries. Returns an error if the ID doesn't exist.

#winexe_credential int optional
    ID of the credential object that will be applied to servers in this domain for remote executions. Returns an error if the ID doesn't exist.

#smb_credential int optional
    ID of the credential object that will be applied to servers in this domain for SMB connections. Returns an error if the ID doesn't exist.

#filter string optional
    Filter that will be applied to the LDAP query when the domain is discovered.
            </summary>

        <h3>Returns</h3>
        <p>Returns the modified domain object if the update was successful. Returns an error otherwise.</p>
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
            <h2 id="delete-domain">Delete domain</h2>
            <p>Deleting a domain is blah blah blah</p>
            <h3>Returns</h3>
            <p>TODO</p>
        </div>
        <div class="side">
        </div>
    </div>
    <div class="section">
        <div class="main">
            <h2 id="discover-domain">Discover domain</h2>
            <p>Discovering a domain is blah blah blah</p>
                <summary class="spec">
#id int required
    ID of the domain object. This argument is passed via the URL.
                </summary>
            <h3>Returns</h3>
            <p>Returns the domain object associated with the ID provided if the discover process was successful. Returns an error otherwise.</p>
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
    <div class="section">
        <div class="main">
            <h2 id="list-domain-servers">List domain servers</h2>
            <p>Listing domain servers is blah blah blah</p>
            <h3>Returns</h3>
            <p>TODO</p>
        </div>
        <div class="side">
        </div>
    </div>
</div>
</body>
</html>

