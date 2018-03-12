<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m180126_061950_address extends Migration
{
    CONST TABLE_NAME = 'address';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('收件人'),
            'phone' => $this->string(15)->notNull()->comment('联系电话'),
            'country'=>$this->string(255)->notNull()->comment('国家'),
            'province' => $this->integer(11)->notNull()->comment('省'),
            'city' => $this->integer(11)->notNull()->comment('市'),
            'county' => $this->integer(11)->notNull()->comment('县/区'),
            'street' => $this->string(255)->notNull()->defaultValue('')->comment('街道'),
            'detailed_address' => $this->string(255)->notNull()->comment('楼层/门牌号...详细地区信息'),
            'default' => $this->integer(3)->notNull()->defaultValue(0)->comment('默认 0非默认  1 默认'),
            'created_by' => $this->integer(11)->notNull()->comment('创建人'),
            'created_at' => $this->integer(11)->notNull()->comment('创建时间'),
        ],$this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
