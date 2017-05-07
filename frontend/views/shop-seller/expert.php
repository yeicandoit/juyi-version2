<?php
use yii\helpers\Html;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<?=Html::jsFile('@web/js/scrollfix.js')?>

<table>
    <tr>
    <td valign="top">
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

    <td style="padding-left: 20px;" valign="top">
        <div>
            <table style="max-width: 465px">
                <tr>
                    <td valign="top"><?= Html::img('/images/expert.png',['style'=>'width:192px;height:230px'])?></td>
                    <td style="padding-left: 20px; valign="top"">
                        <div style="border-bottom:1px inset;">
                            <p><strong style="font-size: large">解码专家:<?=$expert->true_name?></strong>&nbsp;<span><?=$expert->title?></span></p>
                        </div>
                        <div style="padding-top: 5px">
                            <?=Html::label('学历:')?><?=$expert->degree?>
                        </div>
                        <div style="padding-top: 5px">
                            <?=Html::img('@web/images/map.png', ['style'=>'width:12px;height:18px'])?>
                            <?php
                                $location = $expert->getLocation("/");
                            ?>
                            <span><?=$location?></span>
                        </div>
                        <div style="padding-top: 5px"><?=Html::label('邮箱:')?><?=$expert->email?></div>
                        <div style="padding-top: 5px"><?=Html::label('个人主页:')?><?=$expert->home_url?></div>
                        <!--<button class="expert-concern">关注此专家</button>  The button image is too big to be in!!-->
                        <button style="background-color: #116fb5;color: #fdfdfd;border-radius:5px 5px 5px 5px">关注此专家</button>
                    </td>
                </tr>
            </table>
        </div>
        <div id="service" style="padding-top: 20px;max-width: 465px">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;技术服务</div>
            <?php
                foreach($expert->goods as $k=>$g){
                    echo Html::a($g->name, '#', ['style'=>'width:115px; btn btn-primary;padding-top:20px; padding-left:25px;padding-right:25px;']);
                }
            ?>
        </div>
        <div id="description" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;专家介绍</div>
            <div>
                <?=$expertInfo->description?>
            </div>
        </div>
        <div id="direction" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;研究方向</div>
            <div>
                <?=$expertInfo->direction?>
            </div>
        </div>
        <div id="education" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;教育背景</div>
            <div>
                <?=$expertInfo->education?>
            </div>
        </div>
        <div id="work" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;工作经历</div>
            <div>
                <?=$expertInfo->work?>
            </div>
        </div>
        <div id="research" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;科研成果</div>
            <div>
                <?=$expertInfo->research?>
            </div>
        </div>
        <div id="project" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;科研项目</div>
            <div>
                <?=$expertInfo->project?>
            </div>
        </div>
        <div id="award" style="padding-top: 20px;max-width: 465px;word-wrap:break-word;word-break:break-all;">
            <div style="background-color:#0e5e98;color: #fdfdfd">&nbsp;&nbsp;&nbsp;荣誉奖励</div>
            <div>
                <?=$expertInfo->award?>
            </div>
        </div>
    </td>
    <td style="padding-left: 20px;padding-top: 10px" valign="top">
        <div style="background-color: #116fb5;border-radius:0 0 0 15px;min-width: 70px;color: #fdfdfd;font-size: 15px">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相关专家
        </div>
        <table style="min-width: 120px;">
            <tr>
                <td><?= Html::img('/images/expert.png',['style'=>'width:40px;height:40px', 'class'=>'img-circle'])?></td>
                <td style="padding-left: 3px">
                    <span style="font-size: 13px">肖学良</span><br>
                    <span style="font-size: 10px">博士,副教授</span>
                </td>
                <td style="padding-left: 3px">
                    &nbsp;
                    <button style="font-size: 10px;background-color: #116fb5;color: #fdfdfd;border-radius:5px 5px 5px 5px">
                        关注<br>专家
                    </button>
                </td>
            </tr>
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
</script>


