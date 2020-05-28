<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 12:52
 */

namespace multiSendMessage\driver;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Whatsapp extends ChannelAbstract implements ChannelInterface
{

    public function send($to, $message) : ResultChannel
    {
        \PHP_Timer::start();
        try
        {
            $client = new Client();
            $client->post($this->url, [RequestOptions::JSON => ["Phones"=>$to, "Body"=>$message]]);
        }catch (\Exception $e){
            $this->setError($e->getMessage());
        }
        $timer = \PHP_Timer::stop();

        return new ResultChannel($timer, $this->getError());
    }
}