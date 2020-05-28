<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 16:51
 */

namespace multiSendMessage\driver;


class ResultChannel
{
    private $error;
    private $timer;

    function __construct($timer, $error)
    {
        $this->timer = $timer;
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getTimer()
    {
        return $this->timer;
    }


}