<?php

namespace app\models;

use Yii;

/**
 * 运费模板
 * This is the model class for table "freight_temp".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $type
 * @property integer $base_freight
 * @property integer $renew
 * @property integer $whether_post
 * @property integer $free_post
 * @property integer $charge_rule
 * @property string $region
 */
class FreightTemp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freight_temp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'base_freight', 'renew', 'whether_post', 'free_post', 'charge_rule'], 'integer'],
            [['base_freight', 'renew', 'free_post','name'], 'required'],
            [['region'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' =>'模板名称',
            'type' => '运费类型',
            'base_freight' => '基础运费',
            'renew' => '续费',
            'whether_post' => '是否包邮',
            'free_post' => '包邮策略',
            'charge_rule' => '计费规则',
            'region' => '配送区域',
        ];
    }
}
