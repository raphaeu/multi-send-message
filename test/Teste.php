<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 16:09
 */
require __DIR__.'/../vendor/autoload.php';

use \multiSendMessage\MultiSendMessage;


MultiSendMessage::init(['telegram'=>['url'=>'https://[api_url]', 'token'=>'[numero_token]']]);

$result = MultiSendMessage::channel('telegram')->send('554199915726','oi');

echo "Error: ". $result->getError() . " Timer: ". $result->getTimer().PHP_EOL;

