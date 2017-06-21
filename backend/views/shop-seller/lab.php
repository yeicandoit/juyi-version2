<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>

<table>
    <tr>
    <td valign="top" >
        <div style="border-right:1px inset; width: 210px">
            <li style="width:95%;background-color: #116fb5;border-radius:0 0 0 15px;color: #fdfdfd;font-size: 15px;padding-left: 30px">
                实验室信息
            </li>
            <?=Html::img("$lab->logo", ['style'=>'width:200px;height:150px;padding-top:5px'])?><br>
            <?=Html::label('名称:').$lab->true_name?> <br>
            <?=Html::label('评分:')?><span class="grade"><i style="width: 70px;"></i></span><br>
            <?=Html::label('所在地:').$lab->getLocation("/")?> 
        </div>
        <div style="border-right:1px inset; width: 210px">
            <li style="width:95%;background-color: #116fb5;border-radius:0 0 0 15px;color: #fdfdfd;font-size: 15px;padding-left: 30px">
                同类实验室
            </li>
            <?=Html::img('images/lab.png', ['style'=>'width:80px;height:60px;padding-top:5px'])?> 交大生物质能<br>
            <?=Html::img('images/lab.png', ['style'=>'width:80px;height:60px;padding-top:5px'])?> 交大生物质能<br>
            <?=Html::img('images/lab.png', ['style'=>'width:80px;height:60px;padding-top:5px'])?> 交大生物质能<br>
        </div>
    </td>
    <td style="padding-left: 20px;min-width: 850px; max-width: 1000px;" valign="top">
        <div style="height: 100px; background-image: url(images/labAd.jpg);" align="center" >
            <?=Html::label('淏博检测暑期测试特惠！', null, ['style'=>'margin-top:40px;color:red;font-size:25px']);?>
        </div>
        <div align="center" style="height: 36px;background-color: #116fb5">
            <ul id="menu">
                <li><a href="#" onclick="showlab(1)">科研测试服务</a></li>
                <li><a href="#" onclick="showlab(2)">实验室概况</a></li>
                <li><a href="#" onclick="showlab(3)">科研队伍</a></li>
                <li><a href="#" class="last" onclick="showlab(4)">科研成果</a></li>
            </ul>
        </div>
        <div id="showlab_1" style="padding-top: 10px">
            <?php
                foreach($model as $k=>$g) { ?>
                    <div style='float: left; padding-left: 5px; padding-top:10px'>
                        <?=Html::img($g->img,['style'=>'width:200px;height:200px'])?> <br><br>
                        <div style="height:100px">
                            <?=Html::label($g->name, null, ['style'=>'width:200px'])?>
                            <div style="width:200px"><font size='2'>品牌/型号:<?=isset($g->brandid)? $g->brand->name: ''?>&nbsp;&nbsp;<font size='2'><?=$g->brandversion?></font></font></div>
                            <div><font size='2'>测试价:<?=$g->sell_price?>元/样</font></div>
                            <div><font size='1px'><s>市场价:<?=$g->market_price?>元/样</s></font></div>
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
</script>


