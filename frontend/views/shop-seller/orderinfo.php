<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
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
    <div class="info_bar"><b>订单查看</b>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单附言</b>', 'javascript:select_tab("6")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单日志</b>', 'javascript:select_tab("5")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单备注</b>', 'javascript:select_tab("4")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;发货记录</b>', 'javascript:select_tab("3")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;收退款记录</b>', 'javascript:select_tab("2")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;基本信息</b>', 'javascript:select_tab("1")')?></span>
    </div>
    <div class="module_content" id="tab-1">
        <div class="blank"></div>
        <label style="color: #985f0d; padding-left: 10px">订单信息</label>
        <?= DetailView::widget([
            'model' => $order,
            'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                'order_no',
                ['label'=>'当前状态', 'value'=>$order->orderStatusText($order->orderStatus)],
                ['label'=>'支付状态', 'value'=>$order->getOrderPayStatusText($order->pay_status)],
                ['label'=>'配送状态', 'value'=>$order->orderDistributionStatusText],
                ['label'=>'订单类型', 'value'=>$order->orderTypeText],
                ['label'=>'平台货款结算', 'value'=>1 == $order->is_checkout ? '已结算': '未结算'],
            ],
        ]) ?>

        <div style="border: 1px groove #e8e8e8; padding-left: 10px">
            <table width="100%" cellpadding="0" cellspacing="0" align="center" style="border:10px; solid #123456;">
                <tr>
                    <th>商品名称</th>
                    <th>商品价格</th>
                    <th>实际价格</th>
                    <th>商品数量</th>
                    <th>小计</th>
                    <th>配送方式</th>
                </tr>
                <tr>
                    <td><a href=''><?=$order->shopOrderGoods->goods->name?></a></td>
                    <td>￥<?= $order->shopOrderGoods->goods_price?></td>
                    <td>￥<?= $order->shopOrderGoods->real_price?></td>
                    <td>x<?= $order->shopOrderGoods->goods_nums?></td>
                    <td>￥<?= $order->shopOrderGoods->goods_nums * $order->shopOrderGoods->real_price?></td>
                    <td><?= $order->sendStatus?></td>
                </tr>
            </table>
        </div>
        <div class="blank"></div>
        <label style="color: #985f0d; padding-left: 10px">订单金额明细</label>
        <?php
            $discont = Html::label('&nbsp;&nbsp;折扣用" - ",涨价用" + "');
            if($order->orderStatus < 3){
                $discont = Html::input('text', 'discount', $order->discount, ['onchange'=>"updateDiscount();"]) . $discont;
            } else {
                $discont = "$order->discount" . $discont;
            }

            $collectionDocs = $order->shopCollectionDocs;
            $payAmount = 0;
            foreach($collectionDocs as $key => $item){
                if(0 == $item->if_del){
                    $payAmount = $payAmount + $item->amount;
                }
            }
        ?>
        <?= DetailView::widget([
            'model' => $order,
            'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                ['label'=>'商品总额', 'value'=>"￥$order->payable_amount"],
                ['label'=>'配送费用', 'value'=>"￥$order->real_freight"],
                ['label'=>'保价费用', 'value'=>"￥$order->insured"],
                ['label'=>'税金', 'value'=>"￥$order->taxes"],
                ['label'=>'优惠总额', 'value'=>"￥$order->promotions"],
                [
                    'label'=>'增加或减少金额',
                    'format'=>'raw',
                    'value'=>$discont,
                ],
                //['label'=>'订单总额', 'value'=>"￥$order->order_amount"],
                ['label'=>'订单总额', 'format'=>'raw', 'value'=>Html::label("￥$order->order_amount",null,['id'=>'orderAmount'])],
                ['label'=>'已支付金额', 'value'=>"￥$payAmount"],
            ],
        ]) ?>
        <label style="color: #985f0d; padding-left: 10px">支付和配送信息</label>
        <?= DetailView::widget([
            'model' => $order,
            'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                ['label'=>'配送方式', 'value'=>$order->shopDelivery->name],
                ['label'=>'商品重量', 'value'=>$order->shopOrderGoods->goods_weight],
                ['label'=>'支付方式', 'value'=>$order->shopPayment->name],
                ['label'=>'是否开票', 'value'=>$order->invoice ? '是' : '否'],
                ['label'=>'发票抬头', 'value'=>$order->invoice_title],
                ['label'=>'可得积分', 'value'=>$order->point],
            ],
        ]) ?>
        <label style="color: #985f0d; padding-left: 10px">收货人信息</label>
        <?= DetailView::widget([
            'model' => $order,
            'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                ['label'=>'发票日期', 'value'=>$order->send_time],
                ['label'=>'姓名', 'value'=>$order->accept_name],
                'mobile',
                'telphone',
                ['label'=>'地区', 'value'=>$order->acceptAdr],
                'address',
                'postcode',
                'accept_time',
            ],
        ]) ?>
    </div>
    <div class="module_content" id="tab-2" style="display: none;">
        <div class="blank"></div>
        <label style="color: #985f0d; padding-left: 10px">收款单据</label>
        <?php
            $coldoc = $order->shopCollectionDocs;
        ?>
        <?php foreach($coldoc as $key => $item){?>
            <?= DetailView::widget([
                'model' => $item,
                'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
                'attributes' => [
                    ['label'=>'付款时间', 'value'=>$item->time],
                    'amount',
                    ['label'=>'支付方式', 'value'=>$item->payment->name],
                    'note',
                    ['label'=>'状态', 'value'=>$item->pay_status ? '支付完成' : '准备中'],
                ],
            ]);?>
        <?php }?>

        <label style="color: #985f0d; padding-left: 10px">退款单据</label>
        <?php
            $refdoc = $order->shopRefundmentDocs;
        ?>
        <?php foreach($refdoc as $key => $item){?>
            <?php
                $orderGoods = $item->shopOrderGoods;
                $goods = '';
                foreach($orderGoods as $k => $i){
                    //$url = Html::a("$i->name X $i->goods_nums", '', ['target'=>'_blank', 'title'=>"$i->name"]);
                    $goods_array = json_decode($i->goods_array);
                    $url = Html::a($goods_array['name'] . 'X' . $i->goods_nums, '');
                    $goods = $goods . "<p>$url</p>";
                }
            ?>
            <?= DetailView::widget([
                'model' => $item,
                'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
                'attributes' => [
                    ['label'=>'退款商品', 'format' => 'raw','value'=>$goods],
                    'amount',
                    'time',
                    ['label'=>'状态', 'value'=>$item->refundmentText()],
                    'content',
                ],
            ]);?>
        <?php }?>
    </div>
    <div class="module_content" id = 'tab-3' style="display: none;">
        <div class="blank"></div>
        <?php
            $dataProvider = $order->shopDeliveryDocSearch;
        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'time',
                ['label'=>'配送方式', 'value'=>function($model){
                    return $model->shopDelivery->name;
                }],
                ['label'=>'物流公司', 'value'=>function($model){
                    return isset($model->freight0->freight_name) ? $model->freight0->freight_name : '';
                }],
                'delivery_code',
                'name',
                ['label'=>'备注', 'value'=>'note'],
            ],
        ]); ?>
    </div>
    <div class="module_content" id = 'tab-4' style="display: none;">
        <div class="blank"></div>
        <?php $form = ActiveForm::begin([]); ?>
        <div style="display: none"><?= $form->field($order, 'id')?></div>
        <?= $form->field($order, 'note', [])->textarea(['rows'=>3, 'style'=>'width:350px'])->label('订单备注')?>
        <?= Html::submitButton('保存', [ 'style' => 'width:50px']) ?>
        <?= Html::resetButton('取消', [ 'style' => 'width:50px']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="module_content" id = 'tab-5' style="display: none;">
        <div class="blank"></div>
        <?php
        $dataProvider = $order->shopOrderLogSearch;
        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['label'=>'时间', 'value'=>function($model){
                    return $model->addtime;
                }],
                ['label'=>'操作人', 'value'=>function($model){
                    return $model->user;
                }],
                'action',
                ['label'=>'结果', 'value'=>function($model){
                    return $model->result;
                }],
                'note',
            ],
        ]); ?>
    </div>
    <div class="module_content" id = 'tab-6' style="display: none;">
        <div class="blank"></div>
        <label>订单附言</label>
        <div class="box"><?= $order->postscript ?></div>
    </div>
</div>
<script>
    function select_tab(curr_tab)
    {
        $("div.module_content").hide();
        $("#tab-"+curr_tab).show();
        //$("ul[name=menu1] > li").removeClass('active');
        //$('#li_'+curr_tab).addClass('active');
    }
    //修改订单价格
    function updateDiscount()
    {
        var order_id = <?=$order->id;?>;
        var discount = $('input[name="discount"]').val();
        $.getJSON("/index.php?r=shop-seller/orderdiscount",{'id':order_id,'discount':discount},function(json)
        {
            if(json.result == true)
            {
                $('#orderAmount').text("￥" + json.orderAmount);
                $('#orderAmount').addClass("red");
                return;
            }
        });
    }
</script>

