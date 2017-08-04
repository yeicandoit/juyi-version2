<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>

<style type="text/css">
.goodshow {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    background-color: #f6f6f6;
}
.goodbox {
    float: left;
    padding-top:15px;
    padding-left: 6px;
    padding-right: 6px;
}
.singleline {
    width:200px;
    white-space:nowrap;
    text-overflow:ellipsis;
    overflow: hidden;
}
</style>

<table>
    <tr>
    <td valign="top" >
        <div style="width: 210px">
            <li style="width:95%;background-color: #116fb5;border-radius:0 0 0 15px;color: #fdfdfd;font-size: 15px;padding-left: 30px">
                实验室信息
            </li>
            <?=Html::img("$lab->logo", ['style'=>'width:200px;height:150px;padding-top:5px'])?><br>
            <?=Html::label('名称:').$lab->true_name?> <br>
            <?=Html::label('评分:')?><span class="grade"><i style="width: 70px;"></i></span><br>
            <?=Html::label('所在地:').$lab->getLocation("/")?> 
        </div>
        <div style="width: 210px">
            <li style="width:95%;background-color: #116fb5;border-radius:0 0 0 15px;color: #fdfdfd;font-size: 15px;padding-left: 30px">
                同类实验室
            </li>
        <table style="border-collapse:separate; border-spacing:3px;">
            <?php
            if(null != $relatedLabs) {
                foreach ($relatedLabs as $k => $v) {
                    ?>
                    <tr>
                    <td>
                        <a href=<?=Url::to(['shop-seller/lab', 'id'=>$v->id])?>><?= Html::img("@web/$v->logo", ['style' => 'width:80px;height:60px;padding-top:5px']) ?></a>
                    </td>
                    <td>
                        <a href=<?=Url::to(['shop-seller/lab', 'id'=>$v->id])?>><?=$v->true_name?></a>
                    </td>
                    </tr>
                    <?php
                }
            }?>
        </table>
        </div>
    </td>
    <td style="padding-left: 20px;min-width: 850px; max-width: 1000px;" valign="top">
        <div style="height: 100px; background-image: url(images/labAd.jpg);" align="center" >
            <?=Html::label($lab->ext->reserve1, null, ['style'=>'margin-top:40px;color:red;font-size:25px']);?>
        </div>
        <div align="center" style="height: 36px;background-color: #116fb5">
            <ul id="menu">
                <li><a href="#" onclick="showlab(1)">科研商品</a></li>
                <li><a href="#" onclick="showlab(2)">公司简介</a></li>
                <li><a href="#" onclick="showlab(3)">科研队伍</a></li>
                <li><a href="#" class="last" onclick="showlab(4)">科研成果</a></li>
            </ul>
        </div>
        <div id="showlab_1" style="padding-top: 10px">
            <?php
                foreach($model as $k=>$g) { ?>
                    <div class='goodbox'>
                    <div class='goodshow'>
                        <a href=<?=Url::to(['site/goodinfo', 'id'=>$g->id])?>><?=Html::img($g->img,['style'=>'width:200px;height:200px'])?></a> <br><br>
                        <div style="height:130px">
                            <a href=<?=Url::to(['site/goodinfo', 'id'=>$g->id])?>><?=Html::label("&nbsp;&nbsp;$g->name", null, ['style'=>'width:200px', 'class'=>'goodName'])?></a>
                            <div class='singleline'>&nbsp;&nbsp;<font size='2'>品牌:<?=isset($g->brandid)? $g->brand->name: ''?>&nbsp;&nbsp;</font></div>
                            <div class='singleline'>&nbsp;&nbsp;<font size='2'>型号:<?=$g->brandversion?></div>
                            <div><font size='2'>&nbsp;&nbsp;销售价格:<?=$g->sell_price?>元/个</font></div>
                            <div><font size='1px'>&nbsp;&nbsp;<s>市场价格:<?=$g->market_price?>元/个</s></font></div>
                        </div>
                    </div>
                    </div>
            <?php }?>
            <div style="clear: both;"><?= LinkPager::widget(['pagination' => $pages]);?></div>
        </div>
        <div id="showlab_2" style="padding-top: 10px;display:none;">
            <?=$labInfo->description?>
        </div>
        <div id="showlab_3" style="padding-top: 10px;display:none;">
            <?=$labInfo->team?>
        </div>
        <div id="showlab_4" style="padding-top: 10px;display:none;">
            <?=$labInfo->outwork?>
        </div>
    </td>
    </tr>
</table>

<script type="text/javascript">
    function showlab(id)
    {
        for(var i = 1; i <= 4; i++ ){
            $("#showlab_"+i).hide();
        }
        $("#showlab_"+id).show();
    }
    window.onload = function(){
        $('.goodName').each(function(key,value){
            str = $(value).text();
            textLeng = 40;
            if(str.length > textLeng){
                $(this).html(str.substring(0,textLeng )+"...");
            }
        }); 
    }
</script>


