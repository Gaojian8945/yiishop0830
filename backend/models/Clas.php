<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Clas".
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property integer $time
 */
class Clas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Clas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'info' => '分类介绍',
            'time' => '最后编辑时间',
        ];
    }
}
