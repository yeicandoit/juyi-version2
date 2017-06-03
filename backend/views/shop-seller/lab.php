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
            <?=Html::img('images/lab.png', ['style'=>'width:200px;height:150px;padding-top:5px'])?><br>
            <?=Html::label('名称:')?> 上海交大生物质能研究中心<br>
            <?=Html::label('评分:')?><span class="grade"><i style="width: 70px;"></i></span><br>
            <?=Html::label('所在地:')?> 上海闵行
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
    <td style="padding-left: 20px;min-width: 650px; max-width: 800px" valign="top">
        <div style="height: 100px;" align="center" >
            <?=Html::label('这里填写标语');?>
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
                    <div style='float: left; padding-left: 20px'>
                        <?=Html::img($g->img,['style'=>'width:150px;height:150px'])?> <br><br>
                        <table style="width: 150px; border-top: solid 1px #7f8c8d">
                            <tr style="height: 30px">
                                <td><?=Html::label($g->name)?></td>
                                <td><?=Html::label('测试价格', null, ['style'=>'color:#116fb5'])?></td>
                            </tr>
                            <tr style="height: 20px">
                                <td>品牌:<?=isset($g->brandid)? $g->brand->name: '无'?></td>
                                <td><?=Html::label("￥{$g->sell_price}元/样", null, ['style'=>'color:#116fb5'])?></td>
                            </tr>
                            <tr>
                                <td>型号:<?=$g->brandversion?></td>
                                <td><s>￥<?=$g->market_price?>元/样</s></td>
                            </tr>
                        </table>
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


