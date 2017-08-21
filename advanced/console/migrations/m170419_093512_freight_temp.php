<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170419_093512_freight_temp extends Migration
{
    CONST TABLE_NAME = 'freight_temp';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('运费模板名称'),
            'type' => $this->integer(4)->notNull()->defaultValue(1)->comment('运费类型'),
            'base_freight' => $this->integer()->notNull()->comment('基础运费'),
            'renew' => $this->integer()->notNull()->comment('续费'),
            'whether_post' => $this->integer(1)->defaultValue(0)->comment('是否包邮'),
            'free_post' => $this->integer()->notNull()->comment('包邮策略'),
            'charge_rule'=>$this->integer(3)->notNull()->defaultValue(0)->comment('计费规则'),
            'region'=>$this->string()->notNull()->defaultValue('')->comment('配送区域'),
        ],$this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
