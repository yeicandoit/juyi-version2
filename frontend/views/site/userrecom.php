<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use dosamigos\datepicker\DatePicker;
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
    <div class="info_bar"><b>我的建议</b></div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([
        'id' => 'userrecom',
    ]); ?>
    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'consignee',
        'template' => '{addon}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'language'=>'zh', //
            'todayHighlight' => true,
        ]
    ]);?>
    <?php ActiveForm::end(); ?>
</div>

