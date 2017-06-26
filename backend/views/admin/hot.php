<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\admin\CommendGoods;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
    <div class="info_bar">
        <?php
        $hotdev = $type == CommendGoods::HotDevice ? '<b>热门仪器</b>' : '热门仪器';
        $hotorg = $type == CommendGoods::HotOrganization ? '<b>热门机构</b>' : '热门机构';
        $hotexp = $type == CommendGoods::HotExpert ? '<b>聚仪专家</b>' : '聚仪专家';
        $hothel = $type == CommendGoods::HotHelp ? '<b>热门辅助</b>' : '热门辅助';
        $hotsim = $type == CommendGoods::HotSimulate ? '<b>热门模拟</b>' : '热门模拟';

        $hotdevUrl = $type == CommendGoods::HotDevice ? '#' : Url::to(['admin/hot', 'type'=>CommendGoods::HotDevice]);
        $hotorgUrl = $type == CommendGoods::HotOrganization ? '#' : Url::to(['admin/hot', 'type'=>CommendGoods::HotOrganization]);
        $hotexpUrl = $type == CommendGoods::HotExpert ? '#' : Url::to(['admin/hot', 'type'=>CommendGoods::HotExpert]);
        $hothelUrl = $type == CommendGoods::HotHelp ? '#' : Url::to(['admin/hot', 'type'=>CommendGoods::HotHelp]);
        $hotsimUrl = $type == CommendGoods::HotSimulate ? '#' : Url::to(['admin/hot', 'type'=>CommendGoods::HotSimulate]);
        ?>
        <?=Html::a($hotdev, $hotdevUrl)?>
        <?=Html::a($hotorg, $hotorgUrl)?>
        <?=Html::a($hotexp, $hotexpUrl)?>
        <?=Html::a($hothel, $hothelUrl)?>
        <?=Html::a($hotsim, $hotsimUrl)?>
    </div>
    <div class="blank"></div>
    <?php
        if($type == CommendGoods::HotDevice){
            $name = '仪器编号';
        } else if($type == CommendGoods::HotOrganization) {
            $name = '机构账号';
        } else if($type == CommendGoods::HotExpert) {
            $name = '专家账号';
        } else if($type == CommendGoods::HotHelp){
            $name = '辅助编号';
        } else if($type == CommendGoods::HotSimulate) {
            $name = '模拟编号';
        }
    ?>
    <b><?=$name?></b>&nbsp;&nbsp;<input id="hot" type="text" />&nbsp;&nbsp;<button onclick='addHot($("#hot").val(), <?=$type?>)'>添加</button>
    &nbsp;&nbsp;<label style="color:cadetblue"><?=$info?></label>
    <div class="blank"></div>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $hot,
        'columns' => [
            [
                'label'=>'编号/账号',
                'format'=>'raw',
                'value'=>function($model){
                    $commend = $model->commend;
                    if(null != $commend){
                        if($model->type == CommendGoods::HotDevice ||
                            $model->type == CommendGoods::HotHelp ||
                            $model->type == CommendGoods::HotSimulate){
                            return $commend->goods_no;
                        } else if($model->type == CommendGoods::HotOrganization){
                            return $commend->seller_name;
                        } else if ($model->type == CommendGoods::HotExpert){
                            return $commend->name;
                        }
                        return "";
                    } else {
                        return "";
                    }
                }
            ],
            [
                'label'=>'名称',
                'format'=>'raw',
                'value'=>function($model){
                    $commend = $model->commend;
                    if(null != $commend){
                        if($model->type == CommendGoods::HotDevice ||
                            $model->type == CommendGoods::HotHelp ||
                            $model->type == CommendGoods::HotSimulate){
                            return $commend->name;
                        } else if($model->type == CommendGoods::HotOrganization ||
                            $model->type == CommendGoods::HotExpert){
                            return $commend->true_name;
                        }
                        return "";
                    } else {
                        return "";
                    }
                }
            ],
            [
                'label'=>'操作',
                'format' => 'raw',
                'value' => function($model) {
                    $delete = Html::a('删除', Url::to(['admin/delhot', 'id'=>$model->id, 'type'=>$model->type]));
                    return "$delete";
                }
            ],
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function addHot(val, type)
    {
        if('' == val) {
            alert('编号/账号不能为空');
        } else {
            location.href= "<?= Url::to(['admin/addhot'])?>&type=" + type + "&hot=" + val;
        }
    }
</script>