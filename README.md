## **About**

Script for automatically get "Let's Encrypt" wildcard domain certificate at CentOS, using delegated NS server at mikrotik host with RouterOS

## **Requirements**

* Host with RouterOS version >= 45 as DNS server (with API enabled)
* Domain for which we want get wildcard letsencrypt certificate **(!!! Domain's name servers (NS) should be delegated to DNS server at RouterOS host, you must have Full access to this RouterOS host !!!)**
* At RouterOS DNS service there must be A record containing domain, for which we need to get certificate
* CentOS 7
* PHP >= 5.4.16
* certbot >= 1.11.0

## **Installation**

```
yum install -y git certbot php
```
```
cd /opt/
```
```
git clone https://github.com/clesssalvein/letsencrypt-mikrotik.git
```

## **Usage**
* Edit variables in "start.sh"
* Run ```./start.sh```

## **How it works**
* "start.sh" contains variables and starts certbot with auth script "mikrotik-auth.sh" and postscript "mikrotik-cleanup.sh"
* "mikrotik-auth.sh" starts "mikrotik-add-dns-entry.php", which put to mikrotik dns server TXT entry with certbot validation string
* certbot validates text string
* after successfull validation certbot generates a certificate and dowbloads it to the local directory /etc/letsencrypt
* "mikrotik-cleanup.sh" starts "mikrotik-del-dns-entry.php", which delete TXT entry with certbot validation string at mikrotik dns server
