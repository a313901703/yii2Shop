<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m171222_035252_orders extends Migration
{
    CONST TABLE_NAME = 'orders';
    CONST ORDER_PRODUCTS = 'order_products';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'order_tag'=>$this->string(255)->comment('订单号，订单标识'),
            'user_id' => $this->integer()->notNull()->comment('用户id'),
            'total' => $this->integer()->notNull()->comment('总价'),
            //'nums'=> $this->integer()->notNull()->comment('总量'),
            'status' => $this->integer(3)->notNull()->defaultValue(0)->comment('状态0:未支付,1:待发货,2:已发货,3:待确认,4:已确认,5:退货,-1:删除'),
            'msg' => $this->string(255)->comment('留言'),
            'pay_type'=>$this->integer(3)->comment('1:微信,2支付宝'),
            'address_id' => $this->integer()->notNull()->comment('地址ID'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('修改时间'),
            'created_by' => $this->integer()->notNull()->comment('创建人'),
            'updated_by' => $this->integer()->notNull()->comment('修改人'),
        ],$this->tableOptions);

        $this->createIndex(
            self::TABLE_NAME.'-created_by',
            self::TABLE_NAME,
            'created_by'
        );

        $this->createTable(self::ORDER_PRODUCTS, [
            'id' => $this->primaryKey(),
            'nums' => $this->integer()->notNull()->comment('数量'),
            'order_id' => $this->integer()->notNull()->comment('订单ID'),
            'product_id' => $this->integer()->notNull()->comment('商品ID'),
            'sale_price' => $this->integer()->notNull()->comment('商品的售价'),
            'market_price' => $this->integer()->notNull()->comment('价格'),
            'cost' => $this->integer()->notNull()->defaultValue(0)->comment('成本'),
            'propscombi_id' => $this->integer()->notNull()->defaultValue(0)->comment('属性组合ID'),
            'props' => $this->string(255)->notNull()->defaultValue('')->comment('属性组合信息'),

            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('修改时间'),
            'created_by' => $this->integer()->notNull()->comment('创建人'),
            'updated_by' => $this->integer()->notNull()->comment('修改人'),
        ],$this->tableOptions);

        $this->createIndex(
            self::ORDER_PRODUCTS.'-order_id',
            self::ORDER_PRODUCTS,
            'order_id'
        );

    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
        $this->dropTable(self::ORDER_PRODUCTS);
    }
}
