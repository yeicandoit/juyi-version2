 <?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use frontend\models\seller\SellerMenu;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?= Html::jsFile('@web/assets/57c9d7e8/jquery.js') ?>
    <?php $this->head() ?>
    
       
    

    <link rel="shortcut icon" href="mybootstrap/flatui/img/favicon.ico">

    
   
    <?php 
AppAsset::register($this);
AppAsset::addCss($this,Yii::$app->request->baseUrl."/assets/6f93f37f/jquery-ui.css");
?>
    

 
  
  <style type="text/css">

#mynavtop {
	width:100%;
	background-color:#000033;
}
#mynavimg {
	width:1100px;
	margin:auto;
}


#mynav{
	width:100%;
	height:26px;
	background-color: #CCCCCC;
	z-index:88;

	color:#080808;
	margin:0px;
	padding:0px;
	font-size:14px;
	position:fixed;
	top:0;
}

#mynav a {
  color:#080808;
}

#mynavcontent{
	width:1100px;
	margin:auto;
	
}


#mynavleft{
	width:450px;
	float:left;
	
	height:26px;
	

	
}

#mynavright{
	width:640px;
	
    float:right;
	
	height:26px;
	
}



button.btn.btn-link.logout {
	
	height: 20px;
	margin:0px;
	padding:0px;
	
}


.mynav-ul li {
	
	height:26px;
	float:left;
	width:70px;
	list-style:none;
	margin:0px;
	padding-top:2px;
	border-left:solid;
	text-align:center;
    border-color:#BDC3C7;
	
}





#dingdancontent {
	
	width:100px;
	height:80px;
	background-color:#CCCCCC;
	z-index:9;
	color:;
	position:relative;
	top:0px;
    margin-left:-3px;
	display:none;

	
}


.contentul {
	margin:0px;
	
	padding:0px;
	
}

.contentul li {
	margin:0px;
	padding:0px;
	list-style:none;
	width:100px;
}


#weixin {
	
	width:100px;
	height:100px;
	background-color:#CCCCCC;
	z-index:9;
	position:relative;
	top:0px;
   
	display:none;
}


#header2
{

height:130px;
width:1100px;
margin:auto;
margin-top: 40px;

}

#header2-1
{

height:100px;
width:170px;
float:left;
	
	margin-left:2px;
	padding-left:2px;
	text-align:left;
		
}

#header2-2
{

height:120px;
	width:700px;
text-align:left;
	
		float:left;

	
}

#header2-2-1
{
height:100px;
	font-size:16px;


}

#header2-2-2
{
    text-align:left;
	font-size:14px;
    height:30px;
	margin-left: 30px;
}

#header2-3
{

height:100px;
	width:120px;
text-align:center;
	
		float:left;

	margin-top:30px;
	
}

#header2-4
{

height:100px;
	width:80px;
text-align:center;
	
		float:right;

	margin-top:30px;
	
}

#search
{
height:80px;
width:700px;
	padding-left:20px;
	
padding-right:20px;
}


#searchTab {
    height:32px;
}

#searchTab li a{
    height:32px;
	padding-top:5px;
	margin:0px;
	color:black;
	font-size:14px;
}

.container 
{width: 1100px;
  margin-bottom:2px;
  padding-top:2px;

}


	
#searchTabContent
{
	background-color:#116Fb5;
	height:45px;
	padding:6px;
	
}

.input-group-btn .btn {
    color: rgb(247, 247, 247);
    background-color: #116fb5;
	border:none;
}

#fenge  {
   width:800px;
	height:40px;
    
	margin:auto;
	margin-bottom:20px;
	margin-left:312px;
	color:black;
	text-align:center;
}





.fenge-ul li {
	
	height:40px;
	float:left;
	width:110px;
	list-style:none;
	padding-top:5px;
		
	color:#003366;
	
	font-size:18px;
	font-weight: bold;
	text-align:center;
	border-right:solid;
	
}

.fenge-ul a {
	
     color:#003366;
	font-family:Microsoft YaHei;
	
}

.fenge-ul a:hover {
	
     color:red;
	
	
}


#fenge2  {
   width:1100px;
	height:2px;
    background-color:#116Fb5;
	
	margin:auto;
margin-bottom:15px;
}


#footernav{
	height:30px;
	width:100%;
	background-color:#CCCCCC;
	margin:0px;
	padding:0px;
}

.footer {
	
	height:300px;
	margin-top:30px;
	padding:0px;
	border:none;
	
}

#footernav ul li{
		height:26px;
	float:left;
	width:180px;
	list-style:none;
	margin:0px;
	padding-top:2px;
	border-left:solid;
	text-align:center;
    border-color:#BDC3C7;
}

#footercontent {
	
	width:1000px;
	margin:auto;
}

.footercontentdetail {
	width:180px;
	height:200px;
	float:left;
	text-align:center;	
	margin-top:10px;
}
.footercontentdetail li{
	
	width:180px;
	height:40px;
	list-style:none;	
}


  </style>
       
       <script type="text/javascript">

       $(function(){

    	  
    	   
        	   
       	   //实现搜索部分的颜色效果
    	  $('#searchTab li:first a').css("background-color","#116fb5");


    	   //导航下拉

      	   $(".navdown").hover(function(){  
    		   $(this).css("background-color","#999999");
               $(this).children("div").show(); 
               //$("#dingdan").addClass(".icon2");
               $("#dingdan").find(".icon1").hide();
               $("#dingdan").find(".icon2").show();
    	       }, 
    	        function () { 
    	    	   $(this).children("div").hide(); 
    	    	   $("#dingdan").find(".icon2").hide();
    	    	   $("#dingdan").find(".icon1").show();
    	    	   $(this).css("background-color","#CCCCCC");
    	       });  

    	   
    	  
    	   
    	   $(".contentul li").hover(function(){  
                        
              // $(this).css("background-color","#0099FF");
    		   $(this).css({"background-color":"#999999","padding-left":"8px"});
               
    	       }, 
    	        function () { 
    		  
    	    	  // $(this).css("background-color","#0000CC");

    	    	   $(this).css({"background-color":"#CCCCCC","padding-left":"3px"});
    	   });  





    	   
    	 
        	  
          //搜索颜色显示
  	     $('#searchTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
             
             
             var activeTab = $(e.target).css("background-color","#116fb5");
             var previousTab = $(e.relatedTarget).css("background-color","white");
            
             
         });


    	   $(".fenge-ul li:last").css("border-right","none");


           
           
       });




       
       </script>
 
</head>
<body>
<?php $this->beginBody() ?>



<div id="mynav">
<div id="mynavcontent">

<div id="mynavright">

<ul class="mynav-ul">
<li><a href="<?=Url::to(["site/index"])?>">首页</a></li>
<?php  
 $curuser = isset(Yii::$app->user->identity) ? Yii::$app->user->identity->username : "guest";
 $login = Url::to(["site/login"]);
 $signup = Url::to(["site/register"]);

 
if (Yii::$app->user->isGuest) {
  
	echo " 
   
   <li style='width:130px'><a href=$login>登录</a> /
   <a href=$signup>免费注册</a></li>
  ";
  }
  else 
  {
  	echo "
   <li>欢迎您</li>
   <li> $curuser </li>".
   '<li>'
    			. Html::beginForm(['/shop-seller/logout'], 'post')
    			. Html::submitButton(
    					'[注销] ',
    					['class' => 'btn btn-link logout']
    			)
    			. Html::endForm()
    			. '</li>'
   
   
   
		;
  	
  	
  }
  ?>

   <li><a href="<?=Url::to(["shop-seller/sellerreg"])?>">申请入驻</a></li>
   <li><a href="<?=Url::to(["shop-seller/login"])?>">商家登录</a></li>
	<?php
		if(Yii::$app->user->isGuest) {
			$action = 'shop-seller/login';
		} else{
			$shop = \frontend\models\seller\ShopMember::findOne(Yii::$app->user->id);
			if ('seller' == $shop->regtype) {
				$action = 'shop-seller/seller';
			} else {
				$action = 'shop-seller/expert';
			}
		}
	?>
	<li><a href="<?=Url::to(["$action", 'id'=>Yii::$app->session->get('shopid')])?>">商家主页</a></li>

</ul> 

</div><!--mynavright-->

</div><!--mynavcontent-->
</div> <!--mynav -->
      <div id="header2">
<div id="header2-1">
<img src="upload/2017/logo.png" alt="Norway" style="height:100%">
</div><!--search1-->

<div id="header2-2" >

<div id="header2-2-1" >
<div id="search">
<ul id="searchTab" class="nav nav-tabs">
	<li class="active">
		<a href="#home" data-toggle="tab">
			 检测中心
		</a>
	</li>
	<li><a href="#ios" data-toggle="tab">需求大厅</a></li>
	<li><a href="#ios" data-toggle="tab">专家解码</a></li>
     <li><a href="#ios" data-toggle="tab">科研辅助</a></li>
     <li><a href="#ios" data-toggle="tab">数值模拟</a></li>
</ul>
<div id="searchTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="home">
		
		
			<form class="bs-example bs-example-form" role="form">
		<div class="row">

			<div class="col-xs-12">
				<div class="input-group" style="padding-left: 30px">
					<input type="text" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							搜索
						</button>
					</span>
				
				</div><!-- /input-group -->
					
			</div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
	</form>
	</div>
	<div class="tab-pane fade" id="ios">
					<form class="bs-example bs-example-form" role="form">
		<div class="row">

			<div class="col-xs-12">
				<div class="input-group" style="padding-left: 30px">
					<input type="text" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							搜索
						</button>
					</span>
				
				</div><!-- /input-group -->
					
			</div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
	</form>
	</div>

</div>  

</div>  <!--search--> 
</div>   <!--header2-2-1--> 

<div id="header2-2-2" >
热门搜索： 
</div>
</div><!--header2-2-->
<div id="header2-3">
<a href=""><img src="upload/2017/buycar.png" alt="Norway" style="width:100%;"></a>
</div> <!--header2-3-->
<div id="header2-4">
<a href=""><img src="upload/2017/wechat.jpg" alt="Norway" style="width:100%;"></a>
</div> <!--header2-4-->
</div> <!--header2-->
    <div id="fenge">
    <ul class="fenge-ul">
        <li><a href="<?=Url::to(["site/mainpage3"])?>">检测中心</a></li>
        <li><a href="">需求大厅</a></li>
        <li><a href="">专家解码</a></li>
        <li><a href="">科研辅助</a></li>
        <li><a href="">数值模拟</a></li>
        <li><a href="">关注聚仪</a></li>
    </ul>
    </div> <!-- fenge -->
  <div id="fenge2"></div>
 <div class="container">

     <?= Breadcrumbs::widget([
         'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
     ]) ?>
     <?= Alert::widget() ?>
	 <?=Html::cssFile('@web/css/sellerhome.css')?>
	 <?php $actionId = Yii::$app->controller->action->id;
	 if($actionId != 'expertreg'
			 && $actionId != 'sellerreg'
	 		 && $actionId != 'login'
	 		 && $actionId != 'expert'
			 && $actionId != 'lab') {?>
		 <div class="menuInfo">
			 <?php foreach(SellerMenu::getMenu() as $item=>$subMenu){?>
				 <div class="box">
					 <div class="smenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
					 <div class="cont">
						 <ul class="list">
							 <?php foreach($subMenu as $moreKey => $moreValue){?>
								 <li><a target="_blank"  href="<?php echo Url::to([$moreValue]);?>"><?php echo isset($moreKey)?$moreKey:"";?></a></li>
							 <?php }?>
						 </ul>
					 </div>
				 </div>
			 <?php }?>
		 </div>
	 <?php }?>
     <?= $content ?>
 </div>  <!-- container -->


<footer class="footer">
    <div id="footernav">
        <div style="width:1000px;margin:auto">
            <ul>
                <li>新手指南</li>
                <li>实验室入驻</li>
                <li>售后服务</li>
                <li>联系聚仪</li>
                <li>关注我们</li>   
            </ul>     
    	</div>
 </div>
 <div id="footercontent" >
     <div class="footercontentdetail">
      <ul>
         <li>会员注册</li>
         <li>测试流程</li>
         <li>支付方式</li>
         <li>联系客服</li>
     </ul>
     </div>
     <div class="footercontentdetail">
      <ul>
         <li>商家注册</li>
         <li>入驻流程</li>
         <li>法律规范</li>
     </ul>
     </div>
     <div class="footercontentdetail">
      <ul>
         <li>售后条款</li>
         <li>退款流程</li>
         <li>取消订单</li>
         <li>售后客服</li>
     </ul>
     </div>
     <div class="footercontentdetail">
      <ul>
         <li>联系聚仪</li>
         <li>意见建议</li>
     </ul>
     </div>
     <div class="footercontentdetail">
      <ul>
      	<li><img alt="" src="upload/2017/attentionus0.png" style="width: 60px;height:60px;"></li>
      	<li style="height:25px;"></li>
      	<li style="font-family:Microsoft YaHei;font-size:12px;height:30px;">微信公众号：juyitest</li>
      	<li><img alt="" src="upload/2017/attentionus1.png" style="width: 60px;height:60px;"></li>
      	<li style="height:25px;"></li>
      	<li style="font-family:Microsoft YaHei;font-size:12px;height:20px;">聚仪网官方微博</li>
      </ul>
     </div>

 </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>