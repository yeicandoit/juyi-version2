<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
    <div class="box">
        <div class="umenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
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
<!--Show user info-->
<div class="userinfo">
    <div class="info_bar"><b>个人资料</b> </div>
    <div class="borderbottom"><strong >会员信息</strong></div>
    <div class="userinfotable">
        <dl class="userinfo_box">
            <dt>
                <a ><?=html::img('@web/images/user_ico.gif', ['class'=>'user_ico_img'])?></a>
                <a class="blue"><h5>修改头像</h5></a>
            </dt>
            <dd>
                <div class="stat">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <col width="350px"/>
                        <col />
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;登录名：&nbsp;&nbsp;&nbsp;<?=$userinfo->loginName?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>会员等级：</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </dd>
        </dl>
    </div>
    <div class="borderbottom"><strong >个人信息</strong></div>
    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-horizontal form-userinfo'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left; width: auto;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($userinfo, 'trueName', [])->textInput()->label('姓名:') ?>

    <div class="form-group">
        <div style="float: left;width:100px;"><label><strong>出生日期:</strong></label></div>
        <div style="width: 280px;">
        <?= DatePicker::widget([
            'model' => $userinfo,
            'attribute' => 'birthday',
            'template' => '{addon}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'language'=>'zh', //
                'todayHighlight' => true,
            ]
        ]);?>
        </div>
    </div>

    <?= $form->field($userinfo, 'gender')->textInput()->
    radioList( ['1'=>'男','2'=>'女'],['class'=>'label-group'])->label('性别：')?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($userinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div><div style='float: left; padding-left: 10px;'>{error}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#userdetailform-city").html("<option value=0>请选择市</option>");
                 $("#userdetailform-country").html("<option value=0>请选择县</option>");
                 $("#userdetailform-city").append(data);
            });',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($userinfo, 'city', [ 'template' => "{input}", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$userinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                $("#userdetailform-country").html("<option value=0>请选择县</option>");
                $("#userdetailform-country").append(data);});',
            ]); ?>
    </div>
    <?=$form->field($userinfo, 'country', [ 'template' => "{input}", ]
    )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$userinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
        <?= $form->field($userinfo, 'contactAddr', [
        ])->textInput([
        ])->label('联系地址:') ?>
        <?= $form->field($userinfo, 'mobile', [
        ])->textInput([
        ])->label('手机号码:') ?>
        <?= $form->field($userinfo, 'email', [
        ])->textInput([
        ])->label('邮箱:') ?>
        <?= $form->field($userinfo, 'zip', [
        ])->textInput([
        ])->label('邮编:') ?>
        <?= $form->field($userinfo, 'qq', [
        ])->textInput([
        ])->label('QQ:') ?>
    <?= Html::submitButton('保存基本信息', [ 'style' => 'width:110px']) ?>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    function setDropDownList()
    {
        if (0 == <?=$userinfo->province?>) {
            $("#userdetailform-province").append("<option value=0>请选择省</option>");
            $("#userdetailform-province").val(0);
        }
        if (0 == <?=$userinfo->city?>) {
            $("#userdetailform-city").append("<option value=0>请选择市</option>");
            $("#userdetailform-city").val(0);
        }
        if (0 == <?=$userinfo->country?>) {
            $("#userdetailform-country").append("<option value=0>请选择县</option>");
            $("#userdetailform-country").val(0);
        }
    }
    /*用window.onload调用myfun()*/
    window.onload=setDropDownList;
</script>


