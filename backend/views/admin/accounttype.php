<?php
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;
use backend\models\seller\ShopMember;

$this->registerJsFile('@web/assets/new/_systemjs/highcharts/highcharts.js', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <?php
            $pre = '';
            if(ShopMember::TYPE_TEST == $shopType) {
                $pre = '检测中心';
            } else if(ShopMember::TYPE_RESEARCH == $shopType) {
                $pre = '科研辅助';
            } else if(ShopMember::TYPE_SIMULATE == $shopType) {
                $pre = '数值模拟';
            } else if(ShopMember::TYPE_EXPERT == $shopType) {
                $pre = '专家';
            }
        ?>
        <b><?=$pre?>销售统计</b>
    </div>
    <div class="blank"></div>
    <div>
        <?= Html::beginForm() ?>
        <table>
            <tr>
                <td>
                    <label>开始日期：</label>
                </td>
                <td>
                    <?= DatePicker::widget([
                        'name' => 'startDate',
                        'value' => $startDate,
                        'language' => 'zh-CN',
                        'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight'=>true,
                            'pickButtonIcon' => 'glyphicon glyphicon-time'
                        ]
                    ]);?>
                </td>
                <td>
                    <label>&nbsp;&nbsp;结束日期：</label>
                </td>
                <td>
                    <?= DatePicker::widget([
                        'name' => 'endDate',
                        'value' => $endDate,
                        'language' => 'zh-CN',
                        'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight'=>true,
                            'pickButtonIcon' => 'glyphicon glyphicon-time'
                        ]
                    ]);?>
                </td>
                <td>
                    &nbsp;&nbsp;<?= Html::submitButton("销售统计")?>
                </td>
            </tr>
        </table>
        <?=Html::endForm()?>
    </div>
    <div id="myChart" style="width:100%;min-height:320px;">
    </div>
</div>
<script type='text/javascript'>
    //图表生成
    $(function()
    {
        //图标模板
        userHighChart = $('#myChart').highcharts(
            {
                title:
                {
                    text:'销售统计'
                },
                xAxis:
                {
                    title:
                    {
                        text:'时间'
                    },
                    categories:<?php echo json_encode(array_keys($countData));?>,
                },
                yAxis:
                {
                    title:
                    {
                        text:'销售额(元)'
                    },
                },
                series:
                    [
                        {
                            name:'销售额',
                            data:<?php echo json_encode(array_values($countData));?>
                        }
                    ],
                tooltip:
                {
                    valueSuffix:'元'
                }
            });
    })
</script>


