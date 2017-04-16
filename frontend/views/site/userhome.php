<?php
use yii\helpers\Html;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
    <div class="box">
        <div class="umenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
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
<!--Show user info-->
<div class="userinfo">
    <div class="infoborder">
        <div class="info_bar">你好，<b>逐风慕雨</b> 欢迎回来</div>
        <div class="userinfo_box">
            <h5> 用户信息</h5>
            <dl class="userinfo_box">
                <dt>
                    <a ><?=html::img('@web/images/user_ico.gif', ['class'=>'user_ico_img'])?></a>
                    <a class="blue"><h5>修改头像</h5></a>
                </dt>
                <dd>
                    <div class="stat">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <col width="350px"/>
                            <col />
                            <tr>
                                <td>你的账户目前总积分：<b class="red">0 分</b>&nbsp;&nbsp;&nbsp;<a class="blue" href="">查看积分历史</a></td>
                                <td>你的订单交易总数量：<b class="red">0 笔</b>&nbsp;&nbsp;&nbsp;<a class="blue" href="">进入订单列表</a></td>
                            </tr>
                            <tr>
                                <td>总消费额：<b class="red2">￥</b></td>
                                <td>预存款余额：<b class="red2">￥</b></td>
                            </tr>
                            <tr>
                                <td>代金券：<b class="red2">0 张</b></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="stat">
                        <span>待评价商品：<label>(<b><a class="red2" href="">0</b>)</a></label></span>
                        <span>待付款订单：<label>(<b><a class="red2" href="">0</b>)</a></label></span>
                        <span>待确认收货：<label>(<b><a class="red2" href="">0</b>)</a></label></span>
                    </div>
                </dd>
            </dl>
       </div>
    </div>
    <h4>我的订单</h4>
    <div>
    </div>
</div>

