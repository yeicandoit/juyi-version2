<?php
use yii\helpers\Html;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
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
    <div class="info_bar"><b>概要信息</b></div>
    <div class="blank"></div>
    <div>
        商品总数量：<b class="blue">9 件</b>
        &nbsp;&nbsp;&nbsp;待回复咨询: <b class="blue">0 条</b>
        &nbsp;&nbsp;&nbsp;商品评论数: <b class="blue">28 条</b>
        &nbsp;&nbsp;&nbsp;退款申请: <b class="blue">0 条</b>
        &nbsp;&nbsp;&nbsp;总销售量: <b class="blue">50 件</b>
        &nbsp;&nbsp;&nbsp;信用评分: <b class="blue">0 分</b>
    </div>
    <div class="blank"></div>
    <div class="blank"></div>
    <div class="info_bar"><b>销售统计</b></div>
</div>


