<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code_id', 'status'], 'required'],
            [['code_id', 'status', 'sort', 'create_time'], 'integer'],
            [['name', 'intro'], 'string', 'max' => 255],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT=>['create_time'],//自动插入创建时间
                ]
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名称',
            'code_id' => '分类id',
            'intro' => '简介',
            'status' => '状态：0=显示 1隐藏',
            'sort' => '排序',
            'create_time' => '创建时间',
        ];
    }
    //对应文章分类 1对1
    public function getCateName(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'code_id']);
    }

}
