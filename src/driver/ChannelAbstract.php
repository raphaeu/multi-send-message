<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 17/05/20
 * Time: 12:13
 */

namespace multiSendMessage\driver;


abstract class ChannelAbstract
{
    protected $url;
    protected $token;
    protected $error;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getError()
    {
        return $this->error;
    }

    protected function setError($error)
    {
        $this->error = $error;
    }
}