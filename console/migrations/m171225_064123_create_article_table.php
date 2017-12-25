<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171225_064123_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('文章名称'),
            'code_id' => $this->integer()->notNull()->comment('分类id'),
            'intro' => $this->string(255)->comment('简介'),
            'status' => $this->integer()->notNull()->comment('状态：0=显示 1隐藏'),
            'sort' => $this->integer()->comment('排序'),
            'create_time' => $this->integer()->comment('创建时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
