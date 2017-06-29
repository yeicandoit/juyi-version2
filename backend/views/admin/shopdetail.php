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
    <?php $option = [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ];?>
    <?php if('expert' != $regtype) {?>
        <?= $form->field($detail, 'reserve1')->textarea()?>
        <?= $form->field($detail, 'description')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'team')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'outwork')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
    <?php } else {?>
        <?= $form->field($detail, 'description')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'direction')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'education')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'work')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'project')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'research')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
        <?= $form->field($detail, 'award')->widget(\yii\redactor\widgets\Redactor::className(), $option)?>
    <?php }?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>
