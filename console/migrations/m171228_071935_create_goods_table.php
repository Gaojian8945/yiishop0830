<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171228_071935_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('商品名称'),
            'sn' => $this->string(50)->notNull()->comment('商品编号'),
            'logo' => $this->string(50)->defaultValue('imgs/1514213808.jpg')->comment('商品图片'),
            'category_id' => $this->integer()->notNull()->comment('分类id'),
            'market_price' => $this->decimal()->notNull()->comment('市场价格'),
            'shop_price' => $this->decimal()->comment('本店的价格'),
            'stock' => $this->integer()->comment('股票'),
            'is_on_sale' => $this->integer()->comment('是否有优惠'),
            'status' => $this->integer()->comment('状态：0 假 1 真'),
            'sort' => $this->integer()->comment('排序'),
            'inputtime' => $this->integer()->comment('入库时间')

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
