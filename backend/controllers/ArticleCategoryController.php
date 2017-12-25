<?php

namespace backend\controllers;

use backend\models\ArticleCategory;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //获取数据
        $models = ArticleCategory::find()->all();
        return $this->render('index',compact('models'));
    }

    public function actionAdd()
    {
        //实例化
        $model = new ArticleCategory;
        //实例化request
        $resquest = \Yii::$app->request;
        //判断是否是post提交
        if ($resquest->isPost) {
            $model->load($resquest->post());
            if ($model->validate()) {
                $model->save();
                $this->redirect('index');
            }
        }
        return $this->render('add',compact('model'));
    }
    public function actionEdit($id)
    {
        //实例化
        $model = ArticleCategory::findOne($id);

        //实例化request
        $resquest = \Yii::$app->request;
        //判断是否是post提交
        if ($resquest->isPost) {
            $model->load($resquest->post());
            if ($model->validate()) {
                $model->save();
                $this->redirect('index');
            }
        }
        return $this->render('add',compact('model'));
    }

    public function actionDel($id){
        if (ArticleCategory::findOne($id)->delete()) {
            \Yii::$app->session->setFlash("success",'删除成功');
            return $this->redirect(['index']);
        }
    }
}
