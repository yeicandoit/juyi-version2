<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<!--Show user info-->
<div class="userinfo">
    <div class="info_bar"><b>个人资料</b> </div>
    <div class="borderbottom"><strong >会员信息</strong></div>
    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-horizontal form-userinfo'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left; width: auto;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($memberinfo, 'true_name', [])->textInput()->label('姓名:') ?>

    <div class="form-group">
        <div style="float: left;width:100px;"><label><strong>出生日期:</strong></label></div>
        <div style="width: 280px;">
        <?= DatePicker::widget([
            'model' => $memberinfo,
            'attribute' => 'birthday',
            'template' => '{addon}{input}',
            'language'=>'zh-CN', //
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'pickButtonIcon' => 'glyphicon glyphicon-time'
            ]
        ]);?>
        </div>
    </div>

    <?= $form->field($memberinfo, 'sex')->textInput()->
    radioList( ['1'=>'男','2'=>'女'],['class'=>'label-group'])->label('性别：')?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($memberinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div><div style='float: left; padding-left: 10px;'>{error}</div>", ]
        )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'setCityOption()',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($memberinfo, 'city', [ 'template' => "{input}", ]
        )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$memberinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'setAreaOption()',
            ]); ?>
    </div>
    <?=$form->field($memberinfo, 'country', [ 'template' => "{input}", ]
    )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$memberinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
        <?= $form->field($memberinfo, 'contact_addr', [
        ])->textInput([
        ])->label('联系地址:') ?>
        <?= $form->field($memberinfo, 'mobile', [
        ])->textInput([
        ])->label('手机号码:') ?>
        <?= $form->field($memberinfo, 'email', [
        ])->textInput([
        ])->label('邮箱:') ?>
        <?= $form->field($memberinfo, 'zip', [
        ])->textInput([
        ])->label('邮编:') ?>
        <?= $form->field($memberinfo, 'qq', [
        ])->textInput([
        ])->label('QQ:') ?>
    <?= Html::submitButton('保存基本信息', [ 'style' => 'width:110px']) ?>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    function setDropDownList()
    {
        if (0 == <?=$memberinfo->province?>) {
            $("#memeber-province").append("<option value=0>请选择省</option>");
            $("#memeber-province").val(0);
        }
        if (0 == <?=$memberinfo->city?>) {
            $("#memeber-city").append("<option value=0>请选择市</option>");
            $("#memeber-city").val(0);
        }
        if (0 == <?=$memberinfo->country?>) {
            $("#memeber-country").append("<option value=0>请选择县</option>");
            $("#memeber-country").val(0);
        }
    }
    /*用window.onload调用myfun()*/
    window.onload=setDropDownList;
    <?php $url = \yii\helpers\Url::to(['shop-seller/areas']); ?>
    function setCityOption()
    {
        alert('debug');
        $.get("<?= $url?>&id="+$("#memeber-province").val(),function(data){
            $("#memeber-city").html("<option value=0>请选择市</option>");
            $("#memeber-area").html("<option value=0>请选择县</option>");
            $("#memeber-city").append(data);
        });
    }

    function setAreaOption()
    {
        alert('debug 1');
        $.get("<?= $url?>&id="+$("#member-city").val(),function(data){
            $("#memeber-area").html("<option value=0>请选择县</option>");
            $("#memeber-area").append(data);});
    }
</script>


