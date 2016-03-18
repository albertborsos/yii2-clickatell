<?php

namespace albertborsos\clickatell;

use \Exception;
use Clickatell\TransportInterface;
use yii\base\Component;

class ClickatellHttp extends Component implements TransportInterface
{

    public $username;
    public $password;
    public $apiID;

    /** @var boolean Whether to use https */
    public $secure = false;

    /** @var string your US Longcode number; i.e. your two-way number */
    public $from;

    /** @var integer MO is an abbreviation for "Mobile Originated", meaning a message that was sent from a handset to our servers.
     * If you send a message to an US number you need to set the from parameter and the mo parameter to 1
     * more info: http://kb.paessler.com/en/topic/43273-i-cannot-send-sms-text-messages-to-us-numbers-using-clickatell-what-can-i-do
     */
    public $mo = 0;

    protected $_extra = [];

    /** @var \Clickatell\Api\ClickatellHttp */
    private $_api;

    public function init()
    {
        parent::init();
        $this->_api = new \Clickatell\Api\ClickatellHttp($this->username, $this->password, $this->apiID);
        $this->_api->secure($this->secure);
        $this->setExtraParameters();
    }

    private function setExtraParameters()
    {
        if (!is_null($this->from)) {
            $this->_extra['from'] = $this->from;
        }
        if (!is_null($this->mo)) {
            $this->_extra['mo'] = $this->mo;
        }
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
     * @param array $to The recipient list
     * @param string $message Message
     * @param array $extra Extra parameters (based on Clickatell documents)
     *
     * @return array
     */
    public function sendMessage($to, $message, $extra = [])
    {
        $extra = array_merge($this->_extra, $extra);

        return $this->_api->sendMessage($to, $message, $extra);
    }

    /**
     * API call for "getBalance".
     *
     * Response format:
     *      balance => int
     *
     * @throws Exception
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->_api->getBalance();
    }

    /**
     * API call for "stop message".
     *
     * @param string $apiMsgId ApiMsgId to query
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function stopMessage($apiMsgId)
    {
        return $this->_api->stopMessage($apiMsgId);
    }

    /**
     * API call for "queryMsg".
     *
     * @param string $apiMsgId ApiMsgId to query
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function queryMessage($apiMsgId)
    {
        return $this->_api->queryMessage($apiMsgId);
    }

    /**
     * API call for "routeCoverage".
     *
     * @param int $msisdn Number to check for coverage
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function routeCoverage($msisdn)
    {
        return $this->_api->routeCoverage($msisdn);
    }

    /**
     * API call for "getMsgCharge".
     *
     * @param string $apiMsgId ApiMsgId to query
     *
     * @param bool   $cliMsgId is this a client MsgId?
     *
     * @return mixed
     */
    public function getMessageCharge($apiMsgId, $cliMsgId = false)
    {
        return $this->_api->getMessageCharge($apiMsgId, $cliMsgId);
    }
}