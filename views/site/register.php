<?php 
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<h1>Регистрация</h1>



<?php $f=ActiveForm::begin(['id'=>'register-form','options'=>[
	'class'=>'form-horizontal'],
	'fieldConfig'=>[
		'options'=>['class'=>'row form-group'],
		'template'=>'{label}test<div class="col-sm-3">{input}</div>{error}',
		'parts'=>[
			'test'=>'<div class="col-sm-1 ico glyphicon control-label"></div>'
		],
		'labelOptions'=>['class'=>'col-sm-2 control-label'],
		'inputOptions'=>['class'=>'form-control',],
		'errorOptions'=>['class'=>'col-sm-6 help-block',],
		

	]]); ?>
<?=$f->field($m,'name',['enableAjaxValidation'=>true,'inputOptions'=>['autofocus'=>true]]);?>
<?=$f->field($m,'fn');?>
<?=$f->field($m,'ln');?>
<?=$f->field($m,'mail',['enableAjaxValidation'=>true,]);?>
<?=$f->field($m,'pass');?>
<div class="form-group row">
	<div class="col-sm-3 col-sm-offset-3"><?=Html::submitButton('Готово',['class'=>'btn form-control btn-success submitbutt']);?></div>
</div>
<?php ActiveForm::end(); ?>