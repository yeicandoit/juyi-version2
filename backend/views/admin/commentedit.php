<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<style type="text/css">
    .form .radio{
        width:30px;
        float:left;
    }
    .form .radio label{
        display:inline;
    }
</style>
<div class="sellerinfo">
    <div class="info_bar"><b>商品评价回复</b></div>
    <div class="blank"></div>
    <?php
        $user = $comment->user;
        $goods = $comment->goods;
        $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=" . $goods->id;
        $cgood = Html::a($goods->name, $href);
    ?>
    <?= DetailView::widget([
        'model' => $comment,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'评论人', 'value'=>$user? $user->username : ''],
            ['label'=>'评价时间', 'value'=>$comment->time],
            ['label'=>'评价商品', 'format'=>'raw', 'value'=>$cgood],
            ['label'=>'评价内容', 'value'=>isset($comment->contents)?$comment->contents:''],
            ['label'=>'评价分数', 'value'=>$comment->point],
        ],
    ]) ?>
    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->field($comment, 'id', ['options'=>['style'=>'display:none']]);?>
    <?php
        if(isset($comment->user_grade)) {
            $gradeArr = array(0=>'差评', 1=>'中评', 2=>'好评');
            $grade = $gradeArr[$comment->user_grade];
            echo Html::label("对用户评价：$grade");
        } else {
            echo $form->field($comment, 'user_grade')->radioList([2 => '好评', 1 => '中评', 0 => '差评'])->label('对用户评价(不能重复评价)');
        }
    ?>
    <?= $form->field($comment, 'recontents')->textarea(['style'=>'width:300px']);?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

