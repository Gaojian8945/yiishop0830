<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        //显示权限 把所有权限查出来
        $permissions = $authManager->getPermissions();

        //var_dump($Permission);exit;
        return $this->render('index',compact('permissions'));
    }

    public function actionAdd(){
        $model = new AuthItem();
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        $request = \Yii::$app->request;
        if($model->load($request->post())&&$model->validate()){

            //创建权限
            $permission = $authManager->createPermission($model->name);
            //添加描述
            $permission->description=$model->description;

           // var_dump($permission->description);exit;
            //添加权限 把权限添加到数据库
            if ($authManager->add($permission)) {
                \Yii::$app->session->setFlash('success','创建权限'.$model->description.'成功');
                //4.刷新成功
                return $this->refresh();
            }
        }
        return $this->render('add',compact('model'));
    }
    public function actionEdit($name){
        $model = AuthItem::findOne($name);
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        $request = \Yii::$app->request;
        if($model->load($request->post())&&$model->validate()){
            //找到对于权限
            $permission = $authManager->getPermission($model->name);
            if($permission){
                //添加描述
                $permission->description=$model->description;
                //添加入库
                if ($authManager->update($name,$permission)) {
                    \Yii::$app->session->setFlash('success','创建权限'.$model->description.'成功');
                    //4.跳转列表
                    return $this->redirect('index');
                }
            }
        }
        return $this->render('edit',compact('model'));
    }

    public function actionDel($name)
    {
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;

        //找到对象权限
        $permission = $authManager->getPermission($name);

        //删除对象
        if ($authManager->remove($permission)) {
            return $this->redirect('index');
        }
    }

}
