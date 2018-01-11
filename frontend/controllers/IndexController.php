<?php
/**
 * Created by PhpStorm.
 * User: gaojianli
 * Date: 2018/1/10
 * Time: 15:03
 */

namespace frontend\controllers;


use yii\web\Controller;

class IndexController extends Controller
{

    public function actionIndex(){
        return $this->render('index');
    }
}