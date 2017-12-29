<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\web\UploadedFile;

class GoodsController extends \yii\web\Controller
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
        $rows =Goods::find()->where(['status'=>1])->all();
        $status = \Yii::$app->request->get('status');
        $id = \Yii::$app->request->get('id');
        if($status !=null && $id!=null){
            $row = Goods::findOne($id);
            $row->status=$status;
            $row->save();
            $this->redirect('index');
        }
        return $this->render('index',compact('rows'));
    }
    public function actionRecycle(){
        $rows =Goods::find()->where(['status'=>0])->all();
        $status = \Yii::$app->request->get('status');
        $id = \Yii::$app->request->get('id');
        if($status !=null && $id!=null){
            $row = Goods::findOne($id);
            $row->status=$status;
            $row->save();
        }
        return $this->render('index',compact('rows'));
    }

    public function actionAdd()
    {
        $model = new Goods();
        $intro = new GoodsIntro();
        $category = GoodsCategory::find()->asArray()->all();
        $request = \Yii::$app->request;
        //判断是否是否是post提交
        if ($request->isPost) {

            //绑定数据
            $model->load($request->post());
            $model->inputtime=time();
            //后端验证
            if ($model->validate()) {
                //goods绑定数据
                if ($model->save()) {
                    echo 11111;
                }
            }
            //intro绑定数据
            echo '<pre>';
            if ($intro->load($request->post())) {
                $intro->goods_id=$model->id;
                if ($intro->save()) {
                    \Yii::$app->session->setFlash("success",'添加数据成功');
                    $this->redirect(['index']);
                }
            }


        }
        return $this->render('add',compact('model','intro','category'));
    }
    public function actionEdit($id)
    {
        $model = Goods::findOne($id);
        $intro = GoodsIntro::findOne(['goods_id'=>$id]);
        $category = GoodsCategory::find()->asArray()->all();
        $request = \Yii::$app->request;
        //判断是否是否是post提交
        if ($request->isPost) {

            //绑定数据
            $model->load($request->post());
            $model->inputtime=time();
            //后端验证
            if ($model->validate()) {
                //goods绑定数据
                if ($model->save()) {
                    echo 11111;
                }
            }
            //intro绑定数据
            echo '<pre>';
            if ($intro->load($request->post())) {
                $intro->goods_id=$model->id;
                if ($intro->save()) {
                    \Yii::$app->session->setFlash("success",'添加数据成功');
                    $this->redirect(['index']);
                }
            }


        }
        return $this->render('add',compact('model','intro','category'));
    }

    public function actionUploadone(){
        //var_dump($_FILES);exit;
        //上传到七牛云
        $config = [
            'accessKey' => '_fsLhygOvZIIenvhewIoaqfy9ZJPimcH6rx8UFMB',//AK
            'secretKey' => 'syICxfqQiUFF0Bgxyzgz_PEfbbybPrB3IBSKSLIc',//SK
            'domain' => 'http://p1nwn1dun.bkt.clouddn.com',//临时域名
            'bucket' => 'yii20830',//空间名称

            'area' => Qiniu::AREA_HUADONG//区域
        ];
//var_dump($_FILES);exit;
        $qiniu = new Qiniu($config);//实例化对象
//var_dump($qiniu);exit;
        $key = time();//上传后的文件名  多文件上传有坑
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);//调用上传方法上传文件
        $url = $qiniu->getLink($key);//得到上传后的地址
        //var_dump($url);exit;
        //返回的结果
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url
        ];
        return json_encode($result);
    }

}
