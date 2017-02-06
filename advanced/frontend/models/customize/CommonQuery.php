<?php
/**
 * 公共自定义查询类
 */

namespace app\models\customize;

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
}