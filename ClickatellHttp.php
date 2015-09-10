<?php

namespace albertborsos\clickatell;

use yii\base\Component;
use yii\helpers\ArrayHelper;

class ClickatellHttp extends Component
{

    public $username;
    public $password;
    public $apiID;

    public $secure = false;

    /** @var \Clickatell\Api\ClickatellHttp */
    private $_api;

    public $to;
    public $message;

    public $extra = [];

    public function init()
    {
        parent::init();
        $this->_api = new \Clickatell\Api\ClickatellHttp($this->username, $this->password, $this->apiID);
        $this->_api->secure($this->secure);
    }

    public function sendMessage($to, $message, $extra){
        return $this->_api->sendMessage($to, $message, $extra);
    }

}