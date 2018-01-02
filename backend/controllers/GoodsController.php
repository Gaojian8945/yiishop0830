<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
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

        $rows = Goods::find()->orderBy('id');
//根据搜索条件
        $request=\Yii::$app->request;
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        $keyword=$request->get('keyword');
        $status=$request->get('status');
        if ($minPrice){
            $rows->andWhere("shop_price>={$minPrice}");
        }
        if ($maxPrice){
            $rows->andWhere("shop_price<={$maxPrice}");
        }
        if ($keyword){
            $rows->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }
        if ($status==='1'){
            $rows->andWhere('status=1');
        }
        $pages = new Pagination(
            [
                'totalCount' => $rows->count('*'),
                'pageSize' => 2
            ]
        );
        $rows = $rows->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index',compact('rows','pages'));
    }

    public function actionAdd()
    {
        $model = new Goods();
        //把所有商品品牌给传过来
        $brands=Brand::find()->all();
        $brandsArr = ArrayHelper::map($brands,'id','name');
        //把所有商品分类给传过来
        $category=GoodsCategory::find()->orderBy('tree,lft')->all();
        $categoryArr=ArrayHelper::map($category,'id','name');
        $intro = new GoodsIntro();
        $request = \Yii::$app->request;
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //编码验证
            if(empty($model->sn)){
                //自动生成编码 20171229 0000
                $timeStart = strtotime(date('Ymd'));
                //查询今天创建的所有商品数量
                $count = Goods::find()->where("inputtime>='{$timeStart}'")->count();
                $count = $count+1;
                //拼接
                $count = substr('000'.$count,-4);
                $model->sn = date('Ymd').$count;
            }
            //后端验证
            if ($model->validate()) {
                //goods绑定数据
                if ($model->save()) {
                    //保存商品详情
                    $intro->load($request->post());
                    $intro->goods_id=$model->id;
                    $intro->save();

                    //保存多图
                    foreach ($model->imgFiles as $img){
                        //实力话对象
                        $goodsGallery = new GoodsGallery();
                        //批量赋值
                        $goodsGallery->goods_id=$model->id;
                        $goodsGallery->path=$img;
                        //保存
                        $goodsGallery->save();
                    }

                    return $this->redirect('index');
                }
            }
            echo '<pre>';
            var_dump($model);exit;
        }


        return $this->render('add',compact('model','intro','categoryArr','brandsArr'));
    }
    public function actionEdit($id)
    {
        $model = Goods::findOne($id);
        //把所有商品品牌给传过来
        $brands=Brand::find()->all();
        $brandsArr = ArrayHelper::map($brands,'id','name');
        //把所有商品分类给传过来
        $category=GoodsCategory::find()->orderBy('tree,lft')->all();
        $categoryArr=ArrayHelper::map($category,'id','name');
        //详情
        $intro = GoodsIntro::findOne(['goods_id'=>$id]);
        //查出当前商品所对应的所有图片
        $goodsImgs=GoodsGallery::find()->where(['goods_id'=>$id])->asArray()->all();

        //把处理好的一维数组赋值给imgFiles属性
        $model->imgFiles=array_column($goodsImgs,'path');
        $request = \Yii::$app->request;
        if($request->isPost){
            //绑定数据
//            echo '<pre>';
//            var_dump($request->post());
            $model->load($request->post());

            //var_dump($model->logo);exit;
            //编码验证
            if(empty($model->sn)){
                //自动生成编码 20171229 0000
                $timeStart = strtotime(date('Ymd'));
                //查询今天创建的所有商品数量
                $count = Goods::find()->where("inputtime>='{$timeStart}'")->count();
                $count = $count+1;
                //拼接
                $count = substr('000'.$count,-4);
                $model->sn = date('Ymd').$count;
            }
            //后端验证
            if ($model->validate()) {
                //goods存储数据
                if ($model->save()) {
                    //保存商品详情
                    $intro->load($request->post());
                    $intro->goods_id=$model->id;
                    $intro->save();

                    //保存多图

                    foreach ($model->imgFiles as $img){
                        //实力话对象
                        $goodsGallery = new GoodsGallery();
                        //批量赋值
                        $goodsGallery->goods_id=$model->id;
                        $goodsGallery->path=$img;
                        //保存
                        $goodsGallery->save();
                    }

                    return $this->redirect('index');
                }
            }
            echo '<pre>';
            var_dump($model);exit;
        }


        return $this->render('add',compact('model','intro','categoryArr','brandsArr'));
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
    public function actionDel($id){
        Goods::findOne($id)->delete();
        GoodsIntro::findOne(['goods_id'=>$id])->delete();
        GoodsGallery::findOne(['goods_id'=>$id])->delete();
        $this->redirect('index');
    }
}
