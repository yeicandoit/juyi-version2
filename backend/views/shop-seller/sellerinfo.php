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
            <?=Html::a('基本信息', '#')?>
        </b>
    </div>
    <div class="blank"></div>
    <div style="height:60px;color:red;text-align:center"> <?= Html::encode($info)?> </div>
    <?php $form = ActiveForm::begin([
        'id' => 'basicInfo',
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px;', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?php echo Html::img($sellerinfo->getImageUrl('logo'), ['style'=>'padding-left:70px']);?>
    <div class="blank"></div>
    <?= $form->field($sellerinfo, 'logo')->widget('maxmirazh33\image\Widget');?>
    <!--Save id should be same as onclick id in maxmirazh33' view-->
    <?= Html::submitButton('保存', [ 'style' => 'width:50px;display:none', 'class'=>'btn btn-large btn-primary',
        'id'=>'image-save-2017-08-25']) ?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'id' => 'basicInfo',
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px;', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($sellerinfo, 'seller_name')->textInput(['readonly'=>"readonly"])
        ->label('用户名')->hint('* 用户名称不能更改', ['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'true_name')->textInput(['style'=>'width:250px', 'readonly'=>"readonly"])->label('真实名称')?>
    <?= $form->field($sellerinfo, 'affliation')->textInput()?>
    <?= $form->field($sellerinfo, 'affliationtype')->textInput()?>
    <?= $form->field($sellerinfo, 'phone')->textInput()?>
    <?= $form->field($sellerinfo, 'country')->textInput()?>
    <?= $form->field($sellerinfo, 'paper_img')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'cash')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'account')->textInput()->hint('标明开户行，卡号，账户名称等',['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'mobile')->textInput()?>
    <?= $form->field($sellerinfo, 'email')->textInput()?>
    <?= $form->field($sellerinfo, 'server_num')->textInput()?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?php
            $pArr = ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name');
            $pArr[0] = '请选择';
            $cArr = ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$sellerinfo->province])->asArray()->all(),'area_id','area_name');
            $cArr[0] = '请选择';
            $aArr = ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$sellerinfo->city])->asArray()->all(),'area_id','area_name');
            $aArr[0] = '请选择';
        ?>
        <?=$form->field($sellerinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(
            $pArr,
            [
                'style'=>'width:180px',
                'onchange'=>'setCityOption()',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($sellerinfo, 'city', [ 'template' => "{input}", ])->dropDownList(
            $cArr,
            [
                'style'=>'width:180px',
                'onchange'=>'setAreaOption()',
            ]); ?>
    </div>
    <?=$form->field($sellerinfo, 'area', [ 'template' => "{input}", ])->dropDownList(
        $aArr,
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($sellerinfo, 'address')->textInput(['style'=>'width:250px'])?>
    <?= $form->field($sellerinfo, 'grade')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'comments')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'sale')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'qualification')->textInput()?>
    <?= $form->field($sellerinfo, 'tax')->textInput()?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    <?php $url = Url::to(['shop-seller/areas']); ?>
    function setCityOption()
    {
        $.get("<?= $url?>?id="+$("#seller-province").val(),function(data){
            $("#seller-city").html("<option value=0>请选择市</option>");
            $("#seller-area").html("<option value=0>请选择县</option>");
            $("#seller-city").append(data);
        });
    }

    function setAreaOption()
    {
        $.get("<?= $url?>?id="+$("#seller-city").val(),function(data){
            $("#seller-area").html("<option value=0>请选择县</option>");
            $("#seller-area").append(data);});
    }
</script>
