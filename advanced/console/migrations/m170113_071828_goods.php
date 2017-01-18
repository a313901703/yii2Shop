<?php

use yii\db\Schema;
use jamband\schemadump\Migration;

class m170113_071828_goods extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods}}', [
            'id' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL AUTO_INCREMENT",
            'name' => Schema::TYPE_STRING . "(50) NOT NULL",
            'short_name' => Schema::TYPE_STRING . "(20) NULL",
            'keyword' => Schema::TYPE_STRING . "(20) NULL",
            'seo_title' => Schema::TYPE_STRING . "(50) NULL COMMENT 'seo标题'",
            'seo_keyword' => Schema::TYPE_STRING . "(50) NULL COMMENT 'seo关键词'",
            'seo_content' => Schema::TYPE_STRING . "(255) NULL COMMENT 'seo内容'",
            'good_no' => Schema::TYPE_STRING . "(50) NOT NULL COMMENT '货号'",
            'weight' => Schema::TYPE_DECIMAL . "(11,2) NOT NULL DEFAULT '0.00'",
            'good_cate' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL COMMENT '分类'",
            'good_brand' => Schema::TYPE_INTEGER . "(11) NOT NULL COMMENT '品牌'",
            'recommend' => Schema::TYPE_SMALLINT . "(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '推荐类型'",
            'show' => Schema::TYPE_SMALLINT . "(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否上架'",
            'freight' => Schema::TYPE_SMALLINT . "(5) UNSIGNED NOT NULL DEFAULT '0'",
            'market_price' => Schema::TYPE_DECIMAL . "(11,2) UNSIGNED NOT NULL COMMENT '市场价'",
            'sale_price' => Schema::TYPE_DECIMAL . "(11,2) UNSIGNED NOT NULL COMMENT '出售价格'",
            'cost' => Schema::TYPE_DECIMAL . "(11,2) UNSIGNED NOT NULL COMMENT '成本'",
            'stock' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0' COMMENT '库存   -1表示无限'",
            'alert' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '警告线'",
            'sort' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'",
            'integral' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '积分'",
            'virtual_nums' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '虚拟数量'",
            'volume' => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '成交量'",
            'created_at' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'created_by' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'updated_by' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'good_note' => Schema::TYPE_STRING . "(255) NULL COMMENT '备注'",
            'good_desc' => Schema::TYPE_TEXT . " NOT NULL COMMENT '商品描述'",
            'good_detail' => Schema::TYPE_TEXT . " NOT NULL COMMENT '详情'",
            'PRIMARY KEY (id)',
        ], $this->tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%goods}}');
    }
}
