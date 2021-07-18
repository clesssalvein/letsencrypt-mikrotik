#!/usr/bin/php
<?php

# vars
$mikrotikAddr = $argv[1];
$mikrotikUser = $argv[2];
$mikrotikPass = $argv[3];
$subdomain = $argv[4];
$domain = $argv[5];
$dnsEntryName = $subdomain . "." . $domain;

# api class
require './routeros_api.class.php';

# connect
$API = new RouterosAPI();
if ($API->connect($mikrotikAddr, $mikrotikUser, $mikrotikPass)) {

    # get all current entries
    $API->write('/ip/dns/static/print');
    $ips = $API->read();

    # remove dns static entry with domain name
    foreach ($ips as $cell) {

        $entryName=$cell['name'];

        if ($entryName == $dnsEntryName)
        {
            $entryText=$cell['text'];
            $entryId=$cell['.id'];

            # debug
            #echo $entryName;
            #echo $entryText;
            #echo $entryId;

            $API->write('/ip/dns/static/remove', false);
            $API->write('=.id=' . $entryId);
            $ips = $API->read();
        }
    }

    # debug
#    var_dump($ips);

    $API->disconnect();
}