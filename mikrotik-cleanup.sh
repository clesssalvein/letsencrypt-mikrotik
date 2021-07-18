#!/bin/bash

# vars
mikrotikAddr=$1
mikrotikUser=$2
mikrotikPass=$3
TXT_SUBDOMAIN=$4
TXT_DOMAIN=$5

# delete dns entry at mikrotik dns server
./mikrotik-del-dns-entry.php "$mikrotikAddr" "$mikrotikUser" "$mikrotikPass" "$TXT_SUBDOMAIN" "$TXT_DOMAIN"
