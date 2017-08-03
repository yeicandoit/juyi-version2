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
    <?= $form->field($sellerinfo, 'seller_name')->textInput(['readonly'=>"readonly"])
        ->label('用户名')->hint('* 用户名称不能更改', ['style'=>'padding-left:30px',])?>
    <?= $form->field($sellerinfo, 'true_name')->textInput(['style'=>'width:250px', 'readonly'=>"readonly"])->label('真实名称')?>
    <?= $form->field($sellerinfo, 'affliation')->textInput()?>
    <?= $form->field($sellerinfo, 'affliationtype')->textInput()?>

    <?php if($shopType != 'seller') {?>
        <div class="form-group field-seller-service">
            <div style="float:left; width:100px; margin: 0 auto;"><label class="control-label" for="seller-degree"><?=$shopType == 'research' ? '服务类型' : '模拟软件'?></label></div>
            <div id="container" style="float:left;">
                <?php
                foreach($sellerinfo->services as $key=>$service){
                    $sId = $service->id;
                    $serv = $service->service;
                    ?>
                    <ctrlarea id=<?='ctrl'.$sId?>>
                        <?=Html::a($serv, '#', ['onclick'=>"rmService($sId)"])?>
                        &nbsp;&nbsp;</ctrlarea>
                <?php }
                ?>
                <?php if('research' == $shopType) {?>
                    <?= Html::button('添加', ['onclick'=>'$("#service").show()']); ?>
                    <?= Html::dropDownList('', null, $sellerinfo->optServs, [
                        'id'=>'service', 'onchange'=>'addService()', 'style'=>'display:none', 'prompt'=>'请选择'
                    ]);?>
                <?php } else {?>
                    <?= Html::button('添加', ['onclick'=>'addSoft()', 'id' => 'bSoft']); ?>
                <?php }?>
            </div>
            <div style='padding-left: 280px;'></div><div><p class="help-block help-block-error"></p></div>
        </div>
    <?php  }?>

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
        $.get("<?=Url::to(['shop-seller/addservice'])?>" + "?shopId=" + <?=$sellerinfo->id?> + "&service=" + service, function (data) {
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

    function addSoft()
    {
        $('#bSoft').remove();
        var mtime = (new Date()).valueOf();
        var str = '';
        var ctrlId = 'soft_' + mtime;
        str += '<ctrlarea id=' + ctrlId + '>' +
            '<input type="text" id='+ 'inputSoft_' + mtime + '>' +
            '<a href="#" class="btn btn-xs" onclick="cfmSoft(' + mtime + ')">'+
            '确定' + '</a>&nbsp;&nbsp;</ctrlarea>';
        $('#container').append(str);
    }

    function cfmSoft(id)
    {
        if(confirm('确定添加？')){
            var soft = $.trim($('#inputSoft_'+id).val());
            if('' != soft) {
                $.get("<?=Url::to(['shop-seller/addservice'])?>" + "?shopId=" + <?=$sellerinfo->id?> +"&service=" + soft, function (data) {
                    if ('Failed' != data) {
                        var str = '<ctrlarea id=' + 'ctrl' + data + '>' +
                            '<a href="#" onclick="rmService(' + data + ')">' +
                            soft + '</a>&nbsp;&nbsp;</ctrlarea>';
                        $("#container").prepend(str);
                    }
                });
            }
        }
        $('#soft_'+id).remove();
        var str = '<button type="button" id="bSoft" onclick="addSoft()">添加</button>';
        $('#container').append(str);

    }
</script>
