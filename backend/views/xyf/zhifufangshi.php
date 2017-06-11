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

<div id="floor-0" class="row">
    <div id="classify" class="col-sm-3">
        <!-- 左边菜单栏开始 -->
        <ul id="menu">
            <li class="menu1">关于聚仪<span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showjuyijianjie">聚仪简介</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showtesefuwu">特色服务</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showhezuogongying">合作共赢</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showchengpinyingcai">诚聘英才</a> <span> > </span>
            </li>
            <li class="menu1">新手指南<span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showhuiyuanzhuce">会员注册</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showceshiliucheng">测试流程</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showzhifufangshi">支付方式</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showlianxikefu">联系客服</a> <span> > </span>
            </li>
            <li class="menu1">实验室入驻 <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showshangjiazhuce">商家注册</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showruzhuliucheng">入驻流程</a> <span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showfaguiguifan">法规规范</a> <span> > </span>
            </li>
            <li class="menu1">售后服务<span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showshouhoutiaokuan">售后条款</a><span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showtuikuanliucheng">退款流程</a><span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showquxiaodingdan">取消订单</a><span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showshouhoukefu">售后客服</a><span> > </span>
            </li>
            <li class="menu1">联系聚仪<span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showlianxijuyi">联系聚仪</a><span> > </span>
            </li>
            <li class="menu1"><a href="index.php?r=xyf/showyijianjianyi">意见建议</a><span> > </span>
            </li>
        </ul>
    </div>
    <!-- classify 左边菜单栏完-->
    <div class="col-sm-9">
        <h3>支付方式</h3>
        <?=$all->zffs?>
    </div>
</div>


