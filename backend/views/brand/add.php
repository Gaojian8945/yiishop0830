<?php
//表单开始
$from = \yii\bootstrap\ActiveForm::begin();
echo $from->field($brand,'name')->textInput();
echo $from->field($brand,'intro')->textarea();
echo $from->field($brand,'sort')->textInput();
echo $from->field($brand,'logo')->widget('manks\FileInput', [
]);
echo $from->field($brand,'status')->radioList([1=>"激活",2=>"不激活"]);

echo \yii\bootstrap\Html::submitButton("提交",['class'=>"btn btn-info"]);

\yii\bootstrap\ActiveForm::end();
?>
