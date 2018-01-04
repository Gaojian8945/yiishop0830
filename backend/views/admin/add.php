<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form ActiveForm */
?>
<div class="admin-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($admin, 'username') ?>
        <?= $form->field($admin, 'password_hash')->textInput(['value'=>'']) ?>
        <?= $form->field($admin, 'status')->radioList([0=>'不激活',1=>'激活']) ?>
        <?= $form->field($admin, 'email') ?>

        <?= $form->field($admin, 'rulea')->dropDownList($authArr) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-add -->
