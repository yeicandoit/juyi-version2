<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    body {
        background-color: #f6f6f6;
    }

    ul li {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    #floor-0 {
        width: 1100px;
        height: 380px;
    }

    #classify {
        background-color: #0e5e98;
        width: 180px;
        text-align: center;
        height: 380px;
        color: #FFFFFF;
        float: left;
        z-index: 99;
        margin: 0px;
        padding: 0px;
    }

    #classifyname {
        width: 100%;
        text-align: center;
        font-size: 18px;
        color:;
        background-color: #0e5e98;
    }

    #menu {
        background-color: #116fb5;
        width: 180px;
        margin: 0px;
        padding: 0px;
        padding-top: 5px;
    }

    .menu1 {
        height: 26px;
        line-height: 26px;
        list-style: none;
        text-align: left;
        text-indent: 50px;
        padding-left: 0px;
        font-size: 14px;
        width: 180px;
        padding: 0px;
        margin: 0px;
    }

    .menu1 span {
        display: block;
        text-indent: 150px;
        margin-top: -26px;
    }

    .menu1 a {
        color: #fff;
        font-size: 12px;
    }

    .menu1detail {
        background-color: #116fb5;
        width: 150px;
        text-align: left;
        height: 215px;
        text-indent: 10px;
        position: relative;
        left: 180px;
        top: -50px;
        z-index: 5;
        margin-left: 0px;
        display: none;
    }

    .menu2detail {
        background-color: #116fb5;
        width: 150px;
        height: 200px;
        text-align: left;
        text-indent: 10px;
        position: relative;
        left: 180px;
        top: -190px;
        z-index: 5;
        margin-left: 0px;
        padding-top: 10px;
        display: none;
    }

    .menu1detail ul li {
        list-style: none;
    }

    .menu1detail li a {
        color: white;
    }

    .menu2detail li {
        list-style: none;
    }

    .menu2detail li a {
        color: white;
    }

    #pictrue {
        width: 700px;
        text-align: center;
        height: 360px;
        color: #0033FF;
        float: left;
        margin-left: 20px;
        margin-top: 20px;
        position: relative;
    }

    .carousel-indicators {
        height: 20px;
        position: absolute;
        top: 320px;
    }

    .left, .right {
        height: 360px;
    }

    #notice {
        background-color: #fff;
        width: 180px;
        height: 380px;
        float: right;
        color: #fff;
    }

    #welcome {
        display: block;
        height: 80px;
        width: 180px;
        padding: 5px;
    }

    #people {
        float: left;
        margin-top: 5px;
        width: 50px;
        height: 50px;
    }

    #login {
        float: left;
        width: 120px;
        height: 50x;
    }

    #login p {
        margin-top: 5px;
        color: #000;
        font-size: 13px;
        color: #474342;
    }

    #login span {
        padding: 10px;
    }

    #login a {
        text-decoration: none;
        color: #474342;
    }

    .notice_bg ul li {
        list-style: none;
        width: 130px;
        height: 30px;
        margin: 14px auto;
        margin-left: -22px;
    }

    .notice_bg img {
        height: 30px;
        width: 150px;
    }

    .notice_bg a {
        text-decoration: none;
    }

    #notice2 {
        width: 170px;
        height: 150px;
        overflow: hidden;
        text-align: center;
        margin: auto;
    }

    #noticetab li a {
        font-weight: bolder;
        font-size: 12px;
    }

    .tab-pane p {
        color: #868686;
        font-size: 12px;
    }

    #floor-1 {
        margin-top: 20px;
        width: 1100px;
        height: 400px;
    }

    #floor-1-1 {
        width: 1100px;
        height: 35px;
        line-height: 35px;
        margin: auto;
        font-size: 14px;
        background-color: #116fb5;
        text-align: center;
    }

    #floor1-Tab {
        width: 400px;
        margin: auto;
        height: 36px;
    }

    #floor1-Tab li {
        border-left: solid;
        border-right: solid;
        border-color: white;
        border: none;
        width: 120px;
        height: 35px;
        margin-right: 1px;
        background-image: url(upload/2017/choose0.png);
    }

    #floor1-Tab li a {
        height: 37px;
        width: 120px;
        color: white;
        font-weight: bolder;
        border: none;
        background-image: url(upload/2017/choose0.png);
    }

    #floor1-Tab li a:hover {
        background-image: url(upload/2017/choose2.png);
    }

    #floor1tabcontent {
        margin-top: 15px;
    }

    .polaroid {
        width: 250px;
        height: 270px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: left;
        float: left;
        margin: 10px;
        cursor: pointer;
        background-color: #f6f6f6;
        color: white;
    }

    .goodimg {
        height: 200px;
        width: 200px;
        margin: auto;
    }

    .goodprice {
        height: 25px;
        overflow: hidden;
        word-wrap: break-word;
        word-break: break-all;
    }

    div.goodintro {
        height: 50px;
        overflow: hidden;
        word-wrap: break-word;
        word-break: break-all;
    }

    div.goodappoint {
        height: 25px;
        overflow: hidden;
        word-wrap: break-word;
        word-break: break-all;
    }

    .polaroid2 {
        width: 23%;
        height: 270px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: left;
        float: left;
        margin: 5px;
        cursor: pointer;
        background-color: #f6f6f6;
        color: white;
    }

    #whole {
        width: 1100px;
        position: relative;
    }

    #left {
        width: 900px;
        float: left;
        border-right: solid;
        border-color: #f6f6f6;
    }

    #right {
        width: 190px;
        float: right;
        height: 800px;
        padding: 10px;
    }

    .Flist {
        position: absolute;
        top: -10px;
        left: -50px;
        width: 50px;
        height: 300px;
    }

    .Flist img {
        width: 35px;
        height: 40px;
        margin-bottom: 3px;
    }

    .F1 {
        width: 1100px;
        height: 40px;
        background-color: #f6f6f6;
        font-size: 20px;
        text-align: center;
        font-family: Microsoft YaHei;
    }

    #F1img {
        width: 40px;
        float: left;
    }

    #F1title {
        width: 800px;
        height: 40px;
        line-height: 40px;
        float: left;
    }

    .F1key {
        width: 1100px;
        font-size: 14px;
        text-align: center;
        font-family: Microsoft YaHei;
        height: 30px;
        background-color: #116fb5;
        margin: 0px;
    }

    .F1keycontent {
        width: 580px;
        height: 30px;
        margin-left: 180px;
    }

    .F1key ul {
        height: 28px;
    }

    .F1key li {
        height: 28px;
        list-style: none;
        width: 110px;
        float: left;
        color: white;
        text-align: enter;
        line-height: 28px;
        cursor: pointer;
        border-left: 1px solid white;
    }

    .F2 {
        width: 870px;
        height: 40px;
        background-color: #f6f6f6;
        font-size: 20px;
        text-align: center;
        font-family: Microsoft YaHei;
        margin-top: 200px;
    }

    #F2img {
        width: 40px;
        float: left;
    }

    #F2title {
        width: 800px;
        float: right;
        height: 40px;
    }

    .F2key {
        width: 900px;
        font-size: 14px;
        text-align: center;
        font-family: Microsoft YaHei;
        height: 30px;
        background-color: #116fb5;
        margin: 0px;
    }

    .F2keycontent {
        height: 30px;
        margin: 0 auto;
        text-align: center;
    }

    .F2key ul {
        height: 30px;
        margin-left: -30px;
    }

    .F2key li {
        height: 30px;
        line-height: 30px;
        list-style: none;
        width: 100px;
        float: left;
        color: white;
        cursor: pointer;
        border-left: 1px solid white;
    }

    .floor-2 {
        height: 400px;
    }

    #right img {
        width: 55px;
        height: 150px;
        margin-bottom: 20px;
        border: 1px solid #eeeef0;

    }

    #linkfriendly {
        width: 190px;
        height: 40px;
        line-height: 40px;
        position: relative;
    }

    #linkfriendly strong {
        position: absolute;
        left: 30px;
        font-size: 12px;
    }

    #linkfriendly img {
        width: 14px;
        height: 30px;
        position: absolute;
        top: 5px;
        left: 100px;
    }

    #linkfriendly span {
        position: absolute;
        left: 114px;
        font-size: 16px;
    }

    #linkfriendly a {
    }

    #rightfix {
        position: fixed;
        top: 0px;
        right: 0px;
        width: 50px;
    }

    #rightfix img {
        height: 40px;
        width: 30px;
        margin-left: 20px;
    }

    .fix-top {
        margin-top: 100px;
    }

    .fix-bottom {
        margin-top: 150px;
    }
</style>

<script type="text/javascript">


    var width = $(document).width();
    var height = $(document).height();


    $(function () {
        $(".F1key li:first").css("border-left", "none");
        $(".F2keycontent .active").css("border-left", "none");
        //分类框的颜色
        $(".menu1").hover(function () {
                $(this).css("background-color", "#0099CC");
                $(this).children("div").show();


            },
            function () {
                $(this).children("div").hide();
                $(this).css("background-color", "#116fb5");
            });


        $('#floor1-Tab li:first a').css("background-image", "url(upload/2017/choose.png");

        $('#floor1-Tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {


            var activeTab = $(e.target).css("background-image", "url(upload/2017/choose.png");
            var previousTab = $(e.relatedTarget).css("background-image", "url(upload/2017/choose0.png");


        });

        $('.F1key li:last').css("border-right", "solid");


        /*
         $("#menu li:first").hover(function(){
         $("#huagong").show();
         $(this).css("background-color","#0099CC");
         },
         function () {

         $("#huagong").hide();
         //$("#huagong").delay(600).hide(0);

         $(this).css("background-color","#116fb5");
         });

         */


        $("#rightfix").css("left", width - 50);
        $("#rightfix").css("height", height);


        $(window).resize(function () {

            var width1 = $(document).width();
            var height1 = $(document).height();

            $("#rightfix").css("left", width1 - 50);
            $("#rightfix").css("height", height1);
        });

        $(".fix-bottom").click(function () {
            window.scrollTo(0, 0);
        });
    });
</script>


<div id="floor-0">
    <div id="classify">
        <!-- 左边菜单栏开始 -->
        <div id="classifyname">服务分类</div>

        <ul id="menu">
            <li class="menu1"><a href="">化学性质分析</a> <span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">元素分析</a></li>
                        <li><a href="">成分分析</a></li>
                        <li><a href="">分子量分析</a></li>
                        <li><a href="">官能团分析</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">物理性质分析</a> <span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">热性质分析</a></li>
                        <li><a href="">晶相分析</a></li>
                        <li><a href="">电磁性质分析</a></li>
                        <li><a href="">光学性质分析</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">表面微区分析</a><span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">表面性能分析</a></li>
                        <li><a href="">表面成分分析</a></li>
                        <li><a href="">形貌分析</a></li>
                        <li><a href="">粒度分析</a></li>
                        <li><a href="">表面结合能分析</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">化工与材料</a><span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">精细化工</a></li>
                        <li><a href="">工业催化</a></li>
                        <li><a href="">有机材料</a></li>
                        <li><a href="">无机材料</a></li>
                        <li><a href="">高分子材料</a></li>
                        <li><a href="">生物材料</a></li>
                        <li><a href="">能源材料</a></li>
                        <li><a href="">航空材料</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">能源与环境</a><span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">动力工程</a></li>
                        <li><a href="">能源工程</a></li>
                        <li><a href="">热能工程</a></li>
                        <li><a href="">公共环境</a></li>
                        <li><a href="">矿物与土壤</a></li>
                        <li><a href="">工业污水</a></li>
                        <li><a href="">工业气体</a></li>
                        <li><a href="">叶轮机械</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">轻工与食品</a><span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">纺织工程</a></li>
                        <li><a href="">染整工程</a></li>
                        <li><a href="">皮革工程</a></li>
                        <li><a href="">造纸工程</a></li>
                        <li><a href="">食品工程</a></li>
                        <li><a href="">香精香料</a></li>
                    </ul>
                </div>
            </li>

            <li class="menu1"><a href="">生命科学</a><span> > </span>
                <div class="menu1detail">
                    <ul>
                        <li><a href="">蛋白组分析</a></li>
                        <li><a href="">基因组分析</a></li>
                        <li><a href="">基因测序</a></li>
                        <li><a href="">核酸分析</a></li>
                    </ul>
                </div>
            </li>

            <li class="menu1"><a href="">制药与临床</a><span> > </span>
                <div class="menu2detail">
                    <ul>
                        <li><a href="">药物鉴别</a></li>
                        <li><a href="">纯度分析</a></li>
                        <li><a href="">药物合成</a></li>
                        <li><a href="">中药提取</a></li>
                        <li><a href="">生物制药</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">机械与电子</a><span> > </span>
                <div class="menu2detail">
                    <ul>
                        <li><a href="">结构工程</a></li>
                        <li><a href="">机械工程</a></li>
                        <li><a href="">电气工程</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">动物实验平台</a><span> > </span>
                <div class="menu2detail">
                    <ul>
                        <li><a href="">动物平台</a></li>
                        <li><a href="">微生物平台</a></li>
                        <li><a href="">制药工程</a></li>
                        <li><a href="">环境工程</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">小中试平台</a><span> > </span>
                <div class="menu2detail">
                    <ul>
                        <li><a href="">化学工程</a></li>
                        <li><a href="">材料科学</a></li>
                        <li><a href="">制药工程</a></li>
                        <li><a href="">轻化工程</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">测试辅助</a><span> > </span>
                <div class="menu2detail">
                    <ul>
                        <li><a href="">样品制备</a></li>
                        <li><a href="">样品纯化</a></li>
                    </ul>
                </div>
            </li>
            <li class="menu1"><a href="">合成中间体</a><span> > </span>
                <div class="menu2detail">
                    <ul>
                        <li><a href="">化学工程</a></li>
                        <li><a href="">材料科学</a></li>
                        <li><a href="">制药工程</a></li>
                        <li><a href="">轻化工程</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- classify 左边菜单栏完-->


    <div id="pictrue">

        <div class="row">
            <div class="col-md-12">

                <div class="carousel slide" id="carousel-896596">
                    <ol class="carousel-indicators">
                        <li class="active" data-slide-to="0"
                            data-target="#carousel-896596"></li>
                        <li data-slide-to="1" data-target="#carousel-896596"></li>
                        <li data-slide-to="2" data-target="#carousel-896596"></li>
                        <li data-slide-to="3" data-target="#carousel-896596"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active" align="center">
                            <img alt="Carousel Bootstrap First" src="upload/2017/index-1.png">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item" align="center">
                            <img alt="Carousel Bootstrap Second" src="img/2.jpg">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item" align="center">
                            <img alt="Carousel Bootstrap Third" src="img/3.jpg">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item" align="center">
                            <img alt="Carousel Bootstrap Third" src="img/1.jpg"
                                 style="height: 100%">
                            <div class="carousel-caption"></div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-896596"
                       data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span>
                    </a> <a class="right carousel-control" href="#carousel-896596"
                            data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- pictrue -->


    <div id="notice">
        <div id="welcome">
            <img id="people" src="upload/2017/people_img.png"/>
            <div id="login">
                <p>Hi,欢迎来到聚仪网！</p>
                <span><a href="javascript:;">登陆</a></span> <span><a
                            href="javascript:;">注册</a></span>
            </div>
        </div>
        <div class="notice_bg">
            <ul>
                <li><a href=""><img src="upload/2017/institution.png"/></a></li>
                <li><a href=""><img src="upload/2017/specialist.png"/></a></li>
                <li><a href=""><img src="upload/2017/demand.png"/></a></li>
            </ul>
        </div>
        <div id="notice2">

            <ul id="noticetab" class="nav nav-tabs">
                <li class="active"><a href="#jynews" data-toggle="tab"> 聚仪新闻 </a></li>
                <li><a href="#jyzixun" data-toggle="tab">聚仪资讯</a></li>

            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="jynews">
                    <p>菜鸟教程是一个提供最新的web技术站点，本站免费提供了建站相关的技术文档，帮助广大web技术爱好者快速入门并建立自己的网站。菜鸟先飞早入行——学的不仅是技术，更是梦想。</p>
                </div>
                <div class="tab-pane fade" id="#jyzixun">
                    <p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和
                        Apple TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS
                        是苹果的移动版本。</p>
                </div>

            </div>

        </div>
        <!-- notice2 -->


    </div>
    <!-- notice -->

</div>
<!-- floor-0 -->


<div id="floor-1">
    <div id="floor-1-1">

        <ul id="floor1-Tab" class="nav nav-tabs">
            <li class="active"><a href="#hot" data-toggle="tab"> 热 门 仪 器</a></li>
            <li><a href="#new" data-toggle="tab">热 门 机 构</a></li>
            <li><a href="#cheap" data-toggle="tab">聚 仪 专 家</a></li>
        </ul>

    </div> <!-- floor-1-1 -->

    <div class="tab-content" id="floor1tabcontent">
        <div class="tab-pane fade in active" id="hot">
            <div class="polaroid"><!-- 第一张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>

                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>

                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>


                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
        </div><!-- 图片完 -->
        <div class="tab-pane fade" id="new">
            <p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple
                TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。</p>
        </div>
        <div class="tab-pane fade" id="cheap">
            <p>jMeter 是一款开源的测试软件。它是 100% 纯 Java 应用程序，用于负载和性能测试。</p>
        </div>

    </div>


</div><!-- floor-1 -->


<div class="F1">
    <div id="F1img">
        <img src="upload/2017/1F.png" alt="Norway" style="height:100%">
    </div>
    <div id="F1title">化学性质分析</div>
</div><!-- F1 -->

<div class="F1key">
    <div class="F1keycontent">
        <ul>
            <li>元素分析</li>
            <li>成分分析</li>
            <li>分子量分析</li>
            <li>官能团分析</li>
        </ul>
    </div>
</div><!-- F1key -->

<div id="whole">
    <div class="Flist">
        <a href=""><img src="upload/2017/1F-1.png"/></a>
        <a href=""><img src="upload/2017/2F-2.png"/></a>
        <a href=""><img src="upload/2017/3F-3.png"/></a>
        <a href=""><img src="upload/2017/4F-4.png"/></a>
        <a href=""><img src="upload/2017/5F-5.png"/></a>
        <a href=""><img src="upload/2017/6F-6.png"/></a>
        <a href=""><img src="upload/2017/7F-7.png"/></a>
        <a href=""><img src="upload/2017/8F-8.png"/></a>
    </div>
    <div id="left">
        <div class="floor-2">
            <div class="floor-2-main">
                <div class="polaroid2"><!-- 第1张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid2 -->

                <div class="polaroid2"><!-- 第2张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid -->

                <div class="polaroid2"><!-- 第3张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid -->

                <div class="polaroid2"><!-- 第4张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid2 -->
                <div class="polaroid2"><!-- 第1张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid2 -->

                <div class="polaroid2"><!-- 第2张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid -->

                <div class="polaroid2"><!-- 第3张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid -->

                <div class="polaroid2"><!-- 第4张图 -->
                    <div class="goodimg">
                        <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                    </div>
                    <div class="goodprice">
                        <p><?= Html::encode($goods->sell_price); ?>元</p>
                    </div>
                    <div class="goodintro">
                        <p><?= Html::encode($goods->name); ?></p>
                    </div>
                    <div class="goodappoint">
                        <p><?= Html::encode($goods->id); ?></p>
                        <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                    </div>
                </div> <!-- polaroid -->
            </div><!-- floor-2-main -->
        </div> <!-- floor-2 -->
        <div class="F2">
            <div id="F2img">
                <img src="upload/2017/2F.jpg" alt="Norway" style="height:100%">
            </div>
            <div id="F2title">物理性质分析</div>
        </div><!-- F2 -->
        <div class="F2key">
            <div class="F2keycontent" style="width:600px">
                <ul>
                    <li class="active">力学性质分析</li>
                    <li>热性质分析</li>
                    <li>晶相分析</li>
                    <li>电磁性质分析</li>
                    <li>光学性质分析</li>
                </ul>
            </div>
        </div><!-- F2key -->
        <div class="floor-2">
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
        </div> <!-- floor-2 -->

        <div class="F2">
            <div id="F2img">
                <img src="upload/2017/3F.jpg" alt="Norway" style="height:100%">
            </div>
            <div id="F2title">表面微区分析</div>
        </div><!-- F2 -->
        <div class="F2key">
            <div class="F2keycontent" style="width:600px">
                <ul>
                    <li class="active">表面性能分析</li>
                    <li>表面成分分析</li>
                    <li>形貌分析</li>
                    <li>粒度分析</li>
                    <li>表面结合能分析</li>
                </ul>
            </div>
        </div><!-- F2key -->
        <div class="floor-2">
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
        </div> <!-- floor-2 -->

        <div class="F2">
            <div id="F2img">
                <img src="upload/2017/4F.jpg" alt="Norway" style="height:100%">
            </div>
            <div id="F2title">解码专家</div>
        </div><!-- F2 -->
        <div class="F2key">
            <div class="F2keycontent" style="width:1000px">
                <ul>
                    <li class="active">化学性质分析</li>
                    <li>物理性质分析</li>
                    <li>表面微区分析</li>
                    <li>化工与材料</li>
                    <li>能源与环境</li>
                    <li>轻工与食品</li>
                    <li>生命科学</li>
                    <li>制药与临床</li>
                    <li>机械与电子</li>
                </ul>
            </div>
        </div><!-- F2key -->
        <div class="floor-2">
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
        </div> <!-- floor-2 -->


        <div class="F2">
            <div id="F2img">
                <img src="upload/2017/5F.jpg" alt="Norway" style="height:100%">
            </div>
            <div id="F2title">科研辅助</div>
        </div><!-- F2 -->
        <div class="F2key">
            <div class="F2keycontent" style="width:600px">
                <ul>
                    <li class="active">试验台加工</li>
                    <li>仪器维修</li>
                    <li>仪器租赁</li>
                    <li>仪器销售</li>
                    <li>实验耗材</li>
                </ul>
            </div>
        </div><!-- F2key -->
        <div class="floor-2">
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
        </div> <!-- floor-2 -->

        <div class="F2">
            <div id="F2img">
                <img src="upload/2017/1F.jpg" alt="Norway" style="height:100%">
            </div>
            <div id="F2title">数值模拟</div>
        </div><!-- F2 -->
        <div class="F2key">
            <div class="F2keycontent" style="width:700px">
                <ul>
                    <li class="active">化工与材料</li>
                    <li>能源与环境</li>
                    <li>轻工与食品</li>
                    <li>生命科学</li>
                    <li>制药与临床</li>
                    <li>机械与电子</li>
                </ul>
            </div>
        </div><!-- F2key -->
        <div class="floor-2">
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
            <div class="polaroid2"><!-- 第1张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid2 -->

            <div class="polaroid2"><!-- 第2张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第3张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->

            <div class="polaroid2"><!-- 第4张图片 -->
                <div class="goodimg">
                    <img src="upload/2016/06/14/20160614124055604.jpg" alt="Norway" style="width:100%">
                </div>
                <div class="goodprice">
                    <p><?= Html::encode($goods->sell_price); ?>元</p>
                </div>
                <div class="goodintro">
                    <p><?= Html::encode($goods->name); ?></p>
                </div>
                <div class="goodappoint">
                    <p><?= Html::encode($goods->id); ?></p>
                    <input type="hidden" value="<?= Html::encode($goods->id); ?>">
                </div>
            </div> <!-- polaroid -->
        </div> <!-- floor-2 -->


    </div><!-- left -->


    <div id="right">
        <div id="linkfriendly">
            <strong>友情链接</strong>
            <img src="upload/2017/arrow_right.png"/>
            <span><a href="javascript:;">more</a></span>
        </div>
        <div class="rightimg">
            <img src="upload\2016\08\07\20160807023047651.jpg" alt="Norway" style="width:100%">
        </div>

        <div class="rightimg">
            <img src="upload\2016\08\07\20160807023047651.jpg" alt="Norway" style="width:100%">
        </div>
        <div class="rightimg">
            <img src="upload\2016\08\07\20160807023047651.jpg" alt="Norway" style="width:100%">
        </div class="rightimg">
        <div>
            <img src="upload\2016\08\07\20160807023047651.jpg" alt="Norway" style="width:100%">
        </div>


    </div><!-- right -->


</div><!-- whole -->


<div id="rightfix">
    <div class="fix-top">
        <a href=""><img src="upload/2017/people.png"/></a>
        <a href=""><img src="upload/2017/shop.png"/></a>
        <a href=""><img src="upload/2017/heart.png"/></a>
        <a href=""><img src="upload/2017/timer.png"/></a>
        <a href=""><img src="upload/2017/message.png"/></a>
        <a href=""><img src="upload/2017/bird.png"/></a>
    </div>
    <div class="fix-bottom">
        <a href=""><img src="upload/2017/up.png"/></a>
    </div>
</div>


