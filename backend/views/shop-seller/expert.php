<?php
use yii\helpers\Html;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<?=Html::jsFile('@web/js/scrollfix.js')?>

<table>
    <tr>
    <td valign="top" style="width: 15%">
        <div class="fix">
            <div id="sroll_1" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('技术服务','#',['onclick'=>'mScroll("service", "sroll_1")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_2" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('专家介绍','#',['onclick'=>'mScroll("description", "sroll_2")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_3" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('研究方向','#',['onclick'=>'mScroll("direction", "sroll_3")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_4" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('教育背景','#',['onclick'=>'mScroll("education", "sroll_4")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_5" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('工作经历','#',['onclick'=>'mScroll("work", "sroll_5")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_6" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('科研成果','#',['onclick'=>'mScroll("research", "sroll_6")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_7" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('科研项目','#',['onclick'=>'mScroll("project", "sroll_7")', 'style'=>'color:black'])?>&nbsp;
            </div>
            <div id="sroll_8" style="height: 30px;min-width: 65px;text-align:center;border-right:1px inset;">
                <?=Html::a('荣誉奖励','#',['onclick'=>'mScroll("award", "sroll_8")', 'style'=>'color:black'])?>&nbsp;
            </div>
        </div>
    </td>

    <td style="padding-left: 30px; width:70%" valign="top" >
        <div>
            <table>
                <tr>
                    <td valign="top"><?= Html::img($expert->img)?></td>
                    <td style="padding-left: 20px; valign="top"">
                        <div style="border-bottom:1px inset;">
                            <strong style="font-size: large">解码专家:&nbsp;&nbsp;<?=$expert->true_name?></strong>&nbsp;<span><?=$expert->title?></span>
                        </div>
                        <div style="padding-top: 3px">
                            <?=Html::label('学历:')?>&nbsp;&nbsp;<?=$expert->degree?>
                        </div>
                        <div style="padding-top: 3px">
                            <?=Html::label('专业:')?>&nbsp;&nbsp;<?=isset($expert->major) ? $expert->major : ''?>
                        </div>
                        <div style="padding-top: 3px">
                            <?=Html::img('@web/images/map.png', ['style'=>'width:12px;height:18px'])?>
                            <?php
                                $location = $expert->getLocation("/");
                            ?>
                            <span><?=$location?></span>
                        </div>
                        <div style="padding-top: 5px"><?=Html::label('单位:')?>&nbsp;&nbsp;<?=$expert->affliation?></div>
                        <div style="padding-top: 3px"><?=Html::label('邮箱:')?>&nbsp;&nbsp;<?=$expert->email?></div>
                        <div style="padding-top: 3px"><?=Html::label('个人主页:')?>&nbsp;&nbsp;<?=$expert->home_url?></div>
                        <?php
                            if($expert->hasConcened()){
                                $type = 0;
                                $text = "取消关注";
                            } else {
                                $type = 1;
                                $text = "关注此专家";
                            }
                            $concern_id = "concern".$expert->id;
                        ?>
                        <button style="background-color: #116fb5;color: #fdfdfd;border-radius:5px 5px 5px 5px"
                                onclick='concern("<?=$concern_id?>", <?=$expert->id?>, <?=$type?>, 1)' id="<?=$concern_id?>"><?=$text?></button>
                    </td>
                </tr>
            </table>
        </div>
        <div id="service" style="padding-top: 20px;">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;技术服务</div>
            <?php
                foreach($expert->goods as $k=>$g){
                    echo Html::a($g->name, ['site/goodinfoexpert', 'id'=>$g->id], ['style'=>'width:115px; btn btn-primary;padding-top:20px; padding-left:25px;padding-right:25px;']);
                }
            ?>
        </div>
        <div id="description" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;专家介绍</div>
            <div>
                <?=$expertInfo->description?>
            </div>
        </div>
        <div id="direction" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;研究方向</div>
            <div>
                <?=$expertInfo->direction?>
            </div>
        </div>
        <div id="education" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;教育背景</div>
            <div>
                <?=$expertInfo->education?>
            </div>
        </div>
        <div id="work" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;工作经历</div>
            <div>
                <?=$expertInfo->work?>
            </div>
        </div>
        <div id="research" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;科研成果</div>
            <div>
                <?=$expertInfo->research?>
            </div>
        </div>
        <div id="project" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;科研项目</div>
            <div>
                <?=$expertInfo->project?>
            </div>
        </div>
        <div id="award" style="padding-top: 20px;word-wrap:break-word;word-break:break-all">
            <div style="background-color:#0e5e98;color: #fdfdfd;border-radius:0 15px 0 0;height:23px;width:100px">&nbsp;&nbsp;&nbsp;荣誉奖励</div>
            <div>
                <?=$expertInfo->award?>
            </div>
        </div>
    </td>
    <td style="padding-left: 20px;padding-top: 10px; width:15%" valign="top">
        <div style="background-color: #116fb5;border-radius:0 0 0 15px;min-width: 70px;color: #fdfdfd;font-size: 15px">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相关专家
        </div>
        <table style="border-collapse:separate; border-spacing:3px;">
            <?php
            if(null != $relatedExperts) {
                foreach($relatedExperts as $k=>$v) {
                    if($v->hasConcened()){
                        $type_ = 0;
                        $text_ = "取消<br>关注";
                    } else {
                        $type_ = 1;
                        $text_ = "关注<br>专家";
                    }
                    $concernId = "concern".$v->id;
                    ?>
                    <tr>
                        <td><a href=<?=\yii\helpers\Url::to(['shop-seller/expert', 'id'=>$v->id])?>>
                                <?= Html::img($v->img, ['style' => 'width:40px;height:40px', 'class' => 'img-circle']) ?></a></td>
                        <td style="padding-left: 3px">
                            <span style="font-size: 11px"><?=$v->true_name?></span><br>
                            <span style="font-size: 10px"><?=$v->degree?></span>
                        </td>
                        <td style="padding-left: 3px">
                            &nbsp;
                            <button id="<?=$concernId?>" onclick='concern("<?=$concernId?>", <?=$v->id?>, <?=$type_?>, 0)'
                                style="font-size: 10px;background-color: #116fb5;color: #fdfdfd;border-radius:5px 5px 5px 5px">
                                <?=$text_?>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </td>
    </tr>
</table>

<script type="text/javascript">
    var g_scrollid = null;
    $(function(){
        var fix = $(".fix");
        fix.scrollFix({distanceTop:50});
    });

    function mScroll(id, scrollid)
    {
        $("html,body").stop(true);$("html,body").animate({scrollTop: $("#"+id).offset().top - 30}, 1000);
        $("#"+scrollid).css({"height": "30px","min-width": "35px","text-align":"center","border-right":"2px solid", "border-right-color": "#0e5e98"});
        if(g_scrollid != null){
            $("#"+g_scrollid).css({"height": "30px","min-width": "35px","text-align":"center","border-right":"1px inset"});
        }
        g_scrollid = scrollid;
    }

    function concern(concernid, id, type, pos)
    {
        $.get("<?=\yii\helpers\Url::to(['shop-seller/favoriteexpert'])?>" + "&id=" + id + "&type=" + type, function (data) {
            if (data == "OK") {
                if(1 == type) {
                    var tNoConcern = pos == 1 ? '取消关注' : "取消<br>关注";
                    $("#" + concernid).html(tNoConcern);
                    $("#" + concernid).attr('onclick','concern('+ '\"' + concernid + '\"' + ',' + id + ', 0,' + pos + ')');
                } else {
                    var tConcern = pos == 1 ? '关注此专家' : "关注<br>专家";
                    $("#" + concernid).html(tConcern);
                    $("#" + concernid).attr('onclick','concern('+ '\"' + concernid + '\"' + ',' + id + ', 1,' + pos + ')');
                }
            } else {
                if(1 == type){
                    alert("添加关注失败");
                } else {
                    alert("取消关注失败");
                }
            }
        });
    }
</script>


