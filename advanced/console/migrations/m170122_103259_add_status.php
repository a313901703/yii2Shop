<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170122_103259_add_status extends Migration
{
    public function safeUp()
    {
        $this->addColumn('goods', 'status', $this->integer(3)->notNull()->defaultValue(0)->comment('0：正常 -1：删除 1：禁用'));
        $this->addColumn('category', 'status', $this->integer(3)->notNull()->defaultValue(0)->comment('0：正常 -1：删除 1：禁用'));
        $this->addColumn('brand', 'status', $this->integer(3)->notNull()->defaultValue(0)->comment('0：正常 -1：删除 1：禁用'));
    }

    public function safeDown()
    {
        $this->dropColumn('post', 'status');
        $this->dropColumn('category', 'status');
        $this->dropColumn('brand', 'status');
    }
}
