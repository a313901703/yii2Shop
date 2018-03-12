<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message_log".
 *
 * @property integer $id
 * @property string $phone
 * @property integer $status
 * @property string $content
 * @property string $type
 * @property string $msg
 * @property integer $created_at
 */
class MessageLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'content'], 'required'],
            [['status'], 'integer'],
            [['phone'], 'string', 'max' => 15],
            [['content'], 'string', 'max' => 1000],
            [['type'], 'string', 'max' => 20],
            [['msg'], 'string', 'max' => 255],
            ['created_at','default','value'=>time()],
            ['status','default','value'=>0],
            ['code','safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => '手机号',
            'status' => '状态 0：发送中  1：已发送 -1: 发送失败',
            'content' => '发送内容',
            'type' => '发送类型',
            'msg' => '发送结果',
            'created_at' => '创建时间',
        ];
    }
}
