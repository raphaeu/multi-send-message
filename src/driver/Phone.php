<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 28/05/20
 * Time: 12:52
 */
namespace multiSendMessage\driver;
use GuzzleHttp\Client;

class Phone extends ChannelAbstract implements ChannelInterface
{
    private $shellScriptPath;    
    private $path;    
    private $repeat;

    public function __construct($shellScriptPath, $path, $repeat=3)
    {
        $this->shellScriptPath = $shellScriptPath;
        $this->path = $path;
        $this->repeat = $repeat;
        
    }

    public function send($to, $message) : ResultChannel
    {

        \PHP_Timer::start();
        
        $timer = \PHP_Timer::stop();
        $fileName = $this->path .'/'. $to. '_' .md5($message).'.wav' ;

        $url = "http://10.110.255.155:9090/rest/v2/synthesize?text=ola+mundo&voice=carlos-highquality.voice";
        
        $client = new Client();
        $response = $client->request('GET', $url , ['timeout' => 5]);
        
        if ($response->getStatusCode() == 200)
        {
            file_put_contents($fileName, $response->getBody());
         }else{
            throw new \ErrorException('Erro ao gerar TTS Cpqd.'.$text);
        }        

        shell_exec("{$this->shellScriptPath} {$this->repeat} {$fileName} {$to}");
      
        return new ResultChannel($timer, $this->getError());
    }
}