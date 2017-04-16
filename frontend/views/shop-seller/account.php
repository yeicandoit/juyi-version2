<?php
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use dosamigos\datepicker\DatePicker;
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
    <div class="info_bar">
        <b>销售统计</b>
    </div>
    <div class="blank"></div>
    <div>
        <?= Html::beginForm() ?>
        <table><tr>
            <td>
                <label>开始日期：</label>
            </td>
            <td>
                <?= DatePicker::widget([
                    'name' => 'startDate',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
            </td>
            <td>
                <label>&nbsp;&nbsp;结束日期：</label>
            </td>
            <td>
                <?= DatePicker::widget([
                    'name' => 'endDate',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
            </td>
            <td>
                &nbsp;&nbsp;<?= Html::submitButton("销售统计")?>
            </td>
        </tr></table>
        <?=Html::endForm()?>
    </div>
    <div id="myChart" style="width:100%;min-height:320px;" onclick="test()">
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => '销售统计'],
                'xAxis' => [
                    'title' => ['text' => '时间'],
                    'categories' => array_keys($countData)
                ],
                'yAxis' => [
                    'title' => ['text' => '销售额(元)']
                ],
                'series' => [
                    ['name' => '销售额', 'data' => array_values($countData)],
                ],
                'tooltip' => [
                    'valueSuffix' => '元',
                ],
            ]
        ]);
        ?>
    </div>
</div>


