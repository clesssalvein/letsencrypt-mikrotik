#!/bin/bash

# vars
mikrotikAddr=$1
mikrotikUser=$2
mikrotikPass=$3
TXT_SUBDOMAIN=$4
TXT_DOMAIN=$5

# add dns entry at mikrotik dns server
./mikrotik-add-dns-entry.php "$mikrotikAddr" "$mikrotikUser" "$mikrotikPass" "$TXT_SUBDOMAIN" "$TXT_DOMAIN" "$CERTBOT_VALIDATION"

# wait for dns entry create
sleep 16
