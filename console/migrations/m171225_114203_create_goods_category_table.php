<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m171225_114203_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->comment('分类名称'),
            'parent_id' => $this->integer()->comment('父类id'),
            'tree' => $this->integer()->notNull()->comment('树'),
            'lft' => $this->integer()->notNull()->comment('左值'),
            'rgt' => $this->integer()->notNull()->comment('右值'),
            'depth' => $this->integer()->notNull()->comment('深度'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
