<?php
/**
 * Created by PhpStorm.
 * User: gaojianli
 * Date: 2018/1/1
 * Time: 15:15
 */

namespace frontend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $checkCode;
    
    public function rules()
    {
        return [
            [['username','password','checkCode'],'required'],
            [['rememberMe'],'safe'],
            //['checkCode','captcha','captchaAction' =>'/user/captcha' ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password_hash' => '密码'
        ];
    }


}