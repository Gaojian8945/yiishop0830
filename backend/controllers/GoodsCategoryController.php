<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\helpers\Json;

class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $rows = GoodsCategory::find()->orderBy('tree,lft')->all();
        return $this->render('index',compact('rows'));
    }

    public function actionAdd()
    {
        $model = new GoodsCategory();

        $rows = GoodsCategory::find()->asArray()->all();
        $rows[]=['id'=>0,'name'=>'一级目录','parent_id'=>0];

        $rows = Json::encode($rows);
        //var_dump($rows);exit;
        //var_dump(json_encode($rows));exit;
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            if($model->parent_id==null){
                $model->parent_id=0;
            }
            //后端验证
            if ($model->validate()) {
                //添加一级分类
                if ($model->parent_id=='0'){
                    $model -> makeRoot();
                }else{
                    $modelprend = GoodsCategory::findOne($model->parent_id);
                    $model -> prependTo($modelprend);
                }
            }
            return $this->redirect('index');
        }
        return $this->render('add', ['model' => $model,'rows'=>$rows]);
    }
    public function actionEdit($id)
    {
        $model = GoodsCategory::findOne($id);

        $rows = GoodsCategory::find()->asArray()->all();
        //var_dump(json_encode($rows));exit;
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            //后端验证
            if ($model->validate()) {
                //添加一级分类
                if ($model->parent_id=='0'){
                    $model -> makeRoot();
                }else{
                    $modelprend = GoodsCategory::findOne($model->parent_id);
                    $model -> prependTo($modelprend);
                }
            }
            return $this->redirect('index');
        }
        return $this->render('add', ['model' => $model,'rows'=>$rows]);
    }
    public function actionDel($id){
        //查询子类数量
        $num = GoodsCategory::find()->where(['parent_id'=>$id])->count('*');
        if($num>0){
            \Yii::$app->session->setFlash("success",'删除失败，该类下面还有子类');
            return $this->redirect(['index']);
        }else{
            if (GoodsCategory::findOne($id)->delete()) {
                \Yii::$app->session->setFlash("success",'删除成功');
                return $this->redirect(['index']);
            }
        }
    }

}
