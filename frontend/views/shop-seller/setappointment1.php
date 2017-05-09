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
	#setappoint{
		width:370px;
		float:left;
		padding:0;
	}
	#calendar {
		width:600px;
		float:left;
		padding:0;
	}
	h2, .h2 {
	    font-size: 18px;
	}
	a.fc-day-number {
		pointer-events: none;
	}
	.fc-event-container a
	{
		height:50px;
	}
	.fc-day-grid-event .fc-content {
		padding-top:5px;
		font-size:12px;
		    white-space: pre-line;
		text-align:center;
	}
</style>

<script type="text/javascript">

$(document).ready(function() {

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: ''
		},
		theme: true,
		monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
		dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
		today: ["今天"],
		firstDay: 1,
		weekNumbers:true,
		buttonText: {
           	today: '本月',
           	month: '月',
			week: '周',
            day: '日',
           	prev: '向前',
           	next: '向后'
		},
		navLinks: true, // can click day/week names to navigate views
		editable: false,
		events: [
			<?php foreach($datainfo as $mm):?>
			{
				title: "预约设定数量:<?= $mm->numoftime1?>,可预约数量: <?= $mm->numoftime1-$mm->num1;?>",
				start: "<?= $mm->appointdate;?>T00:00:00",
				end: "<?= $mm->appointdate;?>T24:00:00",
				allDay: false,
                <?php if (($mm->numoftime1-$mm->num1)>0):?>
				color: '#00CC33',
				
					<?php endif?>
                <?php if (($mm->numoftime1-$mm->num1)==0):?>
				color: '#116Fb5',
				
					<?php endif?>
			},
			<?php endforeach; ?>
		],
		displayEventTime: false,
		visibleRange: {
	        start: '2017-04-22',
	        end: '2017-04-25'
	    }
	});
});

</script>
<div class="sellerinfo">
<div id="setappoint">
    <p>设定预约信息</p>
        <?php $form = ActiveForm::begin(['id' => 'form-setappointment',
			'fieldConfig' => [
					'template' => "{label}<div style='width: 150px'>{input}</div>{error}",
			],]); ?>
            <?= $form->field($model, 'goodid')->textInput(['autofocus' => true])->label("商品 ID") ?>
            <?= $form->field($model, 'appointdate')->widget(
				DatePicker::className(), [
				'language' => 'zh-CN',
				'addon' => false,
				// modify template for custom rendering
				'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
					//	'template' => '{input}',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'yyyy-mm-dd',
					'pickButtonIcon' => 'glyphicon glyphicon-time',
				]
			])->label("日      期")?>
            <?= $form->field($model, 'numoftime1')->textInput(['maxlength' => 20])->label("设定预约数量") ?>
			<?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'setappointment-button']) ?>
        <?php ActiveForm::end(); ?>
</div>
 <p>该商品的预约设定信息：</p> 
<div id='calendar'></div>
</div>