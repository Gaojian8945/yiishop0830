<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    public function actionIndex()
    {
        $models =Article::find()->where(['status'=>1])->all();
         $status = \Yii::$app->request->get('status');
         $id = \Yii::$app->request->get('id');
         if($status !=null && $id!=null){
             $row = Article::findOne($id);
             $row->status=$status;
             $row->save();
             $this->redirect('index');
         }

        return $this->render('index',compact('models'));
    }
    public function actionRecycle(){
        $models =Article::find()->where(['status'=>0])->all();
        $status = \Yii::$app->request->get('status');
        $id = \Yii::$app->request->get('id');
        if($status !=null && $id!=null){
            $row = Article::findOne($id);
            $row->status=$status;
            $row->save();
            $this->redirect('recycle');
        }
        return $this->render('index',compact('models'));
    }
    public function actionAdd()
    {
        //实例化
        $model = new Article;
        $detail = new ArticleDetail();
        //得到所有分类
        $cates=ArticleCategory::find()->asArray()->all();
        //转换成键值对
        $catesArr=ArrayHelper::map($cates,'id','name');
        //实例化request
        $resquest = \Yii::$app->request;
        //判断是否是post提交
        if ($resquest->isPost) {
            //var_dump($resquest->post());exit;
            $model->load($resquest->post());
            if ($model->validate()) {
                $model->save();
                $this->redirect('index');
            }
            //文章详情入库
            if ($detail->load($resquest->post())) {
                $detail->article_id=$model->id;
                if ($detail->save()) {
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add',compact('model','catesArr','detail'));
    }
    public function actionEdit($id)
    {
        //实例化
        $model =Article::findOne($id);
        $detail = ArticleDetail::findOne(['article_id'=>$id]);
        //得到所有分类
        $cates=ArticleCategory::find()->asArray()->all();
        //转换成键值对
        $catesArr=ArrayHelper::map($cates,'id','name');
        //实例化request
        $resquest = \Yii::$app->request;
        //判断是否是post提交
        if ($resquest->isPost) {
            $model->load($resquest->post());
            if ($model->validate()) {
                $model->save();
                $this->redirect('index');
            }
            //文章详情入库
            if ($detail->load($resquest->post())) {
                $detail->article_id=$model->id;
                if ($detail->save()) {
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add',compact('model','catesArr','detail'));
    }

    public function actionDel($id){
        if (Article::findOne($id)->delete()) {
            \Yii::$app->session->setFlash("success",'删除成功');
            return $this->redirect(['index']);
        }
    }
}
