<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
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
    <?= $form->field($expertinfo, 'name')->textInput(['readonly'=>"readonly"])
        ->label('用户名')->hint('* 用户名称不能更改', ['style'=>'padding-left:30px',])?>
    <?= $form->field($expertinfo, 'true_name')->textInput(['style'=>'width:250px', 'readonly'=>"readonly"])->label('真实名称')?>
    <?= $form->field($expertinfo, 'age')->textInput()?>
    <?= $form->field($expertinfo, 'sex')->radioList([1=>'男', 2=>'女'])?>
    <?= $form->field($expertinfo, 'degree')->textInput()?>
    <?= $form->field($expertinfo, 'title')->textInput()?>
    <?= $form->field($expertinfo, 'img')->textInput()?>
    <?= $form->field($expertinfo, 'affliation')->textInput()?>
    <?= $form->field($expertinfo, 'affliationtype')->textInput()?>
    <?= $form->field($expertinfo, 'country')->textInput()?>
    <?= $form->field($expertinfo, 'account')->textInput()->hint('标明开户行，卡号，账户名称等',['style'=>'padding-left:30px',])?>
    <?= $form->field($expertinfo, 'mobile')->textInput()?>
    <?= $form->field($expertinfo, 'email')->textInput()?>
    <?= $form->field($expertinfo, 'server_num')->textInput()?>
    <?= $form->field($expertinfo, 'country')->textInput()?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($expertinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.post("index.php?r=shop-seller/areas&id='.'"+$(this).val(),function(data){
                 $("#expert-city").html("<option value=0>请选择市</option>");
                 $("#expert-area").html("<option value=0>请选择县</option>");
                 $("#expert-city").append(data);
            });',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($expertinfo, 'city', [ 'template' => "{input}", ])->dropDownList(
            ArrayHelper::map(frontend\models\seller\Areas::find()->where(['parent_id'=>$expertinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.get("/index.php?r=shop-seller/areas&id='.'"+$(this).val(),function(data){
                $("#expert-area").html("<option value=0>请选择县</option>");
                $("#expert-area").append(data);});',
            ]); ?>
    </div>
    <?=$form->field($expertinfo, 'area', [ 'template' => "{input}", ])->dropDownList(
        ArrayHelper::map(frontend\models\seller\Areas::find()->where(['parent_id'=>$expertinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($expertinfo, 'address')->textInput()?>
    <?= $form->field($expertinfo, 'home_url')->textInput()?>
    <?= $form->field($expertinfo, 'grade')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($expertinfo, 'comments')->textInput(['readonly'=>"readonly"])?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'action'=>['shop-seller/expertext'],
        'id' => 'expertExt',
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px; display:none'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:80px; margin: 0 auto;\">{label}</div><div style='float: left'>{input}</div>
           <div style='padding-left: 380px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($expertext, 'description')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('专家介绍:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($expertext, 'direction')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('研究方向:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($expertext, 'education')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('教育背景:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($expertext, 'work')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('工作经历:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($expertext, 'research')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('科研成果:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($expertext, 'project')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('科研项目:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($expertext, 'award')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('荣誉奖励:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    function setDropDownList()
    {
        if (0 == <?=$expertinfo->province?>) {
            $("#seller-province").append("<option value=0>请选择省</option>");
            $("#seller-province").val(0);
        }
        if (0 == <?=$expertinfo->city?>) {
            $("#seller-city").append("<option value=0>请选择市</option>");
            $("#seller-city").val(0);
        }
        if (0 == <?=$expertinfo->area?>) {
            $("#seller-area").append("<option value=0>请选择县</option>");
            $("#seller-area").val(0);
        }
    }
    /*用window.onload调用myfun()*/
    window.onload=setDropDownList;

    function showBasicInfo()
    {
        $("#basicInfo").show();
        $("#expertExt").hide();
    }

    function  showLabInfo()
    {
        $("#expertExt").show();
        $("#basicInfo").hide();
    }
</script>