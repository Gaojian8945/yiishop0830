<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m171224_121309_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->comment('名称'),
            'intro' => $this->text()->comment('简介@textarea|1=是&0=否'),
            'status' => $this->integer()->comment('状态@radio'),
            'sort' => $this->integer()->comment('排序'),
            'is_help' => $this->integer()->comment('是否是分类相关')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
