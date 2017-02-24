<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

/**
 * 销售属性组合表
 */

class m170224_083120_propscombi extends Migration
{
    CONST TABLE_NAME = 'propscombi';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'pids' => $this->string(50)->notNull()->comment('属性id组合'),
            'goods_id' => $this->integer()->notNull()->comment('商品'),
            'sale_price' => $this->integer()->notNull()->comment('价格'),
            'cost' => $this->integer()->notNull()->defaultValue(0)->comment('成本'),
            'stock' => $this->integer()->notNull()->defaultValue(0)->comment('库存'),
        ],$this->tableOptions);

        $this->createIndex(
            'idx-propscombi-pids',
            self::TABLE_NAME,
            'pids'
        );
        $this->createIndex(
            'idx-propscombi-goods_id',
            self::TABLE_NAME,
            'goods_id'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-propscombi-pids',
            self::TABLE_NAME
        );
        $this->dropIndex(
            'idx-propscombi-goods_id',
            self::TABLE_NAME
        );
        $this->dropTable(self::TABLE_NAME);
    }
}


