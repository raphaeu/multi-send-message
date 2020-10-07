<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 16:09
 */
require __DIR__.'/../vendor/autoload.php';

use \multiSendMessage\MultiSendMessage;


MultiSendMessage::init(['phone'=>['shellScriptPath'=>'/usr/zeus/critical.sh ','path'=>'/tmp/','providerName'=>'Cpqd','repeat'=>3 ]]);

$result = MultiSendMessage::channel('phone')->send('554199915726','oi voce esta ai rafaela sd adsas dasd asd das ads asd?');

echo "Error: ". $result->getError() . " Timer: ". $result->getTimer().PHP_EOL;

