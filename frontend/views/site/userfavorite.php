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
    <div class="info_bar"><label id="manaddr" onclick="showManaddr()" style="color: #0000aa"><b>收藏夹</b></label></div>
    <div style="padding-top: 20px;">
        <?= GridView::widget([
            //'id' => 'adrdetail-grid',
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label'=>'商品名称',
                    'format'=>'raw',
                    'value'=>function($model) {
                        $name = $model->shopGoods->name;
                        $stoNum = $model->shopGoods->store_nums;
                        $smyId = "summary_" . $model->id;
                        $addSmyId = "summary_add_" . $model->id;
                        $postSmyId = "summary_post_" . $model->id;
                        $inputSmyId = "summary_input_" . $model->id;
                        $smyId = "summary_" . $model->id;
                        $summary = "<tr style='height: 20px; display: none' id='$smyId'><td></td></tr>";
                        if("" != $model->summary) {
                            $summary = "<tr style='height: 20px' id='$smyId'><td>$model->summary</td></tr>";
                        }
                        return "<dl>
                            <dt><a href=''><img class='user_fav_img' src='/images/user_ico.gif'/></a></dt>
                            <dd style='padding-left: 10px'>
                                <table>
                                    <tr style='height: 20px;'><td><a href=''>$name</a></td></tr>
                                    <tr style='height: 20px;'><td>库存：$stoNum</td></tr>
                                    $summary
                                    <tr style='height: 20px;' id='$addSmyId'><td><a href='javascript:void(0)'
                                     onclick='showPostSmy(\"$model->id\")'>+添加备注</a></td></tr>
                                    <tr style='height: 20px; display: none;' id='$postSmyId'><td>
                                    备注:
                                    <input id='$inputSmyId' type='text'>
                                    <input class='sbtn' value='提交' onclick='postSmy(\"$model->id\")' type='button'>
                                    <input value='取消' type='button' onclick='showAddSmy(\"$model->id\")'>
                                    </td></tr>
                                </table>
                            </dd>
                        </dl>";
                    }
                ],
                'time',
                ['label'=>'价格', 'value'=> function($model){
                    return $model->shopGoods->sell_price;
                }],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{userfvbuy}{userfvdel}',
                    'buttons' => [
                        'userfvbuy' => function ($url, $model, $key) {
                            $options = [
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon">购买|</span>', '', $options);
                        },
                        'userfvdel' => function ($url) {
                            $options = [
                                'data-confirm' => Yii::t('yii', '你确定删除此收藏?'),
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon">删除</span>', $url, $options);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>

<script language="javascript">
    function showPostSmy(id)
    {
        //alert(addsmy);
        var addsmy = "#" + "summary_add_" + id;
        var postsmy = "#" + "summary_post_" + id;
        $(addsmy).hide();
        $(postsmy).show();
    }

    function showAddSmy(id)
    {
        var addsmy = "#" + "summary_add_" + id;
        var postsmy = "#" + "summary_post_" + id;
        $(addsmy).show();
        $(postsmy).hide();
    }

    function postSmy(id)
    {
        var smy = $("#" + "summary_input_" + id).val();
        $.get("/index.php?r=site/useraddsmy&id=" + id + "&summary=" + smy,function(data){
            if (data == "OK") {
                var addsmy = "#" + "summary_add_" + id;
                var postsmy = "#" + "summary_post_" + id;
                var trsmy = "#" + "summary_" + id;
                $(addsmy).show();
                $(postsmy).hide();
                if("" == smy){
                    $(trsmy).hide();
                } else {
                    var content = "<td>" + smy + "</td>";
                    $(trsmy).html(content);
                    $(trsmy).show();
                }
            }
        });
        $("#" + "summary_input_" + id).val('');
    }
</script>


