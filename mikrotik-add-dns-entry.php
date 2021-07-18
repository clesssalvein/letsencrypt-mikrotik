#!/usr/bin/php
<?php

# vars
$mikrotikAddr = $argv[1];
$mikrotikUser = $argv[2];
$mikrotikPass = $argv[3];
$subdomain = $argv[4];
$domain = $argv[5];
$dnsEntryName = $subdomain . "." . $domain;
$dnsEntryType = "TXT";
$dnsEntryText = $argv[6];
$dnsEntryTtl = "1m";

# api class
require './routeros_api.class.php';

# connect
$API = new RouterosAPI();
if ($API->connect($mikrotikAddr, $mikrotikUser, $mikrotikPass)) {

    # get all current entries
    $API->write('/ip/dns/static/print');
    $ips = $API->read();

    # add dns static entry
    $API->comm("/ip/dns/static/add", array("name" => $dnsEntryName, "type" => $dnsEntryType, "text" => $dnsEntryText, "ttl" => $dnsEntryTtl));

    $API->write('/ip/dns/static/print');
    $ips = $API->read();

    # debug
#    var_dump($ips);

    $API->disconnect();
}