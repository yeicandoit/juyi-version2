<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
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
    <div class="info_bar"><a href="javascript:void(0)" id="manaddr" onclick="showOrderList()"><b>交易记录</b></a>
        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="addaddr" onclick="showWithDraw()"><b>提现申请</b></a></div>
    <div style="height: 10px;"></div>
    <div style="padding-left: 20px; height: 25px; background-color: #f7ecb5">账户金额：<?=$member->balance?></div>
    <div style="padding-top: 20px;">
        <?= GridView::widget([
            'id' => 'userAccount',
            'dataProvider' => $dataAccount,
            'columns' => [
                ['label'=>'事件', 'value'=>function($model){
                    return $model->note;
                }],
                ['label'=>'存入金额', 'value'=>function($model){
                    if($model->amount > 0){
                        return $model->amount;
                    } else {
                        return 0.0;
                    }
                }],
                ['label'=>'支出金额', 'value'=>function($model){
                    if($model->amount < 0){
                        return $model->amount;
                    } else {
                        return 0.0;
                    }
                }],
                ['label'=>'当前金额', 'value'=>function($model){
                    return $model->amount_log;
                }],
                ['label'=>'时间', 'value'=>function($model){
                    return $model->time;
                }],
            ],
        ]); ?>
    </div>

    <div style="padding-top: 20px; display: none" id="withdraw-grid">
        <?= GridView::widget([
            'dataProvider' => $dataWithdraw,
            'columns' => [
                [
                    'label'=>'会员备注',
                    'value'=>function($model){
                        return $model->note;
                    }
                ],
                [
                    'label'=>'管理员备注',
                    'value'=>function($model){
                        if(!isset($model->re_note)) {
                            return '';
                        } else {
                            return $model->re_note;
                        }
                    }
                ],
                'amount',
                'is_del',
                'time',
                [
                    'label'=>'状态',
                    'value'=>function($model){
                        if(0 == $model->status)
                        {
                            return '未处理';
                        } else if(1 == $model->status){
                            return '处理中';
                        } else if(2 == $model->status) {
                            return '成功';
                        } else {
                            return '失败';
                        }
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'withdraw-form',
        'options' => ['class'=>'form-horizontal form-common', 'style' => 'display: none'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($withdraw, 'name', []
    )->textInput([])->label('收款人姓名：')->hint('<span style="color: red">*</span>请填写真实的收款人姓名', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($withdraw, 'amount', []
    )->textInput()->label('提现金额：')->hint('<span style="color: red">*</span>填写提现金额', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($withdraw, 'note', [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style='float: left'>{input}</div>
           <div style='padding-left: 380px;'>{hint}</div><div>{error}</div>",
        ])->textarea(['rows'=>3, 'style'=>'width:280px'])->label('备注:')
        ->hint('<span style="color: red">*</span>填写必要的提现信息，如开户银行，帐号等', ['style'=>'padding-left:30px',]) ?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script language="javascript">
    function showOrderList()
    {
        $("#userAccount").show();
        $("#withdraw-grid").hide();
        $("#withdraw-form").hide();
    }

    function showWithDraw()
    {
        $("#userAccount").hide();
        $("#withdraw-grid").show();
        $("#withdraw-form").show();
    }
</script>

