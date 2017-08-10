<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\redactor\widgets\Redactor;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
	<div class="info_bar">
		<b>
			<?=Html::a('新闻发布', '#')?>
		</b>
	</div>
<div style="height:60px;color:red;text-align:center"> <?= Html::encode($info)?> </div>
    <?php $form = ActiveForm::begin(['options' => ['style'=>'padding-left: 20px;'],]); ?>
    <?= $form->field($model, 'title')->textInput(['autofocus' => true])->label('标题') ?>
    <?= $form->field($model, 'content')->widget(Redactor::className(),
        [
            'clientOptions' => [
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
                'fileUpload' => ['/redactor/upload/file'],
                'lang' => 'zh_cn',
                'plugins' => ['clips', 'fontcolor','imagemanager']
            ]
        ]) ->label('资讯内容')?>
    <div style="width:300px;margin:auto">     <?= Html::submitButton('发布资讯', ['class' => 'btn btn-primary', 'name' => 'announce-button']) ?></div>
    <?php ActiveForm::end(); ?>
</div>

