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
    <?= Html::hiddenInput('shopType', $shopType)?>
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
        <?=$form->field($sellerinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'setCityOption()',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($sellerinfo, 'city', [ 'template' => "{input}", ])->dropDownList(
            ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$sellerinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'setAreaOption()',
            ]); ?>
    </div>
    <?=$form->field($sellerinfo, 'area', [ 'template' => "{input}", ])->dropDownList(
        ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$sellerinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($sellerinfo, 'address')->textInput(['style'=>'width:250px'])?>
    <?= $form->field($sellerinfo, 'grade')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'comments')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'sale')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($sellerinfo, 'qualification')->textInput()?>
    <?= $form->field($sellerinfo, 'tax')->textInput()?>

    <div class="form-group field-seller-address">
        <div style="float:left; width:100px; margin: 0 auto;"><label class="control-label" for="seller-address">商家类型</label></div><div style="float:left;">
            <?=Html::dropDownList('shopType', $shopType, $sellerinfo->sellerTypes, [])?></div>
        <div style='padding-left: 280px;'></div><div><p class="help-block help-block-error"></p></div>
    </div>

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

    function addService()
    {
        var service = $("#service").val();
        $.get("<?=Url::to(['shop-seller/addservice'])?>" + "&shopId=" + <?=$sellerinfo->id?> + "&service=" + service, function (data) {
            if('Failed' != data){
                var str = '<ctrlarea id=' + 'ctrl' + data + '>' +
                    '<a href="#" onclick="rmService(' + data + ')">' +
                    service + '</a>&nbsp;&nbsp;</ctrlarea>';
                $("#container").prepend(str);
            }
        });

    }

    function rmService(id)
    {
        if(confirm('确定删除此分类？')) {
            var node = '#ctrl' + id;
            $.get("<?=Url::to(['shop-seller/delservice'])?>" + "&id=" + id, function (data) {
                if('OK' == data){
                    $(node).remove();
                }
            });
        }
    }
</script>
