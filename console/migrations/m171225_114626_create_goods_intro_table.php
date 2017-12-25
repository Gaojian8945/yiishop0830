<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_intro`.
 */
class m171225_114626_create_goods_intro_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_intro', [
            'id' => $this->primaryKey(),
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
