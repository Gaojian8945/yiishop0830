<?php

use yii\db\Migration;

/**
 * Handles the creation of table `class`.
 */
class m171224_093527_create_class_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('class', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment("分类名称"),
            'info' => $this->text()->comment("分类介绍"),
            'time' => $this->integer()->comment('最后编辑时间'),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('class');
    }
}
