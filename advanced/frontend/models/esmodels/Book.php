<?php 
namespace app\models\esmodels;

use Yii;
use yii\elasticsearch\ActiveRecord;

Class Book extends ActiveRecord
{
    // Other class attributes and methods go here
    // ...
    # db
    public static function index()
    {
        return 'yiitest';
    }

    # table
    public static function type()
    {
        return 'book';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public function attributes(){
        return ['id', 'name', 'author_name', 'publisher_name', 'created_at','type'];
    }

    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'name'           => ['type' => 'string'],
                    'author_name'    => ['type' => 'string'],
                    'publisher_name' => ['type' => 'string'],
                    'created_at'     => ['type' => 'long'],
                    'updated_at'     => ['type' => 'long'],
                    'status'         => ['type' => 'long'],
                ]
            ],
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index());
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }
}


 ?>