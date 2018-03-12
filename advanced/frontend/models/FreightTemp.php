<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "freight_temp".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $base_freight
 * @property integer $renew
 * @property integer $whether_post
 * @property integer $free_post
 * @property integer $charge_rule
 * @property string $region
 * @property integer $base_num
 * @property integer $renew_num
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
            [['name', 'base_freight', 'free_post'], 'required'],
            [['type', 'base_freight', 'renew', 'whether_post', 'free_post', 'charge_rule', 'base_num', 'renew_num','free_post_value'], 'integer'],
            ['free_post_value','default','value'=>0],
            [['name', 'region'], 'string', 'max' => 255],
            [['charge_rule','free_post'],'default','value'=>'1'],
            ['region_name','safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '运费模板名称',
            'type' => '运费类型',
            'base_freight' => '基础运费',
            'renew' => '续费',
            'whether_post' => '是否包邮',
            'free_post' => '包邮策略',
            'charge_rule' => '计费规则',
            'region' => '配送区域',
            'base_num' => '首件',
            'renew_num' => '续件',
            'region_name'=>'配送区域',
        ];
    }
}
