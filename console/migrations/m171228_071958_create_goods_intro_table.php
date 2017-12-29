<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_intro`.
 */
class m171228_071958_create_goods_intro_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_intro', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->comment('商品id'),
            'content' => $this->text()->comment('内容介绍')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_intro');
    }
}
