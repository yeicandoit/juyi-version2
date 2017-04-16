<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
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
    </div>
    <div class="blank"></div>
    <?= $form->field($goods, 'sort')->textInput(['style'=>'width:25%'])->label('商品排序')?>
    <?= $form->field($goods, 'unit')->textInput(['style'=>'width:25%'])->label('计量单位显示')?>
    <?= $form->field($goods, 'is_del')->radioList([3=>'申请上架', 2=>'下架'])->label('计量单位显示')?>
    <label>基本数据</label>
    <?php $goodsNo = $goods->goods_no;
        if(!isset($goods->goods_no)){
            $goodsNo = "JY" . time();
        }
    ?>
    <table>
        <tr>
            <th>商品货号</th><th>库存</th><th>市场价格</th><th>销售价格</th><th>成本价格</th><th>重量(克)</th>
        </tr>
        <tr>
            <td style="width: 150px;"><?= $form->field($goods, 'goods_no', ['template'=>'{input}'])->textInput(['value'=>"$goodsNo", 'readonly'=>true, 'style'=>'width:120px'])?></td>
            <td style="width: 150px;"><?= $form->field($goods, 'store_nums', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
            <td style="width: 150px;"><?= $form->field($goods, 'market_price', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
            <td style="width: 150px;"><?= $form->field($goods, 'sell_price', ['template'=>'{input}{error}'])->textInput(['style'=>'width:120px'])?></td>
            <td style="width: 150px;"><?= $form->field($goods, 'cost_price', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
            <td style="width: 150px;"><?= $form->field($goods, 'weight', ['template'=>'{input}'])->textInput(['style'=>'width:120px'])?></td>
        </tr>
    </table>
    <div style="display: none"><?= $form->field($goods, 'model_id')->textInput(['style'=>'width:25%', 'value'=>'1'])?></div>
    <div style="border: 1px groove #8699a4;padding-left: 10px; padding-top: 5px;">
        <p><label>添加规格</label></p>
        <div id="specPay">
            <label>支付种类:</label>
            <ctrlarea id="pay_0">
                <input name="specPay[]" value="直接支付" type="hidden">
                <?=Html::a('直接支付','#',['onclick'=>'rmSpecNode("0")'])?>
            </ctrlarea>
            <label id='addPay'><?=Html::a('+', '#', ['onclick'=>'addPay()']);?></label>
        </div>
        <div id="specTest">
            <label>测试种类:</label>
            <ctrlarea id="test_0">
                <input name="specTest[]" value="直接测试" type="hidden">
                <?=Html::a('直接测试','#',['onclick'=>'rmTestNode("0")'])?>
            </ctrlarea>
            <label id='addTest'><?=Html::a('+', '#', ['onclick'=>'addTest()']);?></label>
        </div>
    </div>
    <?=$form->field($goods, 'brand_id')->dropDownList(ArrayHelper::map(frontend\models\ShopBrand::find()->asArray()->all(),'id','name'), ['style'=>'width:300px'])?>
    <div style="border: 1px groove #8699a4;padding-left: 10px; padding-top: 5px;">
        <p><label>产品相册</label></p>
        <?=Html::fileInput('goodsImgs[]',null,['multiple' => true, 'accept' => 'image/*'])?>
        <p style="padding-top: 2px">可以上传多张图片，分辨率3000px以下，大小不得超过8M</p>
    </div>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px'])?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px'])?>
    <?php ActiveForm::end(); ?>

    <div>
        <h3>商品图像上传：</h3>

        <div class="text">
            <img class="img-circle tx" src="/avatar/photo.jpg" alt=""/>
        </div>
        <form id="frm" action="#" method="post">
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="f" name="f" />
            <input id='upload' name="file_upload" type="button" value='上传' class='btn btn-large btn-primary'>
            <input type="button" name="btn" value="确认裁剪" class="btn" />
        </form>
        <div class="info"></div>
        <div class="pic-display"></div><div class="text-info"></div>

    </div>
</div>

<script>
    var url="http://"+window.location.host;
    var g_oJCrop = null;
    //异步上传文件
    new AjaxUpload("#upload", {
        action: 'index.php?r=shop-seller/upload',
        name:'myfile',
        data: {},
        onSubmit: function(file, ext) {
            if (!(ext && /^(png|gif|jpeg|jpg)$/.test(ext))) {
                alert('文件格式不正确,请选择 png|gif|jpeg 格式的文件!', '系统提示');
                return false;
            }
            if($(".text-info img").length>0){
                $(".info").html("<div style='color:#E3583B;margin:5px;'>文件已经裁剪过！</div>");return false;
            }
            $(".info").html("<div style='color:#008000;margin:5px;'>上传中...</div>");
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
            $.post('index.php?r=shop-seller/cutpic',{'x':$("input[name=x]").val(),'y':$("input[name=y]").val(),'w':$("input[name=w]").val(),'h':$("input[name=h]").val(),'f':$("input[name=f]").val()},function(data){
                if(data.status==1){
                    $(".pic-display").remove();
                    $(".info").html("<div style='color:#008000;margin:10px 5px;'>裁剪成功!</div>")
                    $(".text-info").html("<img src='"+data.data+"'>");
                    $(".tx").attr('src',data.data);
                    $("input[name=btn]").hide();
                }
            },'json');
        }else{
            $(".info").html("<div style='color:#E3583B;margin:5px;'>亲！还没有选择裁剪区域哦！</div>");
        }
    });

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

    function rmSpecNode(id)
    {
        if(confirm('确定删除此支付规格？')){
            $('#pay_'+id).remove();
        }
    }

    function addPay()
    {
        $('#addPay').remove();
        var mtime = (new Date()).valueOf();
        var str = '';
        var ctrlId = 'pay_' + mtime;
        str += '<ctrlarea id=' + ctrlId + '>' +
            '<input name="specPay[]" type="text" id='+ 'inputPay_' + mtime + '>' +
            '<a href="#" class="btn btn-xs" onclick="cfmPay(' + mtime + ')">'+
            '确定' + '</a>&nbsp;&nbsp;</ctrlarea>';
        $('#specPay').append(str);
    }

    function cfmPay(id)
    {
        if(confirm('确定添加？')){
            var inputPay = $('#inputPay_'+id).val();
            $('#pay_'+id).remove();
            var str = '';
            str += '<ctrlarea id=' + 'pay_' + id + '>' +
                '<input name="specPay[]" type="hidden" value='+ inputPay + '>' +
                '<a href="#" onclick="rmSpecNode('+ id +')">'+
                inputPay + '</a>&nbsp;&nbsp;</ctrlarea>' +
                '<label id="addPay"><a href="#", onclick="addPay()">+</a></label>';
            $('#specPay').append(str);
        } else {
            $('#pay_'+id).remove();
            var str = '<label id="addPay"><a href="#", onclick="addPay()">+</a></label>';
            $('#specPay').append(str);
        }
    }

    function addTest()
    {
        $('#addTest').remove();
        var mtime = (new Date()).valueOf();
        var str = '';
        var ctrlId = 'test_' + mtime;
        str += '<ctrlarea id=' + ctrlId + '>' +
            '<input name="specTest[]" type="text" id='+ 'inputTest_' + mtime + '>' +
            '<a href="#" class="btn btn-xs" onclick="cfmTest(' + mtime + ')">'+
            '确定' + '</a>&nbsp;&nbsp;</ctrlarea>';
        $('#specTest').append(str);
    }

    function cfmTest(id)
    {
        if(confirm('确定添加？')){
            var inputTest = $('#inputTest_'+id).val();
            $('#test_'+id).remove();
            var str = '';
            str += '<ctrlarea id=' + 'test_' + id + '>' +
                '<input name="specTest[]" type="hidden" value='+ inputTest + '>' +
                '<a href="#" onclick="rmTestNode('+ id +')">'+
                inputTest + '</a>&nbsp;&nbsp;</ctrlarea>' +
                '<label id="addTest"><a href="#", onclick="addTest()" >+</a></label>';
            $('#specTest').append(str);
        } else {
            $('#test_'+id).remove();
            var str = '<label id="addTest"><a href="#", onclick="addTest()">+</a></label>';
            $('#specTest').append(str);
        }
    }

    function rmTestNode(id)
    {
        if(confirm('确定删除此测试规格？')){
            $('#test_'+id).remove();
        }
    }
</script>

