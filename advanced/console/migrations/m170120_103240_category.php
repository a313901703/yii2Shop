<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170120_103240_category extends Migration
{
    CONST TABLE_NAME = 'category';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('分类名'),
            'sort' => $this->integer(6)->notNull()->defaultValue(0)->comment('排序'),
            'img' => $this->string(500)->notNull()->comment('分类图片'),
            'pid' => $this->integer()->notNull()->defaultValue(0)->comment('父类ID'),
            'pid_sign' => $this->string()->notNull()->defaultValue('0')->comment('分类标记'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'created_by' => $this->integer()->notNull()->comment('创建人'),
        ],$this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
