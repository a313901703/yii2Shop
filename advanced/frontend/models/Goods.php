<?php

namespace app\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use app\models\Category;
use app\models\Brand;

/**
 * This is the model class for table "goods".
 *
 * @property string $id
 * @property string $name
 * @property string $short_name
 * @property string $keyword
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_content
 * @property string $good_no
 * @property string $weight
 * @property string $good_cate
 * @property integer $good_brand
 * @property integer $recommend
 * @property integer $show
 * @property integer $freight
 * @property string $market_price
 * @property string $sale_price
 * @property string $cost
 * @property integer $stock
 * @property string $alert
 * @property string $sort
 * @property string $integral
 * @property string $virtual_nums
 * @property string $volume
 */
class Goods extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    // public function optimisticLock(){
    //     return 'version';
    // }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'good_cate', 'market_price', 'sale_price','good_desc','good_detail'], 'required'],
            [['weight', 'market_price', 'sale_price', 'cost'], 'number'],
            [['market_price', 'sale_price', 'cost'],'filter','filter'=>function($value){
                return (int)($value * 100);
            }],
            [['good_cate', 'good_brand', 'recommend', 'show', 'freight', 'stock', 'alert', 'sort', 'integral', 'virtual_nums', 'volume'], 'integer'],
            [[ 'seo_title', 'seo_keyword', 'good_no'], 'string', 'max' => 50],
            [['volume','virtual_nums','integral','status','freight','alert','sort'],'default','value' => 0],
            ['good_no','default','value' =>  function ($model, $attribute) {
                return chr(rand(65, 90)).chr(rand(65, 90)).time();
            }],
            ['cost','default','value'=>0],
            [['short_name', 'keyword'], 'string', 'max' => 20],
            [['seo_content','good_note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'short_name' => '商品短名称',
            'keyword' => '关键词',
            'seo_title' => 'seo标题',
            'seo_keyword' => 'seo关键词',
            'seo_content' => 'seo内容',
            'good_no' => '货号',
            'weight' => '重量',
            'good_cate' => '分类',
            'good_brand' => '品牌',
            'recommend' => '推荐类型',
            'show' => '是否上架',
            'freight' => '运费模板',
            'market_price' => '市场价',
            'sale_price' => '出售价格',
            'cost' => '成本',
            'stock' => '库存',
            'alert' => '警告线',
            'sort' => '排序',
            'integral' => '积分',
            'virtual_nums' => '虚拟数量',
            'volume' => '成交量',
            'good_note'=>'备注',
            'good_desc'=>'商品描述',
            'good_detail'=>'商品详情',
        ];
    }

    public function getBrand(){
        return $this->hasOne(Brand::className(), ['id' => 'good_brand']);
    }

    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'good_cate']);
    }

    public function getImages(){
        return $this->hasOne(GoodsImages::className(),['goods_id'=>'id']);
    }

    public function getProps(){
        return $this->hasMany(Itemprops::className(),['goods_id'=>'id']);
    }

    public function getPropsCombi(){
        return $this->hasMany(Propscombi::className(),['goods_id'=>'id'])->orderBy(['sale_price'=>SORT_ASC]);
    }
}
