<?php
namespace multiSendMessage;


use multiSendMessage\driver\ChannelInterface;
use multiSendMessage\driver\SMSFlash;
use multiSendMessage\driver\Telegram;
use multiSendMessage\driver\Whatsapp;
use multiSendMessage\driver\Phone;


class MultiSendMessage
{
    private static $instance = [];
    private static $config = [];

    public static function channel($channel=null) : ChannelInterface
    {

       if (!isset($instance[$channel]))
       {

           if(!isset(self::$config[$channel]))  throw new \Exception("Canal não inicializado.");

           switch ($channel) {
               case 'whatsapp':
                   self::$instance[$channel] = new Whatsapp(self::$config[$channel]['url']);
                   break;
               case 'telegram':
                   self::$instance[$channel] = new Telegram(self::$config[$channel]['url'], self::$config[$channel]['token']);
                   break;
               case 'SMSFlash':
                   self::$instance[$channel] = new SMSFlash(self::$config[$channel]['url'], self::$config[$channel]['token'], self::$config[$channel]['carteira_id']);
                   break;
                case 'phone':
                    self::$instance[$channel] = new Phone(self::$config[$channel]['shellScriptPath'],self::$config[$channel]['path'],self::$config[$channel]['providerName'],self::$config[$channel]['repeat']);
                    break;                   
               default:
                   throw new \Exception("Canal selecionado nao existe.");
                   break;
           }
       }

        return self::$instance[$channel];
    }

    public static function init($confs)
    {
        foreach ($confs as $channel => $cnf)
        {
            self::$config[$channel] = $cnf;
        }
    }
}
