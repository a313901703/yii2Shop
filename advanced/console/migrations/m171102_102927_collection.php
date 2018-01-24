<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m171102_102927_collection extends Migration
{
    CONST TABLE_NAME = 'collection';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull()->comment('商品ID'),
            'status' => $this->integer(3)->notNull()->defaultValue(0)->comment('状态 1：收藏  0：取消'),
            'created_by' => $this->integer()->notNull()->comment('创建人'),
            'updated_at' => $this->integer()->notNull()->comment('修改时间'),
        ],$this->tableOptions);

        $this->createIndex(
            self::TABLE_NAME.'-created_by',
            self::TABLE_NAME,
            'created_by'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            self::TABLE_NAME.'-created_by',
            self::TABLE_NAME
        );
        $this->dropTable(self::TABLE_NAME);
    }
}
