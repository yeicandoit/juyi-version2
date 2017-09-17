<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use backend\models\seller\Member;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<!--Show user info-->
<div class="userinfo">
    <div class="info_bar"><b>个人资料</b> </div>
    <div class="borderbottom"><strong >会员信息</strong></div>
    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-horizontal form-userinfo'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left; width: auto;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($memberinfo, 'true_name', [])->textInput()->label('姓名:') ?>

    <div class="form-group">
        <div style="float: left;width:100px;"><label><strong>出生日期:</strong></label></div>
        <div style="width: 280px;">
        <?= DatePicker::widget([
            'model' => $memberinfo,
            'attribute' => 'birthday',
            'template' => '{addon}{input}',
            'language'=>'zh-CN', //
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'pickButtonIcon' => 'glyphicon glyphicon-time'
            ]
        ]);?>
        </div>
    </div>

    <?= $form->field($memberinfo, 'sex')->textInput()->
    radioList( ['1'=>'男','2'=>'女'],['class'=>'label-group'])->label('性别：')?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($memberinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div><div style='float: left; padding-left: 10px;'>{error}</div>", ]
        )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'setCityOption()',
            ])->label('所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($memberinfo, 'city', [ 'template' => "{input}", ]
        )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$memberinfo->province])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'onchange'=>'setAreaOption()',
            ]); ?>
    </div>
    <?=$form->field($memberinfo, 'area', [ 'template' => "{input}", ]
    )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>$memberinfo->city])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:180px',
        ]); ?>
    <?= $form->field($memberinfo, 'contact_addr', [])->textInput([])->label('联系地址:') ?>
    <?= $form->field($memberinfo, 'mobile', [])->textInput([])->label('手机号码:') ?>
    <?= $form->field($memberinfo->user, 'email', [])->textInput([])->label('邮箱:') ?>
    <?= $form->field($memberinfo, 'zip', [])->textInput([])->label('邮编:') ?>
    <?= $form->field($memberinfo, 'qq', [])->textInput([])->label('QQ:') ?>

    <?= $form->field($memberinfo, 'type', [])->dropDownList(Member::getUserTypeArr())->label('用户类型:')?>
    <?= $form->field($memberinfo, 'cardid', [])->textInput()?>
    <?php if(Member::TYPE_STUDENT == $memberinfo->type) {?>
        <?= $form->field($memberinfo, 'studentid', [])->textInput()?>
        <?= $form->field($memberinfo, 'studenttype', [])->dropDownList(Member::getStudentTypeArr())->label('学生类型:')?>
        <div class="form-group">
            <div style="float: left;width:100px;"><label><strong>入学时间:</strong></label></div>
            <div style="width: 280px;">
                <?= DatePicker::widget([
                    'model' => $memberinfo,
                    'attribute' => 'intime',
                    'template' => '{addon}{input}',
                    'language'=>'zh-CN',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'pickButtonIcon' => 'glyphicon glyphicon-time'
                    ]
                ]);?>
            </div>
        </div>
        <div class="form-group">
            <div style="float: left;width:100px;"><label><strong>预计毕业时间:</strong></label></div>
            <div style="width: 280px;">
                <?= DatePicker::widget([
                    'model' => $memberinfo,
                    'attribute' => 'outtime',
                    'template' => '{addon}{input}',
                    'language'=>'zh-CN', //
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'pickButtonIcon' => 'glyphicon glyphicon-time'
                    ]
                ]);?>
            </div>
        </div>
        <?php if($doc) {?>
            <?= $form->field($doc, 'name', [])->textInput()?>
            <?= $form->field($doc, 'tel', [])->textInput()?>
            <?= $form->field($doc, 'email', [])->textInput()?>
            <?= $form->field($doc, 'title', [])->textInput()?>
            <?= $form->field($doc, 'job', [])->textInput()?>
        <?php }?>
        <div class="form-group">
            <div style="float: left;width:100px;"><label><strong>学生证:</strong></label></div>
            <div style="width: 280px;">
                <?php echo Html::img("@web/$memberinfo->photo3", ['class'=>'user_fav_img'])?>
            </div>
        </div>
    <?php } elseif(Member::TYPE_TEACHER == $memberinfo->type) {?>
        <?php
            //TODO title, job 怎么在jy_member中没有此字段，这是怎么回事？看苏的代码应该是有的啊
        ?>
    <?php } elseif(Member::TYPE_RESEARCHER == $memberinfo->type) {?>
    <?php } elseif(Member::TYPE_WORKER == $memberinfo->type) {?>
    <?php }?>
    <div class="form-group">
        <div style="float: left;width:100px;"><label><strong>身份证正面照:</strong></label></div>
        <div style="width: 280px;">
            <?php echo Html::img("@web/$memberinfo->cardphoto1", ['class'=>'user_fav_img'])?>
        </div>
    </div>
    <div class="form-group">
        <div style="float: left;width:100px;"><label><strong>身份证反面照:</strong></label></div>
        <div style="width: 280px;">
            <?php echo Html::img("@web/$memberinfo->cardphpto2", ['class'=>'user_fav_img'])?>
        </div>
    </div>
    <?= Html::submitButton('保存基本信息', [ 'style' => 'width:110px']) ?>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    function setDropDownList()
    {
        // If $memberinfo->province is null, 0 + $memberinfo->province will be 0,then it will be correct js code.
        if (0 == <?=0 + $memberinfo->province?>) {
            $("#member-province").append("<option value=0>请选择省</option>");
            $("#member-province").val(0);
        }
        if (0 == <?=0 + $memberinfo->city?>) {
            $("#member-city").append("<option value=0>请选择市</option>");
            $("#member-city").val(0);
        }
        if (0 == <?=0 + $memberinfo->area?>) {
            $("#member-area").append("<option value=0>请选择县</option>");
            $("#member-area").val(0);
        }
    }
    /*用window.onload调用myfun()*/
    window.onload=setDropDownList;

    <?php $url = Url::to(['shop-seller/areas']); ?>
    function setCityOption()
    {
        $.get("<?= $url?>?id="+$("#member-province").val(),function(data){
            $("#member-city").html("<option value=0>请选择市</option>");
            $("#member-area").html("<option value=0>请选择县</option>");
            $("#member-city").append(data);
        });
    }

    function setAreaOption()
    {
        $.get("<?= $url?>?id="+$("#member-city").val(),function(data){
            $("#member-area").html("<option value=0>请选择县</option>");
            $("#member-area").append(data);
        });
    }
</script>


