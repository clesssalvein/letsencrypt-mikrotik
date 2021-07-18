#!/bin/bash

#####
#
#  It's necessary to install:
#
#  yum install -y certbot php
#
#####

# vars
mikrotikAddr="test.domain123.ru" # mikrotik dns server HOSTNAME or IP
mikrotikUser="admin" # mikrotik user with full rights
mikrotikPass="P@ssWord#1" # mikrotik user's pass
domain="test.domain123.ru" # domain for cert create
subdomain="_acme-challenge" # subdomain "_acme-challenge", don't change it
letsencryptServer="https://acme-v02.api.letsencrypt.org/directory" # letsencrypt server url
email="clesssalvein@gmail.com" # email for notifies

# certbot run
certbot certonly --manual --preferred-challenges=dns --manual-auth-hook "./mikrotik-auth.sh $mikrotikAddr $mikrotikUser $mikrotikPass $subdomain $domain" \
    --manual-cleanup-hook "./mikrotik-cleanup.sh $mikrotikAddr $mikrotikUser $mikrotikPass $subdomain $domain" -d *.$domain -d $domain --email=$email \
    --server $letsencryptServer --agree-tos --non-interactive --manual-public-ip-logging-ok --force-renewal #--dry-run
