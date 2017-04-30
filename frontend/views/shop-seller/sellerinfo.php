<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
    <div class="info_bar">
        <b>
            <?=Html::a('基本信息', '#', ['onclick'=>'showBasicInfo()'])?>&nbsp;&nbsp;
            <?=Html::a('详细信息', '#', ['onclick'=>'showLabInfo()'])?>
        </b>
    </div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([
        'id' => 'basicInfo',
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px;'],
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
        <?=$form->field($sellerinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#seller-city").html("<option value=0>请选择市</option>");
                 $("#seller-area").html("<option value=0>请选择县</option>");
                 $("#seller-city").append(data);
            });',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($sellerinfo, 'city', [ 'template' => "{input}", ])->dropDownList(
            ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$sellerinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                $("#seller-area").html("<option value=0>请选择县</option>");
                $("#seller-area").append(data);});',
            ]); ?>
    </div>
    <?=$form->field($sellerinfo, 'area', [ 'template' => "{input}", ])->dropDownList(
        ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$sellerinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($sellerinfo, 'address')->textInput(['style'=>'width:250px'])?>
    <?= $form->field($sellerinfo, 'grade')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'comments')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'sale')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'qualification')->textInput()?>
    <?= $form->field($sellerinfo, 'logo')->textInput()?>
    <?= $form->field($sellerinfo, 'tax')->textInput()?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'action'=>['shop-seller/sellerext'],
        'id' => 'labInfo',
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px; display:none'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:80px; margin: 0 auto;\">{label}</div><div style='float: left'>{input}</div>
           <div style='padding-left: 380px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($sellerext, 'description')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('实验室概况:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerext, 'team')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('科研队伍:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerext, 'outwork')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('科研成果:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    function setDropDownList()
    {
        if (0 == <?=$sellerinfo->province?>) {
            $("#seller-province").append("<option value=0>请选择省</option>");
            $("#seller-province").val(0);
        }
        if (0 == <?=$sellerinfo->city?>) {
            $("#seller-city").append("<option value=0>请选择市</option>");
            $("#seller-city").val(0);
        }
        if (0 == <?=$sellerinfo->area?>) {
            $("#seller-area").append("<option value=0>请选择县</option>");
            $("#seller-area").val(0);
        }
    }
    /*用window.onload调用myfun()*/
    window.onload=setDropDownList;

    function showBasicInfo()
    {
        $("#basicInfo").show();
        $("#labInfo").hide();
    }

    function  showLabInfo()
    {
        $("#labInfo").show();
        $("#basicInfo").hide();
    }
</script>