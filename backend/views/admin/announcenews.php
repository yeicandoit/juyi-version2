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
        <?=Html::a('新闻发布', '#', ['onclick'=>'showBasicInfo()'])?>&nbsp;&nbsp;
        <?=Html::a('SEO优化', '#', ['onclick'=>'showSeo()'])?>
    </b>
</div>
<div style="height:60px;color:red;text-align:center"> <?= Html::encode($info)?> </div>

  <?php $form = ActiveForm::begin(['options' => ['style'=>'padding-left: 20px;']]); ?>

    <div id="basicInfo">
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
        ]) ->label('新闻内容')?>
    <?=Html::button('下一步', [ 'style' => 'width:100px;', 'class'=>'btn btn-large btn-primary', 'onclick'=>'showSeo()'])?>
    </div>

    <div id="seo" style="display: none;">
        <?= $form->field($model, 'keywords')->textInput()?>
        <?= $form->field($model, 'description')->textarea()?>
        <?= Html::submitButton('确定', [ 'style' => 'width:50px;', 'class'=>'btn btn-primary'])?>
        <?= Html::resetButton('重置', [ 'style' => 'width:50px;', 'class'=>'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    function showBasicInfo()
    {
        $("#basicInfo").show();
        $("#seo").hide();
    }
    function showSeo()
    {
        $("#seo").show();
        $("#basicInfo").hide();
    }
</script>
