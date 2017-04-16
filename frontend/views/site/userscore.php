<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
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
    <div class="info_bar"><b>个人积分</b></div>
    <div class="blank"></div>
    <div class="curscore">您的当前积分：<span style="color: red"><?= $userscore->score?></span>分</div>
    <div class="scoredetail">
        <strong class="scoreintro" >积分明细查询</strong>
        <?php $form = ActiveForm::begin([
            'id' => 'userdetail-form',
            'options' => ['class'=>'form-signin'],
            'fieldConfig' => [
                'template' => "<div style=\"float:left; width:70px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>",
            ],
        ]); ?>
        <?= $form->field($userscore, 'duration')->dropDownList(
            ['1'=>'近三个月之内积分记录','2'=>'3个月之外积分记录']
        )->label('查询时间:', ['style'=>'padding-top:5px']) ?>
        <div class="scorebtn"><?= Html::submitButton('查询', [ 'style' => 'width:50px']) ?></div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="gridview">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'datetime',
                'value',
                'intro',
            ],
        ]); ?>
    </div>
    <div class="scoreex"><strong >积分兑换</strong></div>
    <div class="scorehint">
        <p><strong>提示：</strong></p>
        <p class="indent">1、您兑换的代金券为电子券，根据代金券的不同，会具有不同的有效期</p>
        <p class="indent">2、电子代金券仅限本ID使用，不能折算为现金、也不能再次兑换为积分</p>
    </div>
</div>

