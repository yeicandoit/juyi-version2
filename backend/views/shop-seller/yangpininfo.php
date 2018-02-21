<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>样品信息</b></div>
    <div class="blank"></div>
    <?= DetailView::widget([
        'model' => $yangpininfo,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'样品名称', 'value'=>$yangpininfo->name],
            ['label'=>'样品数量', 'value'=>$yangpininfo->num],
            ['label'=>'样品成分', 'value'=>$yangpininfo->component],
            ['label'=>'样品形态', 'value'=>$yangpininfo->getShape()],
            ['label'=>'样品性质', 'value'=>$yangpininfo->getProperty()],
            ['label'=>'保存条件', 'value'=>$yangpininfo->getSaveCondition()],
            ['label'=>'样品处理', 'value'=>$yangpininfo->getProcess()],
            ['label'=>'测试项目', 'value'=>$yangpininfo->testname],
            ['label'=>'测试目的要求', 'value'=>$yangpininfo->testaim],
            ['label'=>'检测依据', 'value'=>$yangpininfo->getTestbase()],
            ['label'=>'期望的测试周期', 'value'=>$yangpininfo->getTesttime()],
            ['label'=>'测试详细要求以及过程', 'value'=>$yangpininfo->testdetail],
            ['label'=>'特别注意之处', 'value'=>$yangpininfo->special],
        ],
    ]) ?>
</div>

