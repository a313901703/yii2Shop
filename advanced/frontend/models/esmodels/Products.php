<?php 
namespace app\models\esmodels;

use Yii;
use yii\elasticsearch\ActiveRecord;

/**
* elasticSearch  products model
*/
class products extends ActiveRecord
{
    public static function index()
    {
        return 'shop_products';
    }
    public static function primaryKey()
    {
        return ['product_id'];
    }
    public static function type()
    {
        return 'products';
    }
    public function attributes()
    {
        return ['product_id', 'name', 'desc', 'created_at','updated_at','status','brand','cate'];
    }
    public static function mapping()
    {
      return [
            static::type() => [
                "properties" => [
                    "product_id" => ["type" => "long"],
                    "name" =>  ["type" => "text","index" => true,'analyzer'=>"smartcn"],
                    "desc" =>  ["type" => "text","index" => true,'analyzer'=>"smartcn"],
                    "created_at" =>  ["type" => "long"],
                    "updated_at" =>  ["type" => "long"],
                    "status" =>  ["type" => "long"],
                    "brand" =>  ["type" => "long"],
                    "cate" =>  ["type" => "long"],
                ]
            ]
      ];
    }
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            //'settings' => [ 'index' => ['refresh_interval' => '10s'] ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }
}

 ?>