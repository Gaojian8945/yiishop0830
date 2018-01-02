<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $category_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord
{
    public $imgFiles;//显示多图
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'market_price','brand_id'], 'required'],
            [['market_price', 'shop_price'], 'number'],
            [['imgFiles','logo'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '商品编号',
            'logo' => '商品图片',
            'category_id' => '分类id',
            'market_price' => '市场价格',
            'shop_price' => '本店的价格',
            'stock' => '股票',
            'is_on_sale' => '是否有优惠',
            'status' => '状态：0 假 1 真',
            'sort' => '排序',
            'inputtime' => '入库时间',
        ];
    }

    public function getGoodsIntro()
    {
        $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);
    }

    public function getGoodsGallery(){
        $this->hasMany(GoodsGallery::className(),['goods_id'=>'id']);
    }
}
