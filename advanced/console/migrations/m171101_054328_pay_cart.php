<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m171101_054328_pay_cart extends Migration
{
    CONST TABLE_NAME = 'pay_cart';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
            'propscombi_id'=> $this->integer()->notNull()->defaultValue(0)->comment('规格组合ID'),
            'nums' => $this->integer()->notNull()->defaultValue(1)->comment('数量'),
            'created_by' => $this->integer()->notNull()->comment('创建人'),
            'updated_by' => $this->integer()->notNull()->comment('创建人'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('修改时间'),
        ],$this->tableOptions);

        $this->createIndex(
            'idx-pay_cart-id',
            self::TABLE_NAME,
            'id'
        );
        $this->createIndex(
            'idx-pay_cart-goods_id',
            self::TABLE_NAME,
            'goods_id'
        );
        $this->createIndex(
            'idx-pay_cart-created_by',
            self::TABLE_NAME,
            'created_by'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-pay_cart-created_by',
            self::TABLE_NAME
        );
        $this->dropIndex(
            'idx-pay_cart-goods_id',
            self::TABLE_NAME
        );
        $this->dropIndex(
            'idx-pay_cart-id',
            self::TABLE_NAME
        );
        $this->dropTable(self::TABLE_NAME);
    }
}
