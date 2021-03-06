<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
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
    <?php echo Html::img($expertinfo->getImageUrl('img'), ['style'=>'padding-left:70px']);?>
    <div class="blank"></div>
    <?= $form->field($expertinfo, 'img')->widget('maxmirazh33\image\Widget');?>
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
    <?= $form->field($expertinfo, 'name')->textInput(['readonly'=>"readonly"])
        ->label('用户名')->hint('* 用户名称不能更改', ['style'=>'padding-left:30px',])?>
    <?= $form->field($expertinfo, 'true_name')->textInput(['style'=>'width:250px', 'readonly'=>"readonly"])->label('真实名称')?>
    <?= $form->field($expertinfo, 'age')->textInput()->label('年龄')?>
    <?= $form->field($expertinfo, 'sex')->radioList([1=>'男', 2=>'女'])->label('性别')?>

    <div class="form-group field-expert-service">
    <div style="float:left; width:100px; margin: 0 auto;"><label class="control-label" for="expert-degree">特长</label></div>
        <div id="container" style="float:left;">
            <?php
            foreach($expertinfo->services as $key=>$service){
                $sId = $service->id;
                $serv = $service->service;
                ?>
                <ctrlarea id=<?='ctrl'.$sId?>>
                    <?=Html::a($serv, '#', ['onclick'=>"rmService($sId)"])?>
                    &nbsp;&nbsp;</ctrlarea>
            <?php }
            ?>
            <?= Html::button('添加特长', ['onclick'=>'$("#service").show()']); ?>
            <?= Html::dropDownList('test', null, $expertinfo->optServs, [
                'id'=>'service', 'onchange'=>'addService()', 'style'=>'display:none', 'prompt'=>'请选择'
            ]);?>
        </div>
    <div style='padding-left: 280px;'></div><div><p class="help-block help-block-error"></p></div>
    </div>

    <div class="form-group field-expert-category">
        <div style="float:left; width:100px; margin: 0 auto;"><label class="control-label" for="expert-degree">所属分类</label></div>
        <div id="container" style="float:left;">
            <div id="catContainer" style="float: left;">
                <?php
                foreach($expertinfo->categoryExperts as $key=>$catExpert){
                    $catId = $catExpert->category_id;
                    $catName = $catExpert->category->name;
                    ?>
                    <ctrlarea id=<?='ctrl'.$catId?>>
                        <input name="expertCategory[]" type="hidden" value=<?=$catId?>>
                        <?=Html::a($catName, '#')?>
                        &nbsp;&nbsp;</ctrlarea>
                <?php }
                ?>
            </div>
            <?= Html::button('设置分类', [
                'id' => 'create',
                'data-toggle' => 'modal',
                'data-target' => '#create-modal-category',
            ]); ?>
            <?php $catUrl = Url::to(['shop-seller/expertcategory', 'type'=>\backend\models\seller\Category::TYPE_EXPERT,
            'id'=>$expertinfo->id])?>
            <?php
            Modal::begin([
                'id' => 'create-modal-category',
                'header' => '<h4 class="modal-title">选择专家分类</h4>',
                'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal" onclick="setCategory()">确定</a>',
            ]);?>
            <div class="modal-body-category"></div>
            <?php
            $js = <<<JS
                    $.get("$catUrl", {},
                        function (data) {
                            $('.modal-body-category').html(data);
                        }
                    );
JS;
            $this->registerJs($js);
            Modal::end();
            ?>
        </div>
        <div style='padding-left: 280px;'></div><div><p class="help-block help-block-error"></p></div>
    </div>

    <?= $form->field($expertinfo, 'degree')->textInput()?>
    <?= $form->field($expertinfo, 'major')->textInput()?>
    <?= $form->field($expertinfo, 'title')->textInput()?>
    <?= $form->field($expertinfo, 'affliation')->textInput()?>
    <?= $form->field($expertinfo, 'affliationtype')->textInput()?>
    <?= $form->field($expertinfo, 'mobile')->textInput()->label('手机')?>
    <?= $form->field($expertinfo, 'email')->textInput()?>
    <?= $form->field($expertinfo, 'server_num')->textInput()?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?php
        $pArr = ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name');
        $pArr[0] = '请选择';
        $cArr = ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$expertinfo->province])->asArray()->all(),'area_id','area_name');
        $cArr[0] = '请选择';
        $aArr = ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$expertinfo->city])->asArray()->all(),'area_id','area_name');
        $aArr[0] = '请选择';
        ?>
        <?=$form->field($expertinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(
            $pArr,
            [
                'style'=>'width:180px',
                'onchange'=>'setCityOption()',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($expertinfo, 'city', [ 'template' => "{input}", ])->dropDownList(
            $cArr,
            [
                'style'=>'width:180px',
                'onchange'=>'setAreaOption()',
            ]); ?>
    </div>
    <?=$form->field($expertinfo, 'area', [ 'template' => "{input}", ])->dropDownList(
        $aArr,
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($expertinfo, 'address')->textInput()->label('详细地址')?>
    <?= $form->field($expertinfo, 'home_url')->textInput()?>
    <?= $form->field($expertinfo, 'grade')->textInput(['readonly'=>"readonly"])?>
    <?= $form->field($expertinfo, 'comments')->textInput(['readonly'=>"readonly"])?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    <?php $url = Url::to(['shop-seller/areas']); ?>
    function setCityOption()
    {
        $.get("<?= $url?>?id="+$("#expert-province").val(),function(data){
            $("#expert-city").html("<option value=0>请选择市</option>");
            $("#expert-area").html("<option value=0>请选择县</option>");
            $("#expert-city").append(data);
        });
    }

    function setAreaOption()
    {
        $.get("<?= $url?>?id="+$("#expert-city").val(),function(data){
            $("#expert-area").html("<option value=0>请选择县</option>");
            $("#expert-area").append(data);});
    }

    function addService()
    {
        var service = $("#service").val();
        $.get("<?=Url::to(['shop-seller/addservice'])?>" + "?shopId=" + <?=$expertinfo->id?> + "&service=" + service, function (data) {
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
            $.get("<?=Url::to(['shop-seller/delservice'])?>" + "?id=" + id, function (data) {
                if('OK' == data){
                    $(node).remove();
                }
            });
        }
    }

    function setCategory(){
        var str = '';
        for(var cid in goodsCats) {
            str += '<ctrlarea id=' + 'ctrl' + cid + '>' +
                '<input name="expertCategory[]" type="hidden" value=' + cid + '>' +
                '<a href="#">' +
                idname[cid] + '</a>&nbsp;&nbsp;</ctrlarea>';
        };
        $("#catContainer").html(str);
    }
</script>
