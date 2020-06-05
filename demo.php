<?php

/**
 * @Author: tekin
 * @Date:   2020-06-05 16:06:58
 * @Last Modified 2020-06-05
 * @Last Modified time: 2020-06-05 23:09:59
 */
require_once __DIR__ . '/vendor/autoload.php';

include_once __DIR__ . '/test_helper.php';

$ga = new tekintian\GoogleAuthenticator();

// just for test
$name = "13888011868";
$secret = "WTMIIMMA3QGYLZ7E";
// $secret = $ga->createSecret();

$title = "云南网";

// return the base64 qrcode img, just with  <img src="" alt="">
$qr = $ga->getQRCode($name, $secret, $title);

// direct show the qrcode img
// $qr = $ga->getQRCode($name, $secret, $title, 0);

pp($qr);
