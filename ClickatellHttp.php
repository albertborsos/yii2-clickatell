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

    public $from;
    public $mo = 0;

    protected $_extra = [];

    public function init()
    {
        parent::init();
        $this->_api = new \Clickatell\Api\ClickatellHttp($this->username, $this->password, $this->apiID);
        $this->_api->secure($this->secure);
        $this->setExtraParameters();
    }

    /**
     * API call for "sendMessage".
     *
     * Response format:
     *      id      => string|false
     *      to      => string
     *      error   => string|false
     *      code    => string|false
     *
     * @param array   $to       The recipient list
     * @param string  $message  Message
     * @param array   $extra    Extra parameters (based on Clickatell documents)
     *
     * @return array
     */
    public function sendMessage($to, $message, $extra = []){
        $extra = array_merge($this->_extra, $extra);
        return $this->_api->sendMessage($to, $message, $extra);
    }

    private function setExtraParameters(){
        if(!is_null($this->from)){
            $this->_extra['from'] = $this->from;
        }
        if(!is_null($this->mo)){
            $this->_extra['mo'] = $this->mo;
        }
    }

}