<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
use dosamigos\datepicker\DatePicker;
?>
<?= Html::jsFile('@web/assets/57c9d7e8/jquery.js') ?>
<?php 
AppAsset::register($this);
AppAsset::addCss($this,Yii::$app->request->baseUrl."/fullcalendar.css");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/moment.min.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/fullcalendar.min.js");

?>
<style type="text/css">
	#calendar {
		width:500px;
		float:right;
			
	}
	h2, .h2 {
	    font-size: 18px;
	}
</style>

<script type="text/javascript">
</script>
<div class="sellerinfo">
     <?php $form = ActiveForm::begin(['id' => 'form-setappointment',
			 'fieldConfig' => [
					 'template' => "{label}<div style='width: 150px'>{input}</div>{error}",
			 ],]); ?>
         	<?= $form->field($model, 'goodid')->textInput(['autofocus' => true])->label("商品id") ?>
         	<?= $form->field($model, 'appointdate')->widget(
				 DatePicker::className(), [
					'language' => 'zh-CN',
					'addon' => false,
					'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
					'clientOptions' => [
					'autoclose' => true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					'pickButtonIcon' => 'glyphicon glyphicon-time',
				]
			])->label("日      期")?>
         	<?= $form->field($model, 'numoftime1')->textInput(['maxlength' => 20])->label("设定预约数量") ?>
         	<?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'setappointment-button']) ?>
     <?php ActiveForm::end(); ?>
     <p id="hint"><?= Html::encode($hintinfo); ?> </p>
	<div id='calendar'> </div>
</div>