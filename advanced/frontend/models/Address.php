<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $country
 * @property integer $province
 * @property integer $city
 * @property integer $county
 * @property string $street
 * @property string $address_info
 * @property integer $default
 * @property integer $created_by
 */
class Address extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $mapRegion;
    public $_district;

    public static function tableName()
    {
        return 'address';
    }

    public function fields(){
        $fields = parent::fields();
        $this->setDistrict();
        $fields['district'] = 'district';
        return $fields;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province', 'city', 'county', 'detailed_address','name','phone'], 'required'],
            [['province', 'city', 'county', 'default'], 'integer'],
            [['country', 'detailed_address'], 'string', 'max' => 255],
            ['phone','string','min'=>11,'max'=>15],
            ['default','default','value'=>0],
            ['country','default','value'=>'cn'],
            ['created_by','default','value'=>Yii::$app->user->id],
            ['created_at','default','value'=>time()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name'=>'收货人',
            'country' => '国家',
            'province' => '省',
            'city' => '市',
            'county' => '县/区',
            'street' => '街道',
            'detailed_address' => '楼层/门牌号...详细地区信息',
            'default' => '默认 0非默认  1 默认',
            'created_by' => '创建人',
        ];
    }

    public function setDistrict(){
        $mapRegion = $this->getRegin();
        $district = [
            $mapRegion[$this->province] ?? $this->province,
            $mapRegion[$this->city] ?? $this->city,
            $mapRegion[$this->county] ?? $this->county,
        ];
        $this->district = implode('', $district);
    }

    public function getDistrict(){
        if ($this->_district === null) {
            $this->setDistrict();
        }
        return $this->_district;
    }

    public function getRegin(){
        if (!$this->mapRegion) {
            $mapRegion = \app\models\Region::find()->select('id,name')->asArray()->all();
            $this->mapRegion = ArrayHelper::map($mapRegion,'id','name');
        }
        return $this->mapRegion;
    }
}
