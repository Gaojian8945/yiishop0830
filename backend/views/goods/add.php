<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<div class="add">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'sn') ?>
    <?= $form->field($model, 'category_id')->dropDownList($categoryArr) ?>

    <?= $form->field($model, 'brand_id')->dropDownList($brandsArr) ?>
    <?= $form->field($model, 'market_price') ?>

    <?= $form->field($model, 'is_on_sale')->radioList([0=>'是',1=>'否']) ?>
    <?= $form->field($model, 'status')->radioList([0=>'隐藏',1=>'显示']) ?>
    <?= $form->field($model, 'sort') ?>
    <?= $form->field($model, 'inputtime')->hiddenInput() ?>
    <?= $form->field($model, 'shop_price') ?>
    <?= $form->field($model, 'logo')->widget('manks\FileInput', [
    ]); ?>
    <?= $form->field($model, 'imgFiles')->widget('manks\FileInput', [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],

            'server' => \yii\helpers\Url::to(['goods/uploadone']),
            // 'accept' => [
            // 	'extensions' => 'png',
            // ],
        ],
    ]); ?>
    <?= $form->field($intro, 'content')->widget('kucha\ueditor\UEditor',[]); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- add -->
