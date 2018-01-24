<?php
/**
 * 公共自定义查询类
 */

namespace app\components;

use Yii;
use yii\db\ActiveQuery;

class CommonQuery extends ActiveQuery
{
    const DELETE_STATUS = -1;
    const ACTIVE_STATUS = 0;
    const PAUSE_STATUS  = 1;
    /**
     * 活跃状态
     * @param  [type] $status [description]
     */
    public function active($status = self::ACTIVE_STATUS)
    {
        $this->andWhere(['status' => $status]);
        return $this;
    }
    /**
     * 有效状态
     * @param  [type] $status [description]
     */
    public function normal(){
        $this->andWhere(['status'=>[self::ACTIVE_STATUS,self::PAUSE_STATUS]]);
        return $this;
    }
    /**
     * 删除状态
     * @param  [type] $status [description]
     */
    public function del($status = self::DELETE_STATUS){
        $this->andWhere(['status'=> $status]);
        return $this;
    }

    public function goods($goodsId = '')
    {
        $goodsId = $goodsId ?: Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods');
        return $this->andWhere(['goods_id'=>$goodsId]);
    }

    public function products($productIds = '')
    {
        $productIds = $productIds ?: Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods');
        return $this->andWhere(['goods_id'=>$productIds]);
    }

    public function createdBy($userid = null){
        $userid = $userid ?: Yii::$app->user->id;
        return $this->andWhere(['created_by'=>$userid]);
    }
}