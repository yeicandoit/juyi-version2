<?php
use yii\helpers\Html;
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
    <div class="info_bar">
        <b>规格设置</b>
    </div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([
        'id' => 'adrdetail-form',
        'options' => ['class'=>'form-horizontal form-adrdetail'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>

    <?= $form->field($spec, 'name', [])->textInput([])->hint('* 规格名称（必填）', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($spec, 'note', [])->textInput([]) ?>
    <?= $form->field($spec, 'value', ['options'=>['style'=>'display:none']])->textInput() ?>
    <?php
        $specValues = json_decode($spec->value);
        $up = Html::a('向上', '#');
        $down = Html::a('向下', '#');
        $del = Html::a('删除', '#');
    ?>
    <table width="100%" cellpadding="0" cellspacing="0" align="center" style="border:10px; solid #123456;">
        <tr>
            <th>规格值</th>
            <th>操作</th>
        </tr>
        <tr id="spec-td">
            <td>Hello world!!!</td>
            <td><?="$up|$down|$del"?></td>
        </tr>
    </table>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px']) ?>
    <?php ActiveForm::end(); ?>
</div>
