<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
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
    <div class="info_bar"><label id="manaddr" style="color: #0000aa"><b>订单详情</b></label></div>
    <div style="height: 20px;"></div>
    <div class="detail-order">
        <?php foreach($order->orderStep as $eventTime => $stepData){?>
            <p><?php echo isset($eventTime)?$eventTime:"";?>&nbsp;&nbsp;<span class="black"><?php echo isset($stepData)?$stepData:"";?></span></p>
        <?php }?>
        <p>
            <b>订单号：</b><?php echo isset($order->order_no)?$order->order_no:"";?>
            <b>下单日期：</b><?php echo isset($order->create_time)?$order->create_time:"";?>
            <b>状态：</b>
			<span class="red2">
				<b style="color: #d43f3a"><?php echo $order->orderStatusText($order->orderStatus);?></b>
	        </span>
        </p>
        <?php if(in_array($order->orderStatus,array(1,2))){?>
            <?= Html::submitButton('取消订单', [ 'style' => 'width:100px;', 'onclick'=>"orderOp($order->id, 'cancel')"]) ?>
        <?php }?>
        <?php if($order->orderStatus == 2){?>
            <?= Html::submitButton('立即付款', [ 'style' => 'width:100px;']) ?>
        <?php }?>
        <?php if(in_array($order->orderStatus,array(11,3))){?>
            <?= Html::submitButton('确认收货', [ 'style' => 'width:100px;', 'onclick'=>"orderOp($order->id, 'confirm')"]) ?>
        <?php }?>
    </div>
    <div style="height: 20px;"></div>
    <label style="color: #985f0d; padding-left: 10px">收件人信息</label>
    <?= DetailView::widget([
        'model' => $order,
        'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'accept_name',
            ['label'=>'地址', 'value'=>$order->acceptAdr],
            'postcode',
            'telphone',
            'mobile',
        ],
    ]) ?>
    <label style="color: #985f0d; padding-left: 10px">支付及配送方式</label>
    <?= DetailView::widget([
        'model' => $order,
        'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'配送方式', 'value'=>isset($order->shopDelivery)?$order->shopDelivery->name:''],
            ['label'=>'支付方式', 'value'=>$order->shopPayment->name],
            ['label'=>'运费', 'value'=>$order->real_freight],
            ['label'=>'物流公司', 'value'=>$order->freight['freight_name']],
            ['label'=>'快递单号', 'value'=>$order->freight['delivery_code']],
        ],
    ]) ?>
    <label style="color: #985f0d; padding-left: 10px">商品清单</label>
    <div style="border: 1px groove #e8e8e8; padding-left: 10px">
    <table width="100%" cellpadding="0" cellspacing="0" align="center" style="border:10px; solid #123456;">
        <tr>
            <th>图片</th>
            <th>商品名称</th>
            <th>赠送积分</th>
            <th>商品价格</th>
            <th>优惠金额</th>
            <th>商品数量</th>
            <th>小计</th>
            <th>配送</th>
        </tr>
        <tr>
            <td><a href=''><img class='user_fav_img' src='/images/user_ico.gif'/></a></td>
            <td><a href=''><?=$order->shopOrderGoods->goods->name?></a></td>
            <td><?= $order->point * $order->shopOrderGoods->goods_nums?></td>
            <td>￥<?= $order->shopOrderGoods->goods_price?></td>
            <td>￥<?= $order->shopOrderGoods->goods_price - $order->shopOrderGoods->real_price?></td>
            <td>x<?= $order->shopOrderGoods->goods_nums?></td>
            <td>￥<?= $order->shopOrderGoods->goods_nums * $order->shopOrderGoods->real_price?></td>
            <td><?= $order->sendStatus?></td>
        </tr>
    </table>
    </div>
    <div style="float: right; padding-top: 20px;">
        <p>商品总金额：￥<?php echo $order->payable_amount;?></p>
        <p>+ 运费：￥<label id="freightFee"><?php echo $order->real_freight;?></label></p>

        <?php if($order->taxes > 0){?>
            <p>+ 税金：￥<?php echo $order->taxes;?></p>
        <?php }?>
        <?php if($order->pay_fee > 0){?>
            <p>+ 支付手续费：￥<?php echo $order->pay_fee;?></p>
        <?php }?>
        <?php if($order->insured > 0){?>
            <p>+ 保价：￥<?php echo $order->insured ;?></p>
        <?php }?>
        <p>订单折扣或涨价：￥<?php echo $order->discount;?></p>
        <?php if($order->promotions > 0){?>
            <p>- 促销优惠金额：￥<?php echo $order->promotions;?></p>
        <?php }?>
        <hr style="height:1px;border:none;border-top:1px solid #0044cc;" />
        <p>订单支付金额：<span class="red2">￥<label><?php echo $order->order_amount;?></label></span></p>
    </div>
</div>
<script language="javascript">
    function orderOp(id, op)
    {
        $.get("/index.php?r=site/userorderop&id=" + id + "&op=" + op,function(data){ alert(data);});
    }
</script>



