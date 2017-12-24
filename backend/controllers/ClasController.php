<?php

namespace backend\controllers;

use backend\models\Clas;

class ClasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $rows = Clas::find()->all();

        return $this->render('index',compact("rows"));
    }

    public function actionAdd(){
        $rows = new Clas();
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $rows->load($request->post());
            $rows->time=time();
            //验证
            if($rows->validate()){
                //保存数据
                $rows->save();
                \Yii::$app->session->setFlash("info",'添加成功');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("add",compact('rows'));
    }
    public function actionEdit($id){
        $rows = Clas::findOne($id);
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $rows->load($request->post());
            $rows->time=time();
            //验证
            if($rows->validate()){
                //保存数据
                $rows->save();
                \Yii::$app->session->setFlash("info",'修改成功');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("add",compact('rows'));
    }

}
