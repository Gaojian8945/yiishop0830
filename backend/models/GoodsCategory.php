<?php

namespace backend\models;

use backend\assembly\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 */
class GoodsCategory extends \yii\db\ActiveRecord
{

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }


    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['parent_id', 'tree', 'lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'required'],//'tree', 'lft', 'rgt', 'depth'
            [['intro'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'parent_id' => '父类id',
            'tree' => '树',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '深度',
        ];
    }

}
