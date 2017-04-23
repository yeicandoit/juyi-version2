<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
        <div class="box">
            <div class="smenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
            <div class="cont">
                <ul class="list">
                    <?php foreach($subMenu as $moreKey => $moreValue){?>
                        <li><a target="_blank"  href="<?php echo $moreValue;?>"><?php echo isset($moreKey)?$moreKey:"";?></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>
</div>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>
            <?php
                if('expertreg' == $sellerinfo->regType){ ?>
                    <?=Html::a('基本信息', '#', ['onclick'=>'showBasicInfo()'])?>&nbsp;&nbsp;
                    <?=Html::a('详细信息', '#', ['onclick'=>'showDetailInfo()'])?>
                <?php } else {
                    echo '商户信息';
                }
            ?>
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
    <?= $form->field($sellerinfo, 'name')->textInput(['readonly'=>"readonly"])->hint('* 用户名称不能更改', ['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'newpwd')->passwordInput()->hint('改变密码时需填写', ['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'cfmnewpwd')->passwordInput()->hint('改变密码时需填写', ['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'truename')->textInput(['style'=>'width:250px', 'readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'paperimg')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'cash')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'account')->textInput()->hint('标明开户行，卡号，账户名称等',['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'mobile')->textInput()?>
    <?= $form->field($sellerinfo, 'email')->textInput()?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($sellerinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#sellerdetailform-city").html("<option value=0>请选择市</option>");
                 $("#sellerdetailform-area").html("<option value=0>请选择县</option>");
                 $("#sellerdetailform-city").append(data);
            });',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($sellerinfo, 'city', [ 'template' => "{input}", ])->dropDownList(
            ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$sellerinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                $("#sellerdetailform-area").html("<option value=0>请选择县</option>");
                $("#sellerdetailform-area").append(data);});',
            ]); ?>
    </div>
    <?=$form->field($sellerinfo, 'area', [ 'template' => "{input}", ])->dropDownList(
        ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$sellerinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($sellerinfo, 'address')->textInput(['style'=>'width:250px'])?>
    <?= $form->field($sellerinfo, 'homeurl')->textInput(['style'=>'width:250px'])->hint('官网的URL网址，如：http://www.example.com', ['style'=>'padding-left:100px'])?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'action'=>['shop-seller/expertinfo'],
        'id' => 'detailInfo',
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px; display:none'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:70px; margin: 0 auto;\">{label}</div><div style='float: left'>{input}</div>
           <div style='padding-left: 380px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($sellerinfo, 'institute')->textInput(['style'=>'width:300px'])
        ->label('学院:')?>
    <?= $form->field($sellerinfo, 'lab')->textInput(['style'=>'width:300px'])
        ->label('研究所:')?>
    <?= $form->field($sellerinfo, 'description')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('专家介绍:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerinfo, 'direction')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('研究方向:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerinfo, 'education')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('教育背景:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerinfo, 'work')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('工作经历:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerinfo, 'research')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('科研成果:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerinfo, 'project')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('科研项目:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= $form->field($sellerinfo, 'award')->textarea(['rows'=>3, 'style'=>'width:500px'])
        ->label('荣誉奖励:')->hint('&nbsp;&nbsp;&nbsp;最多不超过200字')?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    function setDropDownList()
    {
        if (0 == <?=$sellerinfo->province?>) {
            $("#sellerdetailform-province").append("<option value=0>请选择省</option>");
            $("#sellerdetailform-province").val(0);
        }
        if (0 == <?=$sellerinfo->city?>) {
            $("#sellerdetailform-city").append("<option value=0>请选择市</option>");
            $("#sellerdetailform-city").val(0);
        }
        if (0 == <?=$sellerinfo->area?>) {
            $("#sellerdetailform-area").append("<option value=0>请选择县</option>");
            $("#sellerdetailform-area").val(0);
        }
    }
    /*用window.onload调用myfun()*/
    window.onload=setDropDownList;

    function showDetailInfo()
    {
        $("#basicInfo").hide();
        $("#detailInfo").show();
    }

    function showBasicInfo()
    {
        $("#basicInfo").show();
        $("#detailInfo").hide();
    }
</script>


