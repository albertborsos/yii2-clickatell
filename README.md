Yii2 - Clickatell
========================

Yii2 extension implements Clickatell SMS sender

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist albertborsos/yii2-clickatell "*"
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
        'class' => 'albertborsos\clickatell\Clickatell',
        'username' => 'your clickatell user',
        'password' => 'your clickatell password',
        'apiId' => 'your clickatell api id',
    ),
    ...
);
```
Then:
```php
Yii::$app->clickatell->send([
	'to'=>'+36xxxxxxxxx',
	'message'=>'Hello world!',
]);
```
