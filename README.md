Yii2 - Clickatell
========================

Yii2 extension implements Clickatell SMS sender

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist "albertborsos/yii2-clickatell:0.4.*"
```

or add

```
"albertborsos/yii2-clickatell": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  in config:
```php
'components' => array(
    ...
    'clickatell' => array(
        'class' => 'albertborsos\clickatell\ClickatellHttp',
        'username' => 'your clickatell user',
        'password' => 'your clickatell password',
        'apiId' => 'your clickatell api id',
        'from' => '+36xxxxxxxx' // optional parameter,
        'mo' => 1 // optional parameter
    ),
    ...
);
```
Then:
```php
Yii::$app->clickatell->sendMessage('+36xxxxxxxxx', 'Hello world!');
```
