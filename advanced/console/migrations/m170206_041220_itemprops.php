<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170206_041220_itemprops extends Migration
{
    //属性名和属性值表
    CONST TABLE_NAME = 'itemprops';
    CONST TABLE_NAME_PROPS_VALUE = 'propsvalue';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('属性名'),
            'sort' => $this->integer(6)->notNull()->defaultValue(0)->comment('排序'),
            'type' => $this->integer(5)->notNull()->defaultValue(0)->comment('类型 1：基本属性 2：销售属性'),
        ],$this->tableOptions);

        $this->createTable(self::TABLE_NAME_PROPS_VALUE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('属性值名'),
            'sort' => $this->integer(6)->notNull()->defaultValue(0)->comment('排序'),
            'props_id' => $this->integer()->notNull()->comment('属性ID'),
            'status' => $this->integer(3)->notNull()->defaultValue(0)->comment('0：正常 -1：删除 1：禁用'),
        ],$this->tableOptions);


        $this->createIndex(
            'idx-propsvalue-props_id',
            self::TABLE_NAME_PROPS_VALUE,
            'props_id'
        );

        $this->addForeignKey(
            'fk-propsvalue-props_id',
            self::TABLE_NAME_PROPS_VALUE,
            'props_id',
            self::TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-propsvalue-props_id',
            self::TABLE_NAME
        );

        $this->dropIndex(
            'idx-propsvalue-props_id',
            self::TABLE_NAME_PROPS_VALUE
        );

        $this->dropTable(self::TABLE_NAME_PROPS_VALUE);
        $this->dropTable(self::TABLE_NAME);
    }
}
