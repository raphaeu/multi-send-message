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

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function send($to, $message) : ResultChannel
    {
        \PHP_Timer::start();
        try
        {
            if($to = $this->normalizePhone($to))
            {
                $client = new Client();
                $client->post($this->url, [RequestOptions::JSON => ["Phones"=>[$to], "Body"=>$message]]);
            }else{
                $this->setError("Telefone informado inválido.");
           }
        }catch (\Exception $e){
            $this->setError($e->getMessage());
        }
        $timer = \PHP_Timer::stop();

        return new ResultChannel($timer, $this->getError());
    }

    protected function normalizePhone($phone)
    {
        $phone = preg_replace("/[^0-9]/", "", $phone);
        if ($phone[0] == 0) $phone = substr($phone,1);
        if ($phone[0] != 5 && $phone[1] != 5 ) $phone = '55'.$phone;
        if (strlen($phone) == 13)
        {
            return  $phone;
        }elseif(strlen($phone) == 12) {
            return substr($phone,0,4) .'9' .substr($phone,4);
        }else{
            return false;
        }
    }

}