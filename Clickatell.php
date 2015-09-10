<?php

namespace albertborsos\clickatell;

use yii\base\Component;

class Clickatell extends Component
{

    public $username;
    public $password;
    public $apiId;

    const MODE_HTTP = 'http';
    const MODE_REST = 'rest';

    public $method = self::MODE_HTTP;

}