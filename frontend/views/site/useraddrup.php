<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
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
<div class="userinfo">
    <div class="info_bar"><label id="manaddr" onclick="showManaddr()" style="color: #0000aa"><b>修改地址</b></label></div>
    <div style="padding-top: 20px;">
        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal form-adrdetail'],
            'fieldConfig' => [
                'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
                <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
            ],
        ]); ?>
        <div style="display: none"><?= $form->field($useraddrup, 'id')->textInput()?></div>
        <?= $form->field($useraddrup, 'accept_name', [
        ])->textInput([
        ])->label('* 收货人姓名:')->hint('收货人真实姓名，方便快递公司联系。', ['style'=>'padding-left:30px',]) ?>
        <div style="float:left; margin: 0 auto;width: 280px;">
            <?=$form->field($useraddrup, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
            <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
            )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
                [
                    'style'=>'width:180px',
                    'prompt'=>'请选择省',
                    'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                     $("#shopaddress-city").html("<option value=0>请选择市</option>");
                     $("#shopaddress-area").html("<option value=0>请选择县</option>");
                     $("#shopaddress-city").append(data);
                });',
                ])->label('* 所在地区:'); ?>
        </div>
        <div style="float:left; margin: 0 auto;width: 165px;">
            <?=$form->field($useraddrup, 'city', [ 'template' => "{input}", ]
            )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$useraddrup->province])->asArray()->all(),'area_id','area_name'),
                [
                    'style'=>'width:180px',
                    'prompt'=>'请选择市',
                    'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                    $("#shopaddress-area").html("<option value=0>请选择县</option>");
                    $("#shopaddress-area").append(data);});',
                ]); ?>
        </div>
        <?=$form->field($useraddrup, 'area', [ 'template' => "{input}", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>$useraddrup->city])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'prompt'=>'请选择县',
            ]); ?>
        <?= $form->field($useraddrup, 'address', [
        ])->textInput([
        ])->label('* 街道地区：')->hint('真实详细收货地址，方便快递公司联系。', ['style'=>'padding-left:30px',]) ?>
        <?= $form->field($useraddrup, 'zip', [
        ])->textInput([
        ])->label('邮政编码：')->hint('邮政编码,如250000。', ['style'=>'padding-left:30px',]) ?>
        <?= $form->field($useraddrup, 'telphone', [
        ])->textInput([
        ])->label('电话号码：')->hint('电话号码,如010-12345688。', ['style'=>'padding-left:30px',]) ?>
        <?= $form->field($useraddrup, 'mobile', [
        ])->textInput()->label('手机号码：')->hint('手机号码，如：13588888888', ['style'=>'padding-left:30px',]) ?>
        <?= $form->field($useraddrup, 'is_default')->checkbox()->label('设为默认') ?>
        <?= Html::submitButton('保存', [ 'style' => 'width:50px']) ?>
        <?= Html::resetButton('取消', [ 'style' => 'width:50px']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

