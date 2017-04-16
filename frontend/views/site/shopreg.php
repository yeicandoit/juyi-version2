<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Shopreg';
$this->params['breadcrumbs'][] = $this->title;
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
    <?= $form->field($model, 'regType',[])->dropDownList(
        ['shopreg'=>'商家入驻', 'expertreg'=>'专家入驻'],
        ['onchange'=>'jumpUrl()']
    )->label("选择入驻类型:"); ?>
    <?= $form->field($model, 'username', [
    ])->textInput([
        'id'=>'username',
        'options' => ['class'=>'form-control'],
    ])->label('用户名:')->hint('* 用户名称（必填）', ['style'=>'padding-left:30px',]) ?>
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
        专家：写专家的真实姓名，如：张××', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'file', [
        'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
         <div style='float: left;height: 160px; width: 450px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",
    ])->fileInput()->label('资质文件:')->hint('* 请打包上传相关的资质文件(支持zip或者rar)
        聚仪科研检测平台入驻条件
        实验室入驻：高校或研究所实验室要提供实验室负责老师的工作证件照片，企业和第三方检测机构需提供营业执照照片，有检测资质的提供检测资质照片；
        企业和第三方检测机构需提供营业执照，有检测资质提供检测资质
        专家入驻：入驻专家需要提供学历证明照片，工作证照片，是学生的提供学生证照片；
        试验台加工，仪器维修和中间体：提供营业执照照片和相关生产加工和维修资质照片；
        注：以上均提供的证件照片均需真实，照片字迹清晰，不能PS修改') ?>
    <?= $form->field($model, 'phoneNumber')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('手机号码:')->hint('* 移动电话联系方式：如：13000000000', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'email')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('邮箱:')->hint('* 电子邮箱联系方式', ['style'=>'padding-left:30px',]) ?>

    <div style="float:left; margin: 0 auto;">
    <?=$form->field($model, 'provinces', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto; width: 230px;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:200px',
            'prompt'=>'请选择省',
            'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#shopregform-citys").html("<option value=0>请选择市</option>");
                 $("#shopregform-countrys").html("<option value=0>请选择县</option>");
                 $("#shopregform-citys").append(data);
            });',
        ])->label('地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 185px;">
    <?=$form->field($model, 'citys', [ 'template' => "{input}", ])->dropDownList([],
        [
            'style'=>'width:200px',
            'prompt'=>'请选择市',
            'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
             $("#shopregform-countrys").html("<option value=0>请选择县</option>");
             $("#shopregform-countrys").append(data);
        });',
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
        location.href = '/index.php?r=site/' + $("#shopregform-regtype").val();
    };
</script>
