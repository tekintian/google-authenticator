Google Authenticator + base64 qrcode PHP class
==============================

谷歌的两步验证PHP服务端，Google身份验证器 Google Authenticator PHP实现，自带二维码生成类库， 再也不用担心服务端密码泄露问题了！

PS: 本工具为安全类工具，$secret 为本工具安全的基础， 如果$secret 泄露，则本工具失去安全的意义！ 网上其他类似工具使用的第三方API生成二维码的方式是极不安全的！！！

https://github.com/tekintian/google-authenticator

This PHP class can be used to interact with the Google Authenticator mobile app for 2-factor-authentication. This class
can generate secrets, generate codes, validate codes and present a QR-Code for scanning the secret. It implements TOTP 
according to [RFC6238](https://tools.ietf.org/html/rfc6238)

For a secure installation you have to make sure that used codes cannot be reused (replay-attack). You also need to
limit the number of verifications, to fight against brute-force attacks. For example you could limit the amount of
verifications to 10 tries within 10 minutes for one IP address (or IPv6 block). It depends on your environment.

Usage:
------

- install dependency with composer
~~~sh
composer require tekintian/google-authenticator
~~~

- usage example:

~~~php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$ga = new \tekintian\GoogleAuthenticator()
$secret = $ga->createSecret();
echo "Secret is: ".$secret."\n\n";

$qr = $ga->getQRCode('Tekin', $secret);
echo "Default return the base64 QR-Code img: ".$qr."\n\n";

$oneCode = $ga->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret':\n";

# $checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance  可以有1分钟的时间误差
$checkResult = $ga->verifyCode($secret, $oneCode, 0);    // 不允许有时间误差
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}
~~~



Google Authenticator Android App 谷歌省份验证器安卓版下载

https://github.com/tekintian/google-authenticator/releases/download/app/com.google.android.apps.authenticator2.apk



## base64 img qrcode

~~~html
<img src="data:png;base64,iVBORw0KGgoAAA.......rkJggg==" alt="">

~~~

ps: 本工具类部分算法参考了 https://github.com/PHPGangsta/GoogleAuthenticator 在此表示感谢！


