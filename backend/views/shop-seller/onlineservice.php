<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>在线客服设置</b></div>
    <div class="blank"></div>

    <?php if(isset($info) && $info != '') {?>
    <div style="height:60px;color:red;" id="info"> <?= Html::encode($info)?> </div>
    <?php }?>
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::button('添加', ['onclick'=>'addSpec()', 'class'=>'btn-primary']); ?>
    <table id="serviceTable">
    <tr>
        <th style="width: 150px;">客服名称</th>
        <th style="width: 150px;">QQ号码</th>
        <th style="width: 150px;">操作</th>
    </tr>
    <?php foreach($onlineService as $key => $value) { ?>
        <tr>
            <td><input name="name[]" type="text" style="width: 120px;" value="<?=$value['name']?>"></td>
            <td><input name="qq[]"type="text" style="width: 120px;" value="<?=$value['qq']?>"></td>
            <td><a href="#" onclick="$(this).parent().parent().remove();delSpec('<?=$value['id']?>')">&nbsp;&nbsp;删除</a></td>
        </tr>
    <?php } ?>
    </table>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px;', 'class'=>'btn-primary'])?>
    <?php ActiveForm::end(); ?>
</div>

<script>
    function addSpec()
    {
        var str = '';
        str += '<tr>'
            + '<td>' + '<input name="name[]" type="text" style="width: 120px;">' + '</td>'
            + '<td>' + '<input name="qq[]" type="text" style="width: 120px;">' + '</td>'
            + '<td>' + '<a href="#" onclick="$(this).parent().parent().remove();">&nbsp;&nbsp;删除</a>' + '</td>'
            + '</tr>';
        $("#serviceTable").append(str);
    }

    function delSpec(id)
    {
        $.get("<?=Url::to(['shop-seller/delonlineservice'])?>" + "?id=" + id, function (data) {
            if('OK' == data){
                 $("#info").text('删除成功');
            }
        });
    }
</script>

