<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 12:52
 */

namespace multiSendMessage\driver;
use GuzzleHttp\Client;

class Telegram extends ChannelAbstract implements ChannelInterface
{

    public function __construct($url, $token)
    {
        $this->token = $token;
        $this->url = $url;
    }

    public function send($to, $message) : ResultChannel
    {

        \PHP_Timer::start();
        try
        {
            $client = new Client();
            $client->request('GET',str_replace('[token]', $this->token, $this->url) . http_build_query(['text' => $message, 'chat_id' => $to]) );
        }catch (\Exception $e){
            $this->setError($e->getMessage());
        }
        $timer = \PHP_Timer::stop();

        return new ResultChannel($timer, $this->getError());
    }
}