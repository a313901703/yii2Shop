<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\components;

use Yii;
use yii\web\Response;
use yii\helpers\Json;

class Response
{
    const FORMAT_RAW = 'raw';
    const FORMAT_HTML = 'html';
    const FORMAT_JSON = 'json';
    const FORMAT_JSONP = 'jsonp';
    const FORMAT_XML = 'xml';

    public $data;
    public $format;
    public $errCode;

    public function __construct($data,$format = self::FORMAT_JSON,$errorCode = 0)
    {
        $this->data = $data;
        $this->errCode = $error_code;
    }

    public function __toString()
    {
        return Json::encode($this);
    }

    // public function returnData($format = self::FORMAT_JSON){
    //     $this->data = $data;
    // }
    
}