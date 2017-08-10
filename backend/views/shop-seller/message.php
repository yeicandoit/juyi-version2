<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
    <div class="info_bar">
        <b>
            <?=Html::a('消息', '#')?>
        </b>
    </div>
    <div class="blank"></div>
    <div style="margin:0 auto;font-size: 25px; color: blue; max-width: 800px"><?=Html::label($message->title, null)?></div>
    <div style="max-width: 800px"><?=$message->content?></div>
</div>
