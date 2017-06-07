<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
    <div class="info_bar">
        <b>
            <?=Html::a('详细信息', '#')?>
        </b>
    </div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([
        'options' => ['style'=>'padding-left: 20px;'],
    ]); ?>
    <?php if('seller' == $regtype) {?>
        <?= $form->field($detail, 'description')->widget(\yii\redactor\widgets\Redactor::className(),
            [
                'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['clips', 'fontcolor','imagemanager']
                ]
            ])?>
        <?= $form->field($detail, 'team')->widget(\yii\redactor\widgets\Redactor::className(),
            [
                'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['clips', 'fontcolor','imagemanager']
                ]
            ])?>
        <?= $form->field($detail, 'outwork')->textarea()
            ->label('科研成果:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
        <?=$form ->field($detail, 'seller_id', ['options'=>['style'=>'display:none']])?>
    <?php } else {?>
        <?= $form->field($detail, 'description')->textarea()->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
        <?= $form->field($detail, 'direction')->textarea()->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
        <?= $form->field($detail, 'education')->textarea()->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
        <?= $form->field($detail, 'work')->textarea()->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
        <?= $form->field($detail, 'project')->textarea()->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
        <?= $form->field($detail, 'research')->widget(\yii\redactor\widgets\Redactor::className(),
            [
                'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['clips', 'fontcolor','imagemanager']
                ]
            ])?>
        <?= $form->field($detail, 'award')->widget(\yii\redactor\widgets\Redactor::className(),
            [
                'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['clips', 'fontcolor','imagemanager']
                ]
            ])?>
        <?=$form ->field($detail, 'expert_id', ['options'=>['style'=>'display:none']])?>
    <?php }?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>