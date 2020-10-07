<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 12:52
 */
namespace multiSendMessage\driver;
use providers\Provider;

class Phone extends ChannelAbstract implements ChannelInterface
{
    private $shellScriptPath;    
    private $path;    
    private $providerName;
    private $repeat;

    public function __construct($shellScriptPath, $path, $providerName, $repeat=3)
    {
        $this->shellScriptPath = $shellScriptPath;
        $this->path = $path;
        $this->providerName = $providerName;
        $this->repeat = $repeat;
        
    }

    public function send($to, $message) : ResultChannel
    {

        \PHP_Timer::start();
        
        $timer = \PHP_Timer::stop();
        $fileName = $this->path .'/'. $to. '_' .md5($message).'.wav' ;

        Provider::GetInstanceTTS($this->providerName)->textToSpeech($message, 'M', $fileName);

        shell_exec("{$this->shellScriptPath} {$this->repeat} {$fileName} {$to}");
      
        return new ResultChannel($timer, $this->getError());
    }
}