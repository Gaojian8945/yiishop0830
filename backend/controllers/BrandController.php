<?php

namespace backend\controllers;



use backend\models\Brand;
use flyok666\qiniu\Qiniu;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $branks = Brand::find()->all();
        return $this->render('index',compact('branks'));
    }

    public function actionAdd(){
        $brand = new Brand();
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if ($request->isPost) {
            //var_dump($request->post());exit;
            //绑定数据
            $brand->load($request->post());
            //验证
            if($brand->validate()){
                //保存数据
                $brand->save();
                \Yii::$app->session->setFlash("info",'添加成功');
                return $this->redirect(["index"]);
            }
            /*//得到上传对象
            $brand->imgFile=UploadedFile::getInstance($brand,'imgFile');
            $brand->logo="";
            //echo "/imgs/".time().".".$brand->imgFile->extension;exit;//拼文件上传路径
            //var_dump($request->post());exit;
             $imgPath =  "/imgs/".time().".".$brand->imgFile->extension;
            if($brand->validate()===false){
                //TODO 修改错误
                var_dump($brand->getErrors());exit;
            }
            //var_dump($path);exit;
            //移动临时文件到网站根目录下
            $uploadResult = $brand->imgFile->saveAs(\yii::getAlias('@webroot').$imgPath,false);
            if ($uploadResult) {
                //后台数据验证
                if ($brand->validate()) {
                    //验证通过 保存数据
                    $brand->logo=$imgPath;
                    if ($brand->save()) {
                        //跳转
                        return $this->redirect(['index']);
                    }
                }
            }*/
        }
        return $this->render("add",compact('brand'));
    }

    public function actionEdit($id){
        $brand = Brand::findOne($id);
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $brand->load($request->post());
            //验证
            if($brand->validate()){
                //保存数据
                $brand->save();
                \Yii::$app->session->setFlash("info",'添加成功');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("add",compact('brand'));
    }

    /*public function actionEdit($id){
        $brand = Brand::findOne($id);
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if ($request->isPost) {
//绑定数据
            $brand->load($request->post());
            //得到上传对象
            $brand->imgFile=UploadedFile::getInstance($brand,'imgFile');
            //设置logo的初始值为空
            $brand->logo="";
            if($brand->imgFile!=null){
                //echo "/imgs/".time().".".$brand->imgFile->extension;exit;//拼文件上传路径
                //var_dump($request->post());exit;
                $imgPath =  "/imgs/".time().".".$brand->imgFile->extension;
                if($brand->validate()===false){
                    //TODO 修改错误
                    var_dump($brand->getErrors());exit;
                }
                //var_dump($path);exit;
                //移动临时文件到网站根目录下
                $uploadResult = $brand->imgFile->saveAs(\yii::getAlias('@webroot').$imgPath,false);
                if ($uploadResult) {
                    //后台数据验证
                    if ($brand->validate()) {
                        //验证通过 保存数据
                        $brand->logo=$imgPath;
                        if ($brand->save()) {
                            //跳转
                            return $this->redirect(['index']);
                        }
                    }
                }
            }else{
                //后台数据验证
                if ($brand->validate()) {
                    //验证通过 保存数据
                    if ($brand->save()) {
                        //跳转
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        return $this->render("add",compact('brand'));
    }*/

    public function actionUpload(){
        //var_dump($_FILES);exit;
        $file = UploadedFile::getInstanceByName("file");
        //var_dump($file);exit;
        if ($file) {
            //路径
            $path="imgs/".time().".".$file->extension;
            //移动图片
            if ($file->saveAs($path,false)) {
                // {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}

                $result=[
                    'code'=>0,
                    'url'=>'/'.$path,
                    'attachment'=>$path

                ];
                return json_encode($result);
            }

        }



    }
    public function actionDel($id){
        if (Brand::findOne($id)->delete()) {
            \Yii::$app->session->setFlash("success",'删除成功');
            return $this->redirect(['index']);
        }
    }

}
