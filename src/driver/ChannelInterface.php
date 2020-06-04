<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 17/05/20
 * Time: 12:13
 */

namespace multiSendMessage\driver;


interface ChannelInterface
{
    public function send($to, $message) : ResultChannel;
}