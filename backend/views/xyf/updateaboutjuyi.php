<?php
/**
 * Created by PhpStorm.
 * User: xyf
 * Date: 2017/4/13
 * Time: 15:47
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<script type="text/javascript">
    function showItem(id)
    {
        $(".jyabout").hide();
        $("#" + id).show();
    }
</script>
<div class="sellerinfo">
<?=
    Html::dropDownList('',null,$model->item, ['onchange'=>"showItem(this.value)"]);
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'jyjj', ['options'=>['id'=>'jyjj', 'class'=>'jyabout']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'tsfw', ['options'=>['id'=>'tsfw', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'hzgy', ['options'=>['id'=>'hzgy', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'cpyc', ['options'=>['id'=>'cpyc', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'hyzc', ['options'=>['id'=>'hyzc', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'cslc', ['options'=>['id'=>'cslc', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'zffs', ['options'=>['id'=>'zffs', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'lxkf', ['options'=>['id'=>'lxkf', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'sjzc', ['options'=>['id'=>'sjzc', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'rzlc', ['options'=>['id'=>'rzlc', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'fggf', ['options'=>['id'=>'fggf', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'shtk', ['options'=>['id'=>'shtk', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'tklc', ['options'=>['id'=>'tklc', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'qxdd', ['options'=>['id'=>'qxdd', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'shkf', ['options'=>['id'=>'shkf', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'lxjy', ['options'=>['id'=>'lxjy', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
<?= $form->field($model, 'yjjy', ['options'=>['id'=>'yjjy', 'class'=>'jyabout', 'style'=>'display:none']])->widget(\yii\redactor\widgets\Redactor::className(),
    [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('更新关于聚仪', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
