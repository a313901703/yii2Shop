<?php

namespace app\models;

use Yii;
use app\components\ActiveRecord;
use yii\behaviors\{TimestampBehavior,BlameableBehavior};

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $total
 * @property integer $status
 * @property string $msg
 * @property integer $pay_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Orders extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total'], 'required'],
            [['total', 'status', 'pay_type'], 'integer'],
            [['msg'], 'string', 'max' => 255],
            ['status','default','value'=>0],
            ['order_tag','default','value' =>  function ($model, $attribute) {
                return Yii::$app->name.'_'.chr(rand(65, 90)).chr(rand(65, 90)).time();
            }],
        ];
    }

    public function getOrderStatus(){
        $status = [
            0=>['value'=>'未支付','status'=>'default'],
            1=>['value'=>'待发货','status'=>'warning'],
            2=>['value'=>'已发货','status'=>'warning'],
            3=>['value'=>'待确认','status'=>'warning'],
            4=>['value'=>'已确认','status'=>'success'],
            5=>['value'=>'退货','status'=>'danger'],
            '-1'=>['value'=>'删除','status'=>'danger'],
        ];
        return $status[$this->status];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'total' => '总价',
            'status' => '状态0:未支付,1:待发货,2:已发货,3:待确认,4:已确认,5:退货,-1:删除',
            'msg' => '留言',
            'pay_type' => '1:微信,2支付宝',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'order_tag' => '订单号',
        ];
    }

    public function getProducts(){
        return $this->hasMany(OrderProduct::className(),['order_id'=>'id']);
    }
}
