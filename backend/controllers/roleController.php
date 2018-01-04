<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        //显示角色 把所有角色查出来
        $roles = $authManager->getRoles();

        //var_dump($Permission);exit;
        return $this->render('index',compact('roles'));
    }

    public function actionAdd(){
        $model = new AuthItem();

        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;

        $pres = $authManager->getPermissions();
        $presArr = ArrayHelper::map($pres,'name','description');

        if($model->load(\Yii::$app->request->post())&&$model->validate()){

            //创建角色
            $role = $authManager->createRole($model->name);
            //添加描述
            $role->description=$model->description;
            //添加权限 把权限添加到数据库
            if ($authManager->add($role)) {

                if($model->permissions){
                    //给角色添加权限
                    foreach ($model->permissions as $perName){
                        $permission = $authManager->getPermission($perName);
                        $authManager -> addChild($role,$permission);
                    }
                }
                \Yii::$app->session->setFlash('success','创建权限'.$model->description.'成功');
                //4.刷新成功
                return $this->refresh();
            }
        }
        return $this->render('add',compact('model','presArr'));
    }
    public function actionEdit($name){
        $model = AuthItem::findOne($name);//
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;//

        $request = \Yii::$app->request;
        //得到所以权限
        $pres = $authManager->getPermissions();
        $presArr = ArrayHelper::map($pres,'name','description');
        if($model->load($request->post())&&$model->validate()){
            //创建角色
            $role = $authManager->createRole($model->name);
            //添加描述
            $role->description=$model->description;
            //添加权限 把角色添加到数据库
            //var_dump($model->getErrors());exit;
            if ($authManager->update($name,$role)) {

                //删除当角角所对应的权限  删除角色对应的所有权限
                $authManager->removeChildren($role);
                //给角色添加权限
                if($model->permissions){
                    foreach ($model->permissions as $perName){
                        $permission = $authManager->getPermission($perName);
                        $authManager -> addChild($role,$permission);
                    }
                }
                \Yii::$app->session->setFlash('success','修改权限'.$model->description.'成功');
                //4.刷新成功
                return $this->refresh();
            }
        }
        //当前角色所对应的权限 通过角色找权限
        $roles=$authManager->getPermissionsByRole($name);

        //var_dump($roles);exit;

        //取出所有权限的key值
        $model->permissions=array_keys($roles);
        return $this->render('add',compact('model','presArr'));
    }

    public function actionDel($name){

        //实例化authManager组件
        $auth = \Yii::$app->authManager;

        //1.找到要删除的角色
        $role=$auth->getRole($name);
        //2.删除角色所对应的所有权限
        $auth->removeChildren($role);
        //3.删除角色
        if ($auth->remove($role)) {
            return $this->redirect(['index']);
        }
    }
}
