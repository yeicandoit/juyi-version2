<?php
use yii\helpers\Html;
use yii\grid\GridView;
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
    <div class="info_bar"><label id="manaddr" onclick="showManaddr()" style="color: #0000aa"><b>我的订单</b></label></div>
    <div style="padding-top: 20px;">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label'=>'订单详情',
                    'format'=>'raw',
                    'value'=> function($model){
                        $goodsName = $model->shopOrderGoods->goods->name;
                        return "<table>
                                   <tr>
                                   <td>$model->create_time</td>
                                   <td style='padding-left: 10px'>订单号:<a href='/index.php?r=site/userorderinfo&id=$model->id'>$model->order_no</a></td>
                                   </tr>
                                   <tr>
                                   <td><a href=''><img class='user_fav_img' src='/images/user_ico.gif'/></a></td>
                                   <td>$goodsName</td>
                                   </tr>
                                </table>";
                    }
                ],
                ['label'=>'收货人', 'value'=>function($model){
                    return $model->accept_name;
                }],
                ['label'=>'支付方式', 'value'=>function($model){
                    return $model->shopPayment->name;
                }],
                ['label'=>'总金额', 'value'=>function($model){
                    return $model->order_amount;
                }],
                ['label'=>'订单状态', 'value'=>function($model){
                    return $model->orderStatusText($model->orderStatus);
                }]

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

<script language="javascript">

</script>


