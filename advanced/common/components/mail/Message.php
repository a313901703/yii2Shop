<?php
namespace common\components\mail;

use Yii;
class Message extends \yii\swiftmailer\Message
{
    public function queue()
    {
        $redis = Yii::$app->redis;
        if (empty($redis)) {
            throw new \yii\base\InvalidConfigException('redis not found in config.');
        }
        $mailer = Yii::$app->mailer;
        if (empty($mailer) || !$redis->select($mailer->db)) {
            throw new \yii\base\InvalidConfigException('db not defined.');
        }
        $message = [];
        $message['from'] = $this->from;
        $message['to'] = $this->getTo();
        $message['cc'] = ($this->getCc());
        $message['bcc'] = ($this->getBcc());
        $message['reply_to'] = ($this->getReplyTo());
        $message['subject'] = $this->getSubject();
        $parts = $this->getSwiftMessage()->getChildren();
        if (!is_array($parts) || !sizeof($parts)) {
            $parts = [$this->getSwiftMessage()];
        }
        foreach ($parts as $part) {
            if (!$part instanceof \Swift_Mime_Attachment) {
                switch($part->getContentType()) {
                    case 'text/html':
                        $message['html_body'] = $part->getBody();
                        break;
                    case 'text/plain':
                        $message['text_body'] = $part->getBody();
                        break;
                }
            }
        }
        return $redis->rpush($mailer->key, json_encode($message));
    }
}
?>