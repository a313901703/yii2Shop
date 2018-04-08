<?php

namespace frontend\components;

use Monolog\Logger;
use Monolog\Handler\StdoutHandler;

class Kafka
{
    protected $logger;
    public $dns = '127.0.0.1:9092';
    public $consumer_dns = '127.0.0.1:9092';
    public $version = '1.0.0';


    // public function __construct(){
    //     // $logger = new Logger('my_logger');
    //     // $logger->pushHandler(new StdoutHandler());
    //     // $this->logger = $logger;
    // }

    public function producer($topic,array $values = []){
        $config = \Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList($this->dns);
        $config->setBrokerVersion($this->version);
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer();
        //$producer->setLogger($this->logger);

        foreach ($values as $key => $value) {
            $result = $producer->send(
                [
                    [
                        'topic'=>$topic,
                        'key'=>$key,
                        'value'=>$value,
                    ]
                ]
            );
        }
    }

    public function consumer($topic){
        $config = \Kafka\ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList($this->consumer_dns);
        $config->setGroupId('test');
        $config->setBrokerVersion($this->version);
        $config->setTopics([$topic]);
        //$config->setOffsetReset('earliest');
        $consumer = new \Kafka\Consumer();
        //$consumer->setLogger($this->logger);
        $consumer->start(function($topic, $part, $message) {
            // TODO 
            print_r([$topic,$part,$message]);
            //exit;
        });
    }
}