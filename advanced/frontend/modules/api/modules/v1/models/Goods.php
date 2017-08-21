<?php 

namespace v1\models;

use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
/**
* 
*/
class Goods extends \app\models\Goods implements Linkable
{
    public function fields()
    {
        return [
            // 字段名和属性名相同
            'id',
            // 字段名为"name", 值由一个PHP回调函数定义
            'name',
            'images',

        ];
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['/api/v1/goods', 'id' => $this->id], true),
        ];
    }

}