<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170120_101647_brand extends Migration
{
    CONST TABLE_NAME = 'brand';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('品牌名'),
            'thumb' => $this->string()->notNull()->comment('缩略图'),
            'sort' => $this->integer(6)->notNull()->defaultValue(0)->comment('排序'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'created_by' => $this->integer()->notNull()->comment('创建人'),
        ],$this->tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
