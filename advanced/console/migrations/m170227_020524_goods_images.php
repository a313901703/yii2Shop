<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170227_020524_goods_images extends Migration
{
    CONST TABLE_NAME = 'goods_images';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'thumb' => $this->string()->notNull()->comment('商品缩略图'),
            'carousels' => $this->string()->notNull()->comment('轮播'),
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
        ],$this->tableOptions);

        $this->createIndex(
            'idx-goods_images-goods_id',
            self::TABLE_NAME,
            'goods_id'
        );
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
