<?php
//表单开始
$from = \yii\bootstrap\ActiveForm::begin();
echo $from->field($rows,'name')->textInput();
echo $from->field($rows,'info')->textarea();
echo \yii\bootstrap\Html::submitButton("提交",['class'=>"btn btn-info"]);

\yii\bootstrap\ActiveForm::end();
?>