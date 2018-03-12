<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m171107_023801_message_log extends Migration
{
    CONST TABLE_NAME = 'message_log';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'phone' => $this->string(15)->notNull()->comment('手机号'),
            'code' => $this->string(10)->comment('验证码'),
            'status' => $this->integer(3)->notNull()->defaultValue(0)->comment('状态 0：发送中  1：已发送 -1: 发送失败'),
            'content' => $this->string(1000)->notNull()->comment('发送内容'),
            'type' => $this->string(20)->comment('发送类型'),
            'msg' => $this->string()->comment('发送结果'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
        ],$this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
