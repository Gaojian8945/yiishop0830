<?php
//表单开始
$from = \yii\bootstrap\ActiveForm::begin();
echo $from->field($model,'name')->textInput();
echo $from->field($model,'intro')->textarea();
echo $from->field($model,'status')->radioList([0=>'是',1=>'否']);
echo $from->field($model,'sort');
echo $from->field($model,'is_help')->radioList([0=>'是',1=>'否']);
echo \yii\bootstrap\Html::submitButton("提交",['class'=>"btn btn-info"]);
\yii\bootstrap\ActiveForm::end();
?>