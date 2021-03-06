<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    //public $imgFile;
    public $code;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','intro','sort'], 'required'],
            //[['imgFile'],'file','extensions' => 'jpg,gif,png','skipOnEmpty'=>true],
            //[['code'],'captcha','captchaAction' => 'admin/captcha'],
            [['sort'],"number"],
            [['status','logo'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'logo' => '商标',
            'sort' => '排序',
            'status' => '是否激活',
        ];
    }
}
