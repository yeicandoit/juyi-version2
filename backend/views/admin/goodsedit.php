<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use \yii\helpers\Url;
use backend\models\seller\Seller;
use backend\models\seller\Expert;
use backend\models\seller\Goods;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<?=Html::cssFile('@web/css/jquery.Jcrop.css')?>

<?php
//backend\assets\AppAsset does not work, so use registerJsFile to load javascript file.
$this->registerJsFile('@web/js/ajaxupload.js', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('@web/js/jquery.Jcrop.min.js', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
?>

<style type="text/css">
    .jcorp-holder{position: relative;}
    #frm{margin-bottom:0px; }
    #frm input{margin:15px 0; }
    .pic-display{display: block;margin: 20px;width: auto;}
    #thum{width: auto;}
    /*#thum img{width: auto;height: auto;display: block;}*/
    #preview-pane{
        padding: 0;
        width:150px;
        height: 150px;
        overflow: hidden;
        display: block;
        position: absolute;
        z-index: 2000;
        top: 10px;
        right:-170px;

        border: 1px rgba(0,0,0,.4) solid;
        background-color: white;

        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;

        -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    }

    #preview-pane .preview-container {
        width: 150px;
        height: 150px;
        overflow: hidden;
        padding: 0;
        text-indent: 0;
    }
    .jcrop-preview{padding: 0;margin: 0;text-indent: 0}

</style>

<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>
            <?=Html::a('商品编辑', '#', ['onclick'=>'showBasicInfo()'])?>&nbsp;&nbsp;
            <?=Html::a('详细信息', '#', ['onclick'=>'showDetailInfo()'])?>&nbsp;&nbsp;
            <?=Html::a('SEO优化', '#', ['onclick'=>'showSeo()'])?>
        </b>
    </div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin(['id' => 'basicInfo']); ?>
    <?= $form->field($goods, 'id', ['options'=>['style'=>"display:none"]])?>
    <?= $form->field($goods, 'name')->textInput(['style'=>'width:60%'])?>
    <?= $form->field($goods, 'img', ['options'=>['style'=>"display:none"]])?>
    <?= $form->field($goods, 'search_words')->textInput(['style'=>'width:60%'])->label('关键词')
    ->hint('每个关键词最长为15个字符，超过后系统不予存储，每个词以逗号分隔')?>
    <?= $form->field($goods, 'seller_id')->dropDownList(ArrayHelper::map(Expert::find()->asArray()->all(), 'id', 'true_name') +
        ArrayHelper::map(Seller::find()->asArray()->all(), 'id', 'true_name'), ['style'=>'width:60%'])->label('所属商户:');?>
    <?= $form->field($goods, 'goodtype')->dropDownList([1=>'检测中心', 2=>'专家解码', 3=>'科研辅助', 4=>'数值模拟'], ['style'=>'width:60%'])->label('所属商户类型:');?>
    <div class="goodInfoBox">
    <div>
        <?=Html::label('所属分类');?>
        <div id="catContainer">
            <?php
                foreach($goods->categoryExtends as $key=>$catExt){
                    $catId = $catExt->category_id;
                    $catName = $catExt->category->name;
            ?>
            <ctrlarea id=<?='ctrl'.$catId?>>
                <input name="goodsCategory[]" type="hidden" value=<?=$catId?>>
                <?=Html::a($catName, '#')?>
            &nbsp;&nbsp;</ctrlarea>
            <?php }
            ?>
        </div>
        <div>
            <?php echo Html::button('设置分类', [
                'id' => 'create',
                'data-toggle' => 'modal',
                'data-target' => '#create-modal',
            ]);
                if(!isset($goods->id)){
                    echo Html::label('&nbsp;&nbsp;添加完商品保存后才能设置分类', null, ['style'=>'color:red']);
                }
            ?>

            <?php $catUrl = Url::to(['shop-seller/goodscategory', 'type'=>$goods->goodtype,  'id'=>$goods->id])?>
            <?php
            Modal::begin([
                'id' => 'create-modal',
                'header' => '<h4 class="modal-title">选择商品分类</h4>',
                'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal" onclick="setCategory()">确定</a>',
            ]);
                $js = <<<JS
                    $.get("$catUrl", {},
                        function (data) {
                            $('.modal-body').html(data);
                        }
                    );
JS;
                $this->registerJs($js);
            Modal::end();
            ?>
        </div>
    </div></div>
    <br>
    <?php if (isset($goods->is_del)) {?>
        <div class="goodInfoBox">
            <?= $form->field($goods, 'is_del')->dropDownList([3=>'申请上架', 2=>'下架', 1=>'删除', 0=>'上架'], ['style'=>'width:30%'])->label('商品状态')?>
        </div>
    <?php }?>
    <br>
    <div class="goodInfoBox">
    <label>基本数据</label>
        <?php $goodsNo = $goods->goods_no;
            if(!isset($goods->goods_no)){
                $goodsNo = "JY" . uniqid();
            }
        ?>
        <table>
            <tr>
                <th>商品货号</th><th>市场价格</th><th>销售价格</th><th>成本价格</th>
                <?php if(Goods::TYPE_RESEARCH ==$goods->goodtype || Goods::TYPE_SIMULATE == $goods->goodtype){?>
                    <th>库存</th>
                <?php }?>
            </tr>
            <tr>
                <td style="width: 160px;"><?= $form->field($goods, 'goods_no', ['template'=>'{input}'])->textInput(['value'=>"$goodsNo", 'readonly'=>true, 'style'=>'width:150px'])?></td>
                <td style="width: 150px;"><?= $form->field($goods, 'market_price', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
                <td style="width: 150px;"><?= $form->field($goods, 'sell_price', ['template'=>'{input}{error}'])->textInput(['style'=>'width:120px'])?></td>
                <td style="width: 150px;"><?= $form->field($goods, 'cost_price', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
                <?php if(Goods::TYPE_RESEARCH ==$goods->goodtype || Goods::TYPE_SIMULATE == $goods->goodtype){?>
                    <td style="width: 150px;"><?= $form->field($goods, 'store_nums', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
                <?php }?>
            </tr>
        </table>
        <div style="display: none"><?= $form->field($goods, 'model_id')->textInput(['style'=>'width:25%', 'value'=>'1'])?></div>
    </div>
    <br>
    <div class="goodInfoBox">
        <p><label>商品规格</label></p>
        <?= Html::button('添加', ['onclick'=>'addSpec()']); ?>
        <table id="specTable">
            <tr>
                <th style="width: 150px;">规格名称</th>
                <th style="width: 150px;">市场价格</th>
                <th style="width: 150px;">销售价格</th>
                <th style="width: 150px;"></th>
            </tr>
            <?php foreach($goods->goodsSpec as $k => $spec) { ?>
            <tr>
                <td><input name="specName[]" type="text" style="width: 120px;" value="<?=$spec->specname?>"></td>
                <td><input name="specMktPrice[]" type="text" style="width: 120px;" value="<?=$spec->market_price?>"></td>
                <td><input name="specSellPrice[]" type="text" style="width: 120px;" value="<?=$spec->sell_price?>"></td>
                <td><a href="#" onclick="$(this).parent().parent().remove();delSpec('<?=$spec->specname?>')">&nbsp;&nbsp;删除</a></td>
            </tr>
            <?php } ?>

        </table>
    </div>
    <br>
    <div class="goodInfoBox">
        <?php if(isset($goods->goodtype)) {
            $arr = ArrayHelper::map(backend\models\seller\Brand::find()->where(['type' => $goods->goodtype])->asArray()->all(), 'id', 'name');
        } else {
            $arr = ArrayHelper::map(backend\models\seller\Brand::find()->asArray()->all(),'id','name');
        }?>
        <?=$form->field($goods, 'brandid')
            ->dropDownList($arr, ['style'=>'width:300px', 'prompt'=>'请选择'])?>
        <?= Html::label('若品牌列表不含所需品牌，请');?><?=Html::a('添加', '#', ['onclick'=>'$("#newBrand").show()'])?>
        <div id="newBrand" style="display:none"><input type="text" name="newBrand" style='width:200px'/></div>
        <?= $form->field($goods, 'brandversion')->textInput(['style'=>'width:200px'])->label("品牌型号")?>
    </div>
    <br>
    <?php if(Goods::TYPE_RESEARCH ==$goods->goodtype){?>
    <div class='goodInfoBox'>
       <p>商品类型</p> 
       <div id="container" style="float:left;">
               <?php
               foreach($goods->goodService as $key=>$service){
                   $sId = $service->id;
                   $serv = $service->service;
                   ?>
                   <ctrlarea id=<?='ctrl'.$sId?>>
                       <?=Html::a($serv, '#', ['onclick'=>"rmService($sId)"])?>
                       &nbsp;&nbsp;</ctrlarea>
               <?php }?>
               <?= Html::button('添加', ['onclick'=>'$("#service").show()']); ?>
               <?= Html::dropDownList('', null, $goods->optServs, [
                   'id'=>'service', 'onchange'=>'addService()', 'style'=>'display:none', 'prompt'=>'请选择'
               ]);?>
        </div>
        <br><br>
    </div>
    <br>     
    <?php }?>
    <div class="goodInfoBox">
        <p><label>产品相册</label></p>
        <p style="padding-top: 2px">可以上传多张图片，分辨率3000px以下，大小不得超过8M;点击上传的图像，可设置图像为商品主图</p>
        <div>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="f" name="f" />
            <input id="upload" name="file_upload" type="button" value='上传' class='btn btn-large btn-primary'>
            <div class="info"></div>
            <div class="text-info" >
                <br>
                <table>
                    <tr id="goodsImgs">
                        <?php foreach ($goods->goodsPhotoRelations as $k => $photoRelation) {
                            $photo = $photoRelation->photo->img;
                            $photoId = $photoRelation->photo_id; ?>
                            <?php
                                $imgId = "defaultImg_$photoId";
                                if ($photo == $goods->img) {
                                    $display = '';
                                } else {
                                    $display = 'display: none';
                                }
                            ?>
                            <td style="padding-left: 10px">
                                <img src='<?=Url::to("@web/$photo")?>' style="width: 100px;height: 100px;" onclick="defaultImg('<?=$photo?>', <?=$photoId?>)">
                                <br>
                                <a href="#" onclick="delImg(<?=$photoId?>);">&nbsp;&nbsp;删除</a>
                                <label class="defaultImg" style="<?=$display?>" id='<?=$imgId?>'>&nbsp;&nbsp;主图</label>
                            </td>
                        <?php }?>
                    </tr>
                </table>
            </div>
            <?= $form->field($goods, 'img', ['options'=>['style'=>"display:none"]])->textInput()?>
            <div class="pic-display"></div>
            <input type="button" name="btn" value="确认裁剪" class="btn btn-primary" />
        </div>
    </div>
    <br>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px;', 'class'=>'btn btn-large btn-primary'])?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary'])?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'action'=>['admin/goodscontent'],
        'id' => 'detailInfo',
        'options' => ['style'=>'padding-left: 20px; display:none'],
    ]); ?>
    <?= $form->field($goodsContent, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
        [
            'clientOptions' => [
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
                'fileUpload' => ['/redactor/upload/file'],
                'lang' => 'zh_cn',
                'plugins' => ['clips', 'fontcolor','imagemanager']
            ]
        ])->label('') ?>
    <?php
    if(isset($goods->id)) {
        echo $form->field($goodsContent, 'goodid', ['options' => ['style' => "display:none"]])->textInput(['value' => $goods->id]);
    }
    ?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px;', 'class'=>'btn btn-primary'])?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'action'=>['admin/goodsseo'],
        'id' => 'seo',
        'options' => ['style'=>'padding-left: 20px; display:none'],
    ]); ?>
    <?= $form->field($goods, 'id', ['options'=>['style'=>"display:none"]])?>
    <?= $form->field($goods, 'keywords')->textInput()?>
    <?= $form->field($goods, 'description')->textarea()?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px;', 'class'=>'btn btn-primary'])?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px;', 'class'=>'btn btn-primary'])?>
    <?php ActiveForm::end(); ?>
</div>

<script>
    var g_oJCrop = null;
    var actionId = "<?= Yii::$app->controller->action->id;?>";
    var goodsId = "<?=$goods->id?>";
    var imgUrlBase = '<?=Url::to("@web/")?>';
    //异步上传文件
    <?php $actionUrl = Url::to(['shop-seller/upload'])?>
    <?php $postUrl = Url::to(['shop-seller/cutpic'])?>
    new AjaxUpload("#upload", {
        action: <?="\"$actionUrl\""?>,
        name:'myfile',
        data: {},
        onSubmit: function(file, ext) {
            if (!(ext && /^(png|gif|jpeg|jpg)$/.test(ext))) {
                alert('文件格式不正确,请选择 png|gif|jpeg 格式的文件!', '系统提示');
                return false;
            }
            $(".info").html("<div style='color:#008000;margin:5px;'>上传中...</div>");
            $("input[name=btn]").show();
        },
        onComplete: function(file, response) {
            if(g_oJCrop!=null){g_oJCrop.destroy();}
                $(".pic-display").html("<div class='thum'><img id='target' src='"+ imgUrlBase + response +"'/></div>");
            $('#target').Jcrop({
                onChange: updatePreview,
                onSelect: updatePreview,
                aspectRatio: 1
            },function(){
                g_oJCrop = this;

                var bounds = g_oJCrop.getBounds();
                var x1,y1,x2,y2;
                if(bounds[0]/bounds[1] > 150/150)
                {
                    y1 = 0;
                    y2 = bounds[1];

                    x1 = (bounds[0] - 150 * bounds[1]/150)/2;
                    x2 = bounds[0]-x1;
                }
                else
                {
                    x1 = 0;
                    x2 = bounds[0];

                    y1 = (bounds[1] - 150 * bounds[0]/150)/2;
                    y2 = bounds[1]-y1;
                }
                g_oJCrop.setSelect([x1,y1,x2,y2]);

                //顺便插入略缩图
                $(".jcrop-holder").append("<div id='preview-pane'><div class='preview-container'><img  class='jcrop-preview' src='"+ imgUrlBase + response +"' /></div></div>");
            });
            //传递参数上传
            $("#f").val(response);

            //更新提示信息
            $(".info").html("<div style='color:#008000;margin:5px;'>准备裁剪。。。</div>");
        }
    });

    //更新裁剪图片信息
    function updatePreview(c) {
        if (parseInt(c.w) > 0){
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
            var bounds = g_oJCrop.getBounds();
            var rx = 150 / c.w;
            var ry = 150 / c.h;
            $('.preview-container img').css({
                width: Math.round(rx * bounds[0]) + 'px',
                height: Math.round(ry * bounds[1]) + 'px',
                marginLeft: '-' + Math.round(rx * c.x) + 'px',
                marginTop: '-' + Math.round(ry * c.y) + 'px'
            });
        }
    }

    //表单异步提交后台裁剪
    $("input[name=btn]").click( function(){
        var w=parseInt($("#w").val());
        if(!w){
            w=0;
        }
        if(w>0){
            $.post(<?="\"$postUrl\""?>,{'x':$("input[name=x]").val(),'y':$("input[name=y]").val(),'w':$("input[name=w]").val(),'h':$("input[name=h]").val(),'f':$("input[name=f]").val()},function(data){
                if(data.status==1){
                    $(".pic-display").html('');
                    $(".info").html("<div style='color:#008000;margin:10px 5px;'>裁剪成功!</div>")
                    $("input[name=btn]").hide();
                    var mtime = (new Date()).valueOf();
                    var imgId = 'defaultImg_' + mtime;
                    var inputId = 'inputDefault_' + mtime;
                    var info = '<td style="padding-left: 10px">' +
                        '<img src="' + imgUrlBase + data.data + '" style="width: 100px;height: 100px;" onclick="defaultThis('+ mtime + ')">'
                            + '<br>'
                            + '<a href="#" onclick="delImg(' + mtime + ')">&nbsp;&nbsp;删除</a>'
                            + '<input id=' + inputId + ' type="hidden" name="goodsImgs[]" value="' + data.data + '">'
                            + '<label class="defaultImg" style="display: none" id=' + imgId + '>&nbsp;&nbsp;主图</label>'
                            + '</td>';
                    $("#goodsImgs").append(info);
                }
            },'json');
        }else{
            $(".info").html("<div style='color:#E3583B;margin:5px;'>亲！还没有选择裁剪区域哦！</div>");
        }
    });

    function defaultThis(id)
    {
        $(".defaultImg").hide();
        $("#defaultImg_" + id).show();
        $("input[name='Goods[img]']").val($("#inputDefault_" + id).val());
    }

    function defaultImg(imgSrc, id)
    {
        $(".defaultImg").hide();
        $("#defaultImg_" + id).show();
        $("input[name='Goods[img]']").val(imgSrc);
    }

    function delImg(photoId)
    {
        if($("#defaultImg_" + photoId).css('display') != 'none') {
            $("input[name='Goods[img]']").val(null);
        }
        if('goodsedit' == actionId){
            $.get("<?=Url::to(['shop-seller/delimg'])?>" + "?goodsId=" + goodsId + "&photoId=" + photoId, function (data) {});
        }
        $("#defaultImg_" + photoId).parent().remove();
    }

    function setCategory(){
        var str = '';
        for(var cid in goodsCats) {
            str += '<ctrlarea id=' + 'ctrl' + cid + '>' +
                '<input name="goodsCategory[]" type="hidden" value=' + cid + '>' +
                '<a href="#">' +
                idname[cid] + '</a>&nbsp;&nbsp;</ctrlarea>';
        };
        $("#catContainer").html(str);
    }

    function rmCatNode(catId)
    {
        if(confirm('确定删除此分类？')) {
            var node = '#ctrl' + catId;
            if ('goodsedit' == actionId) {
                $.get("<?=Url::to(['shop-seller/delcat'])?>" + "?goodsId=" + goodsId + "&catId=" + catId, function (data) {
                    if (data == "OK") {
                        $(node).remove();
                    } else {
                        alert("删除节点失败");
                    }
                });
            } else {
                $(node).remove();
            }
        }
    }

    function addSpec()
    {
        var str = '';
        str += '<tr>'
            + '<td>' + '<input name="specName[]" type="text" style="width: 120px;">' + '</td>'
            + '<td>' + '<input name="specMktPrice[]" type="text" style="width: 120px;">' + '</td>'
            + '<td>' + '<input name="specSellPrice[]" type="text" style="width: 120px;">' + '</td>'
            + '<td>' + '<a href="#" onclick="$(this).parent().parent().remove();">&nbsp;&nbsp;删除</a>' + '</td>'
            + '</tr>';
        $("#specTable").append(str);
    }

    function delSpec(specName)
    {
        if('goodsedit' == actionId){
            $.get("<?=Url::to(['shop-seller/delspec'])?>" + "?goodsId=" + goodsId + "&specName=" + specName, function (data) {});
        }
    }

    function showBasicInfo()
    {
        $("#basicInfo").show();
        $("#detailInfo").hide();
        $("#seo").hide();
    }

    function  showDetailInfo()
    {
        $("#detailInfo").show();
        $("#basicInfo").hide();
        $("#seo").hide();
    }

    function showSeo()
    {
        $("#seo").show();
        $("#detailInfo").hide();
        $("#basicInfo").hide();
    }

    function addService()
    {
        var service = $("#service").val();
        if('goodsedit' == actionId){
            $.get("<?=Url::to(['shop-seller/addgoodservice'])?>" + "?goodId=" + <?=$goods->id?> + "&service=" + service, function (data) {
                if('Failed' != data){
                    var str = '<ctrlarea id=' + 'ctrl' + data + '>' +
                        '<a href="#" onclick="rmService(' + data + ')">' +
                        service + '</a>&nbsp;&nbsp;</ctrlarea>';
                    $("#container").prepend(str);
                }
            });
        } else {
            ctrlId = (new Date()).getTime();
            var str = '<ctrlarea id=' + 'ctrl' + ctrlId + '>' +
                '<input name="goodService[]" type="hidden" value=' + service + '>' +
                '<a href="#" onclick="rmService(' + ctrlId + ')">' +
                service + '</a>&nbsp;&nbsp;</ctrlarea>';
            $("#container").prepend(str);
        }

    }

    function rmService(id)
    {
        if(confirm('确定删除此分类？')) {
            var node = '#ctrl' + id;
            if('goodsedit' == actionId) {
                $.get("<?=Url::to(['shop-seller/delgoodservice'])?>" + "?id=" + id, function (data) {
                    if('OK' == data){
                        $(node).remove();
                    }
                });
            } else {
                $(node).remove();
            }
        }
    }
</script>

