<?php 
namespace app\components;

use Yii;
use yii\log\{Logger,FileTarget};
use yii\helpers\{ArrayHelper,VarDumper,Json};
use yii\helpers\StringHelper;

class FileTarget extends FileTarget
{
    public $logTag;

    /**
     * @param \yii\debug\Module $module
     * @param array $config
     */

    public function formatMessage($message)
    {
        list($text, $level, $category, $timestamp) = $message;
        $level = Logger::getLevelName($level);
        if (!is_string($text)) {
            // exceptions may not be serializable if in the call stack somewhere is a Closure
            if ($text instanceof \Throwable || $text instanceof \Exception) {
                $text = (string) $text;
            } else {
                $text = VarDumper::export($text);
            }
        }
        $traces = [];
        if (isset($message[4])) {
            foreach ($message[4] as $trace) {
                $traces[] = "in {$trace['file']}:{$trace['line']}";
            }
        }

        $prefix = $this->getMessagePrefix($message);
        $logs = [
            //'tag'=>$this->logTag,
            'tag'=>Yii::$app->params['logTag'],
            'from'=>Yii::$app->id,
            'user'=>$prefix,
            'date'=>date('Y-m-d H:i:s', $timestamp),
            'level'=>$level,
            'category'=>$category,
            'text'=>$text,
            'traces'=>$traces,
        ];
        $logs = $this->setLogs($category,$logs);
        return json_encode($logs);
        // return date('Y-m-d H:i:s', $timestamp) . " {$prefix}[$level][$category] $text"
        //     . (empty($traces) ? '' : "\n    " . implode("\n    ", $traces));
    }

    private function setLogs($category,$logs){
        $_logs = [];
        if (StringHelper::startsWith($category,'yii\web\Application')) {
            $_logs = $this->getRequestInfo();
        }elseif(StringHelper::startsWith($category,'yii\db\\')){
            $_logs = [
                'type'=>'db',
            ];
        }
        return ArrayHelper::merge($logs,$_logs);
    }

    private function getRequestInfo(){
        $responseHeaders = [];
        foreach (headers_list() as $header) {
            if (($pos = strpos($header, ':')) !== false) {
                $name = substr($header, 0, $pos);
                $value = trim(substr($header, $pos + 1));
                if (isset($responseHeaders[$name])) {
                    if (!is_array($responseHeaders[$name])) {
                        $responseHeaders[$name] = [$responseHeaders[$name], $value];
                    } else {
                        $responseHeaders[$name][] = $value;
                    }
                } else {
                    $responseHeaders[$name] = $value;
                }
            } else {
                $responseHeaders[] = $header;
            }
        }
        if (Yii::$app->requestedAction) {
            if (Yii::$app->requestedAction instanceof InlineAction) {
                $action = get_class(Yii::$app->requestedAction->controller) . '::' . Yii::$app->requestedAction->actionMethod . '()';
            } else {
                $action = get_class(Yii::$app->requestedAction) . '::run()';
            }
        } else {
            $action = null;
        }

        return [
            'type'=>'request',
            'statusCode' => Yii::$app->getResponse()->getStatusCode(),
            'route' => Yii::$app->requestedAction ? Yii::$app->requestedAction->getUniqueId() : Yii::$app->requestedRoute,
            'action' => $action,
            'actionParams' => Yii::$app->requestedParams,
            'requestBody' => Yii::$app->getRequest()->getRawBody() == '' ? [] : [
                'Content Type' => Yii::$app->getRequest()->getContentType(),
                'Raw' => Yii::$app->getRequest()->getRawBody(),
                'Decoded to Params' => Yii::$app->getRequest()->getBodyParams(),
            ],
            'GET' => empty($_GET) ? [] : $_GET,
            'POST' => empty($_POST) ? [] : $_POST,
            //'COOKIE' => empty($_COOKIE) ? [] : $_COOKIE,
            'FILES' => empty($_FILES) ? [] : $_FILES,
            'SESSION' => empty($_SESSION) ? [] : $_SESSION,
        ];
    }
}


 ?>