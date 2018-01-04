<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AuthItem;
use backend\models\LoginForm;
use function PHPSTORM_META\map;
use function Sodium\crypto_box_publickey_from_secretkey;
use yii\console\Request;
use yii\helpers\ArrayHelper;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Admin::find()->all();
        return $this->render('index',compact('models'));
    }

    public function actionAdd(){

        //实例化模型对象
        $admin = new Admin();
        //
        $request =\Yii::$app->request;
        //获取角色
        $auth = \Yii::$app->authManager;
        $authArr = ArrayHelper::map($auth->getRoles(),'name','description');
//        echo '<pre>';
//        var_dump($request->post());exit;


        if($request->isPost){
//            var_dump($admin->load($request->post()));exit;
            if ($admin->load($request->post())) {
                //加密
                //var_dump($admin->rulea);exit;
                $admin->password_hash=\Yii::$app->security->generatePasswordHash($admin->password_hash);
                //随机字符串
                $admin->auth_key=\Yii::$app->security->generateRandomString();
                //ip
                $admin->last_login_ip=ip2long(\Yii::$app->request->userIP);
                //保存
                if ($admin->save()) {
                    \Yii::$app->session->setFlash('success','注册成功');
                    \Yii::$app->user->login($admin,3600*24*7);
                    //找到角角
                    $role=$auth->getRole($admin->rulea);
                    //给用户分组
                    if ($auth->assign($role,$admin->id)) {
                        \Yii::$app->session->setFlash('success','绑定权限成功');
                    }
                    return $this->redirect(['index']);
                }else{
                    var_dump($admin->getErrors());exit;
                }
            }
        }
        return $this->render('add',compact('admin','authArr'));

    }
    public function actionEdit($id){
        //实例化模型对象
        $admin = Admin::findOne($id);
        //
        $request = \Yii::$app->request;
        //获取角色
        $auth = \Yii::$app->authManager;
        $authArr = ArrayHelper::map($auth->getRoles(),'name','description');
        if($request->isPost){

            if ($admin->load($request->post())) {

                //加密
                $admin->password_hash=\Yii::$app->security->generatePasswordHash($admin->password_hash);
                //随机字符串
                $admin->auth_key=\Yii::$app->security->generateRandomString();
                //ip
                $admin->last_login_ip=ip2long(\Yii::$app->request->userIP);

                //保存
                if ($admin->save()) {

                    \Yii::$app->user->login($admin,3600*24*7);
                    //找到角色对应的权限
                    $role=$auth->getRole($admin->rulea);
                    //给用户分组
                    if ($auth->assign($role,$admin->id)) {
                        \Yii::$app->session->setFlash('success','编辑成功');
                    }
                    return $this->redirect(['index']);
                }else{
                    var_dump($admin->getErrors());exit;
                }
            }
        }
        return $this->render('add',compact('admin','authArr'));
    }

    public function actionLogin()
    {
        //判断用户是否登录

        if (!\Yii::$app->user->isGuest) {

            return $this->redirect(['index']);
        }
        //实例化表单模型
        $model = new LoginForm();

        //判断是不是post提交
        $request = \Yii::$app->request;

        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {

                //根据用户名把用户对象查出来
                $admin = Admin::findOne(['username'=>$model->username]);

                if($admin){
                    //判断密码
                    if(\Yii::$app->security->validatePassword($model->password,$admin->password_hash)){
                        //执行登陆
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        //4.修改登录IP和时间
                        $admin->last_login_at=time();
                        $admin->last_login_ip=ip2long(\Yii::$app->request->userIP);
                        $admin->save();
                        //跳转
                        return $this->redirect('index');
                    }else{
                        //密码错误
                        $model->addError('password','密码错误');
                    }
                }else{
                    //不存在 提示没用的用户名
                    $model->addError('username','用户名不存在');
                }

            }else{
                var_dump($model->errors);exit;
            }
        }
        //显示视图
        return $this->render('login',compact('model'));
    }

    public function actionLogout(){
        if (\Yii::$app->user->logout()) {
            return $this->redirect(['login']);
        }
    }
}
