<?php
/**
 * Created by PhpStorm.
 * User: gaojianli
 * Date: 2017/12/26
 * Time: 11:25
 */
namespace backend\assembly;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}