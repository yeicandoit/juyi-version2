<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div id="signup-box" class="widget-box no-border">
    <?php $form = ActiveForm::begin([
        'id' => 'shopreg',
        'options' => ['class'=>'form-horizontal form-signin', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left;height: 40px; width: 500px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($model, 'regType',['template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
         <div style='float: left;height: 100px; width: 500px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",])->dropDownList(
        ['expert'=>'专家解码', 'seller'=>'检测中心', 'research'=>'科研辅助', 'simulate'=>'数值模拟' ],
        ['onchange'=>'jumpUrl()']
    )->label("选择入驻类型:")->hint('检测中心：从事科研检测，分析测试，提供测试服务和提供仪器共享的请选择；<br>
                                     专家解码：硕士，博士或者科研人员可提供技术服务的请选择；<br>
                                     科研辅助：从事试验台加工，仪器维修，仪器租赁，科研仪器及耗材销售，抗体及合成中间体销售等，为服务于科研的请选择；<br>
                                     数值模拟：从事仿真计算，仿真模拟，数值模拟等方面的人才请选择；
                                    ', ['style'=>'padding-left:30px']); ?>
    <br>
    <?= $form->field($model, 'username', [
    ])->textInput([
        'id'=>'username',
        'options' => ['class'=>'form-control'],
    ])->label('用户名:')->hint('* 用户名称(必填)，字母和数字组合，如dayang或dayang88', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'password')->passwordInput([
        'id'=>'password',
        'options' => ['class'=>'form-control'],
    ])->label('密码:')->hint('* 登录密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'confirmpwd')->passwordInput([
        'id'=>'confirmpwd',
        'options' => ['class'=>'form-control'],
    ])->label('确认密码:')->hint('* 重复确认密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'shopRealName', [
        'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
         <div style='float: left;height: 70px; width: 500px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",
    ])->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('商户真实全称:')->hint('企业：写企业全称，如：上海××科技有限公司；
        高校和研究所：写学校全称和具体的实验室，如：上海××大学生物高分子实验室或××研究所××室；
        专家：写专家的真实姓名，如：张××', ['style'=>'padding-left:30px', 'id'=>'pName']) ?>
    <?= $form->field($model, 'file', [
        'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
         <div style='float: left;max-height: 160px; width: 450px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",
    ])->fileInput()->label('资质文件:')->hint('请打包上传相关的资质文件(支持zip或者rar) 聚仪科研检测平台入驻条件 检测中心入驻：高校或研究所实验室入驻需提供实验室负责老师的工作证件照片或证明文件，企业提供营业执照照片；（格式换成图片格式，要多兼容几种图片格式）', ['id'=>'pFile']) ?>
    <?= $form->field($model, 'phoneNumber')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('手机号码:')->hint('* 移动电话联系方式：如：13000000000', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'email')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('邮箱:')->hint('* 电子邮箱联系方式', ['style'=>'padding-left:30px',]) ?>

    <div style="float:left; margin: 0 auto;">
    <?=$form->field($model, 'provinces', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto; width: 230px;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:200px',
            'prompt'=>'请选择省',
            'onchange'=>'setCityOption()',
        ])->label('地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 185px;">
    <?=$form->field($model, 'citys', [ 'template' => "{input}", ])->dropDownList([],
        [
            'style'=>'width:200px',
            'prompt'=>'请选择市',
            'onchange'=>'setAreaOption()',
        ]); ?>
    </div>
    <?=$form->field($model, 'countrys', [ 'template' => "{input}", ])->dropDownList([],
        [
            'style'=>'width:200px',
            'prompt'=>'请选择县',
        ]); ?>

    <?= $form->field($model, 'detailAddress')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('详细地址:') ?>
    <?= Html::submitButton('提交', ['class' => 'btn btn-lg btn-warning btn-block', 'name' => 'login-button', 'style' => 'width:250px']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    function jumpUrl(){
        if('expert' ==  $("#sellerregform-regtype").val()) {
            location.href = "<?=Url::to(['shop-seller/'])?>/expertreg";
        }

        if('seller' ==  $("#sellerregform-regtype").val()) {
            $("#pName").html("企业：写企业全称，如：上海××科技有限公司；高校和研究所：写学校全称和具体的实验室，如：上海××大学生物高分子实验室或××研究所××室；专家：写专家的真实姓名，如：张××");
            $("#pFile").html("请打包上传相关的资质文件(支持zip或者rar) 聚仪科研检测平台入驻条件 检测中心入驻：高校或研究所实验室入驻需提供实验室负责老师的工作证件照片或证明文件，企业提供营业执照照片；（格式换成图片格式，要多兼容几种图片格式）");
        }
        if('research' ==  $("#sellerregform-regtype").val()) {
            $("#pName").html("写企业全称，如上海××仪器有限公司；");
            $("#pFile").html("请打包上传相关的资质文件(支持zip或者rar) 聚仪科研检测平台入驻条件企业提供营业执照照片；（格式换成图片格式，要多兼容几种图片格式）；");
        }
        if('simulate' ==  $("#sellerregform-regtype").val()) {
            $("#pName").html("写企业全称，如上海××仪器有限公司；或者写团队名称；");
            $("#pFile").html("请打包上传相关的资质文件(支持zip或者rar) 聚仪科研检测平台入驻条件企业提供营业执照照片；如未成立公司，上传一张数值模拟图片；（格式换成图片格式，要多兼容几种图片格式，）；");
        }
    };

    <?php $url = Url::to(['shop-seller/areas']); ?>
    function setCityOption()
    {
        $.get("<?= $url?>?id="+$("#sellerregform-provinces").val(),function(data){
            $("#sellerregform-citys").html("<option value=0>请选择市</option>");
            $("#sellerregform-countrys").html("<option value=0>请选择县</option>");
            $("#sellerregform-citys").append(data);
        });
    }

    function setAreaOption()
    {
        $.get("<?= $url?>?id="+$("#sellerregform-citys").val(),function(data){
            $("#sellerregform-countrys").html("<option value=0>请选择县</option>");
            $("#sellerregform-countrys").append(data);});
    }
</script>
