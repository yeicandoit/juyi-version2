<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<?=Html::cssFile('@web/css/jquery.Jcrop.css')?>

<?php
//frontend\assets\AppAsset does not work, so use registerJsFile to load javascript file.
$this->registerJsFile('@web/js/ajaxupload.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
$this->registerJsFile('@web/js/jquery.Jcrop.min.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
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
    <div class="info_bar"><b>商品编辑</b></div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->field($goods, 'name')->textInput(['style'=>'width:60%'])?>
    <?= $form->field($goods, 'search_words')->textInput(['style'=>'width:60%'])->label('关键词')
    ->hint('每个关键词最长为15个字符，超过后系统不予存储，每个词以逗号分隔')?>
    <div class="goodInfoBox">
    <div>
        <?=Html::label('所属分类');?>
        <div id="catContainer">
            <?php
                foreach($goods->shopCategoryExtends as $key=>$catExt){
                    $catId = $catExt->category_id;
                    $catName = $catExt->category->name;
            ?>
            <ctrlarea id=<?='ctrl'.$catId?>>
                <input name="goodsCategory[]" type="hidden" value=<?=$catId?>>
                <?=Html::a($catName, '#', ['onclick'=>"rmCatNode($catId)"])?>
            &nbsp;&nbsp;</ctrlarea>
            <?php }
            ?>
        </div>
        <div>
            <?= Html::button('设置分类', [
                'id' => 'create',
                'data-toggle' => 'modal',
                'data-target' => '#create-modal',
            ]); ?>
            <?php
            Modal::begin([
                'id' => 'create-modal',
                'header' => '<h4 class="modal-title">选择商品分类</h4>',
                'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal" onclick="setCategory()">确定</a>',
            ]);
                $js = <<<JS
                    $.get('/index.php?r=shop-seller/goodscategory', {},
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
            <?= $form->field($goods, 'is_del')->radioList([3=>'申请上架', 2=>'下架'])->label('商品状态')?>
        </div>
    <?php }?>
    <br>
    <div class="goodInfoBox">
    <label>基本数据</label>
        <?php $goodsNo = $goods->goods_no;
            if(!isset($goods->goods_no)){
                $goodsNo = "JY" . time();
            }
        ?>
        <table>
            <tr>
                <th>商品货号</th><th>市场价格</th><th>销售价格</th><th>成本价格</th>
            </tr>
            <tr>
                <td style="width: 150px;"><?= $form->field($goods, 'goods_no', ['template'=>'{input}'])->textInput(['value'=>"$goodsNo", 'readonly'=>true, 'style'=>'width:120px'])?></td>
                <td style="width: 150px;"><?= $form->field($goods, 'market_price', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
                <td style="width: 150px;"><?= $form->field($goods, 'sell_price', ['template'=>'{input}{error}'])->textInput(['style'=>'width:120px'])?></td>
                <td style="width: 150px;"><?= $form->field($goods, 'cost_price', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
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
        </table>
    </div>
    <br>
    <div class="goodInfoBox">
        <?=$form->field($goods, 'brandid')
            ->dropDownList(ArrayHelper::map(frontend\models\ShopBrand::find()->asArray()->all(),'id','name'), ['style'=>'width:300px'])?>
        <?= $form->field($goods, 'brandversion')->textInput(['style'=>'width:200px'])->label("品牌型号")?>
    </div>
    <br>
    <div class="goodInfoBox">
        <p><label>产品相册</label></p>
        <p style="padding-top: 2px">可以上传多张图片，分辨率3000px以下，大小不得超过8M</p>
        <div>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="f" name="f" />
            <input id="upload" name="file_upload" type="button" value='上传' class='btn btn-large btn-primary'>
            <input type="button" name="btn" value="确认裁剪" class="btn" />
            <div class="info"></div>
            <div class="text-info" >
                <table><tr id="goodsImgs"></tr></table>
            </div>
            <?= $form->field($goods, 'img', ['options'=>['style'=>"display:none"]])->textInput()?>
            <div class="pic-display"></div>
        </div>
    </div>
    <br>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px;', 'class'=>'btn btn-large btn-primary'])?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-large btn-primary'])?>
    <?php ActiveForm::end(); ?>
</div>

<script>
    var g_oJCrop = null;
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
            $(".pic-display").html("<div class='thum'><img id='target' src='"+response+"'/></div>");
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
                $(".jcrop-holder").append("<div id='preview-pane'><div class='preview-container'><img  class='jcrop-preview' src='"+response+"' /></div></div>");
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
                            '<img src="' + data.data + '" style="width: 100px;height: 100px;" onclick="defaultThis('+ mtime + ')">'
                            + '<br>'
                            + '<a href="#" onclick="$(this).parent().remove();">&nbsp;&nbsp;删除</a>'
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
        $("input[name='img']").val($("#inputDefault_" + id).val());
    }

    function setCategory(){
        var str = '';
        $("input[name='category']:checked").each(function(){
            str += '<ctrlarea id=' + 'ctrl' + $(this).val() + '>' +
                '<input name="goodsCategory[]" type="hidden" value=' + $(this).val() + '>' +
                '<a href="#" onclick="rmCatNode(' + $(this).val() + ')">'+
               idname[$(this).val()] + '</a>&nbsp;&nbsp;</ctrlarea>';
        });
        $("#catContainer").append(str);
    }

    function rmCatNode(id)
    {
        if(confirm('确定删除此分类？')) {
            node = '#ctrl' + id;
            $(node).remove();
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
</script>

