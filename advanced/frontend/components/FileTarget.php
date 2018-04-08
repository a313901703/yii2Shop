<?php 
namespace app\components;

use Yii;
use yii\log\{Logger,FileTarget as BaseFileTarget};
use yii\helpers\{ArrayHelper,VarDumper,Json};
use yii\helpers\StringHelper;

class FileTarget extends BaseFileTarget
{
    public $logTag = null;
    public $beforeActionMsectime;
    public $endActionMsectime;

    /**
     * @param \yii\debug\Module $module
     * @param array $config
     */

    private function getTagId(){
        if (!$this->logTag) {
            $this->logTag = Yii::$app->has('user',true) ? Yii::$app->user->opt_id : uniqid().'_'.time();
        }
        return $this->logTag;
    }

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
            'tag'=>$this->getTagId(),
            //'tag'=>Yii::$app->params['logTag'],
            'app_id'=>Yii::$app->id,
            'user_id'=>$prefix,
            'date'=> $message['3'] ? date('Y-m-d H:i:s',(int)$message['3']) : date('Y-m-d H:i:s', $timestamp),
            'msectime'=>$message['3'],
            'level'=>$level,
            'category'=>$category,
            'text'=>$text,
            'traces'=>$traces,
        ];
        $logs = $this->setLogs($category,$logs);
        return json_encode($logs);
    }

    private function setLogs($category,$logs){
        $_logs = [];
        if (StringHelper::startsWith($category,'yii\web\Application')) {
            $_logs = $this->getRequestInfo();
        }elseif($logs['text'] == '_beforeAction'){
            $_logs = $this->getRequestInfo();
            $this->beforeActionMsectime = $logs['msectime'];
        }elseif($logs['text'] == '_afterAction'){
            $this->endActionMsectime = $logs['msectime'];
            $_logs = $this->getRequestInfo();
            $_logs['duration'] = $this->beforeActionMsectime ? ($this->endActionMsectime - $this->beforeActionMsectime) * 1000: 0;
            //$_logs['db_duration'] = $this->getTimings();
            //print_r($this->getTimings());exit;
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
        $request = Yii::$app->request;
        return [
            'absoluteUrl'=>$request->absoluteUrl,
            'hostInfo'=>$request->hostInfo,
            'userHost' =>  $request->userHost,
            'IP' =>  $request->userIP,
            'isAjax'=>$request->isAjax ? 1 : 0,
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

    private function getTimings()
    {
        $timings = Yii::getLogger()->calculateTimings(isset($this->messages) ? $this->messages : []);
        $models = [];
        foreach ($timings as $seq => $profileTiming) {
            $models[] =  [
                'duration' => $profileTiming['duration'] * 1000, // in milliseconds
                'category' => $profileTiming['category'],
                'info' => $profileTiming['info'],
            ];
        }
        return $models;
    }
}
 ?>