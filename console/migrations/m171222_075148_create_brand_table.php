<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m171222_075148_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(50)->notNull(),
            'intro'=>$this->text(),
            'logo' => $this->string(100),
            'sort' => $this->integer()->comment('排序'),
            'status' => $this->integer()->comment('1->激活 2->不激活')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
