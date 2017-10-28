<?php
use yii\helpers\Html;
?>
<?=Html::jsFile("http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js")?>
<?=Html::jsFile("http://static.runoob.com/assets/qrcode/qrcode.min.js")?>
<div class="sellerinfo">
    <div class="info_bar">
        <b>
            <?=Html::a('专家页面二维码', '#')?>
        </b>
    </div>
    <div class="blank"></div>
    <?=Html::label('我的专家页面url:')?>
    <?=Html::a($url, $url)?>
    <input id="text" type="hidden" value=<?=$url?> style="width:80%" /><br />
    <?=Html::label('我的专家页面二维码:')?><br>
    <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
</div>
<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 200,
        height : 200
    });

    function makeCode () {
        var elText = document.getElementById("text");

        if (!elText.value) {
            alert("Input a text");
            elText.focus();
            return;
        }

        qrcode.makeCode(elText.value);
    }

    makeCode();

    $("#text").
    on("blur", function () {
        makeCode();
    }).
    on("keydown", function (e) {
        if (e.keyCode == 13) {
            makeCode();
        }
    });
</script>
