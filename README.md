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
~~

- example:

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


## base64 img qrcode
~~~html
<img src="data:png;base64,iVBORw0KGgoAAAANSUhEUgAAAk4AAAJOAQMAAAB7lxq2AAAABlBMVEX///8AAABVwtN+AAAACXBI
WXMAAA7EAAAOxAGVKw4bAAAFI0lEQVR4nO2aQY7kOgxDBdQBcqS6eo7kAxSg37FISa6ZP8DsbAy9
CJLYfqlFM6SUNtPQ+HfG2zHm2c/h89x9/ZyP5+TCvZ/LF85ue8XieYYxhBLqANTc8czObXY92x7e
e2AHVDFenP058/siFLNCCXUCaooEKEroY1hCRVFHmACPEhJKqMNQ7+Td82DQBwFzL0YTjlBCHYia
OyL2XDhglmLCvTARE0qo81AWqoBmpgdE0jdGIftykspDf8hXQgm1H8qd0kiv+JsDhlBCHYBax7yH
13/uMKtttInSzP8NoYTaEPWscwQbLvZmDiGrLIexJETHAqHMRiih9kXlIfLQfaF7ieL2SmirDX5z
z4QS6gCUc/ZNXcASxqt/irrZ9+l5qNQjlFBHoDw6O4xCqSN+sqpDf25S5i+4hRLqBNQM+TPxhFKY
jEILI72CmgkJtTHqFwgl1N6o52oCcOAEAJ+mD6uBJavehBJqd9T0APJ8VB1ARd2M+/QPz++1UziJ
F0qo3VEz/de6j9Usd+S2DEV5iVmhhDoAZVcXDqreYXGvZX5bxASHuLJOHkIJdQDKXtzb2jb8PDXV
4/xGVeHpG3CbUEKdgIJIvsyBAJS5tQ5LJm8+nBYjlFAnoHq0tz7oJHhQoNuS8Ioeo4QSamdUhSIW
slXNQhp0A5hDqAxOUnWyUELtjnrnwaq4ZVCqEgB7mfnR94mf8UnXEEqovVHOvfm+r6YOS9oPC4Qp
MMPXKqal3roXSqidUYMFb/3xv0sz9mp7HV9u62B8pAkl1AmoeVmNy6WJ/yyp2NMvQ0IWT1vMRiih
tkV5WQKLgZlzngGH8LSEqxsGq4RFdEIJtTMqx6AgnBEHJuLesk93DT6XwhFKqL1RDEWxDg17ymVK
w5iCUAKwJm4+I5RQR6BCKamKq4I/ZuNp89LYzylZIVWZUEKdgEJTxxB7GICC4nSIWnynmFJvQgl1
BMry9e+Jyv59dOjnuG0tc5dQFFChhNoc9VDwZ7+06ZcOUO9oNteIs8u7pwgl1N4obmMyStQcdW/x
j6UOMKGEOgCV6aaUwjd/R2FHfpSa/nFflZGEEuoAVGX+8etHKR/GRo8BtZCfqVYOCyXU5qjUgjHa
R7vy67tVOET++5lnG6iJSSihNke5172elgZ3QDjpGk6pWXY+fQgl1AGo1IyPtZ9zeVpHFrxNWzx4
iEkooQ5ALaEIbU16AL1iJv2PwSZm5qeTmC0aFEqorVH4u0flemFxqYKVcG/vsNblYqGEOgiFAARf
yNmsa601Lq9q6lQxIJRQ+6O+k36+/gt6U1ux907riIdnKBJKqN1RFYCsPABBqbuBZZVg5Sk4QDhC
CbU3KpZ4vfmzYc/+PcoChiI+l7y3Y5tQQh2BuqmZpgUfZQnOcnhQYLaUBdXMFEqojVFQBTzAM+fQ
ISiNZicsEKrBGUMooXZHDcyimo3FH9YGi8Davf5bUC8IJdT2KAqHffmqZv2XT1HYlk2dSP/ISEIJ
tTsK4xXCASUlFA9y1gYg0zV8mRVKqENQZkCVV1idwTriQTehS1kglFD7o5o0GO3bxM269rcAHNY2
kFBC7YsqS4iwQ16meus6Mls6+bVEKKFOQKGGbWcYaNPHyDzEgrci0/qFVyihDkDZ2qZvTfy2uFqY
L2/17y2UUEehqiv5jPo3g8hDzlnEozKW8hShhNodNXdSONmfJH4ZUx/Z2G8t/tuEEuoAFJdRJL2G
pXpmT5/r3u65JHPTEEqo/VEaGv/K+A+l0DDqUefrwgAAAABJRU5ErkJggg==" alt="">

~~~

ps: 本工具类部分算法参考了 https://github.com/PHPGangsta/GoogleAuthenticator 在此表示感谢！


