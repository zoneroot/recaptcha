Recaptcha
====
Simple recaptcha static php class.


Installation
-------
With composer :
```
"zoneroot/recaptcha": "master"
```


Usage
==
First you need to init the recaptcha with your keys :
```php
use \zoneroot\recaptcha\recaptcha;
recaptcha::init("public key", "private key");
```
Then in your head tag insert :
```php
<?php echo recaptcha::script() ?>
```
Next in your form tag insert :
```php
<?php echo recaptcha::html() ?>
```
Finally you must check if the captcha is valid :
```php
try {
	recaptcha::check()
	echo "Captcha is valid";
} 
catch (\zoneroot\recaptcha\exceptions\invalidRecaptchaException $e) {
	echo $e->getMessage();
}
catch (\zoneroot\recaptcha\exceptions\connectionException $e) {
	echo $e->getMessage();
}
```


Contributing
--------
For contributing just follow the code style.


Todo
---
>Add some comment



####Inspired by [grafikart](http://www.grafikart.fr/tutoriels/php/recaptcha-anti-spam-346)