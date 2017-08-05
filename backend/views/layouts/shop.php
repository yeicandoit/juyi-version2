 <?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use backend\models\seller\Menu;

?>
<?php
$actionId = Yii::$app->controller->action->id;
$controllerId = Yii::$app->controller->id;
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Menu::getRoute2name("$controllerId/$actionId")) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href=<?=Url::to("@web/img/title.ico")?>>
  <?php
AppAsset::register($this);
?>

<style type="text/css">
#mynav{
	width:100%;
	height:60px;
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

#mynavright{
	width:640px;
    float:right;
}

.mynav-ul li {
	float:left;
	list-style:none;
	margin:0px;
	padding-top:2px;
	padding-left: 5px;
	padding-right: 5px;
	border-left:solid;
	text-align:center;
    border-color:#BDC3C7;
}

.contentul li {
	margin:0px;
	padding:0px;
	list-style:none;
	width:100px;
}

.container 
{
	width: 1100px;
  	margin-bottom:2px;
  	padding-top:100px;

}

.input-group-btn .btn {
    color: rgb(247, 247, 247);
    background-color: #116fb5;
	border:none;
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
</style>
       
<script type="text/javascript">
	$(function(){
	   $(".contentul li").hover(function(){
	       // $(this).css("background-color","#0099FF");
		   $(this).css({"background-color":"#999999","padding-left":"8px"});

	       },
	        function () {
	    	   $(this).css({"background-color":"#CCCCCC","padding-left":"3px"});
	   });
	   $(".fenge-ul li:last").css("border-right","none");

	});
</script>
 
</head>
<body>
<?php $this->beginBody() ?>
<div id="mynav">
<div id="mynavcontent">
	<?= Html::img('@web/images/logo.png')?>
<div id="mynavright">
<ul class="mynav-ul">
<li><a href="<?=Yii::$app->params['fUrl'].'site/index'?>">网站首页</a></li>
<?php  
	$curuser = isset(Yii::$app->user->identity) ? Yii::$app->user->identity->username : "guest";
	$login = Url::to(["shop-seller/login"]);
	$signup = Url::to(["shop-seller/sellerreg"]);

	if (Yii::$app->user->isGuest) {
		echo "
		 <li style='width:130px'><a href=$login>登录</a> /
		 <a href=$signup>申请入驻</a></li> ";
	} else {
  			echo "<li>欢迎您</li><li> $curuser </li>".
  			'<li>'
  			. Html::beginForm(['/shop-seller/logout'], 'post')
  			. Html::submitButton('[注销] ',['class' => 'btn-link logout'])
  			. Html::endForm()
  			. '</li>';
  	}
?>
<?php
	if(Yii::$app->user->isGuest) {
		$action = 'shop-seller/login';
	} else{
		$shop = \backend\models\seller\ShopMember::findOne(Yii::$app->user->id);
		if ('expert' != $shop->regtype) {
			$action = Yii::$app->params['fUrl'] . 'shop-seller/lab&id=';
		} else {
			$action = Yii::$app->params['fUrl'] . 'shop-seller/expert&id=';
		}
	}
?>
<li><a href="<?=$action . Yii::$app->user->id?>">商家主页</a></li>

</ul> 

</div><!--mynavright-->

</div><!--mynavcontent-->
</div> <!--mynav -->
 <div class="container">

     <?= Breadcrumbs::widget([
         'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
     ]) ?>
     <?= Alert::widget() ?>
	 <?=Html::cssFile('@web/css/sellerhome.css')?>
	 <?php
	 if($actionId != 'expertreg'
			 && $actionId != 'sellerreg'
	 		 && $actionId != 'login'
	 		 && $actionId != 'expert'
			 && $actionId != 'lab') {?>
		 <div class="menuInfo">
			 <?php foreach(Menu::getMenu() as $item=>$subMenu){?>
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

<footer class="footer" style="clear:both">
	<div style="text-align: center;font-size:12px;background-color:#CCCCCC">
		Copyright © 2005-2018 沪ICP备16029138号-1<br>
		上海市闵行区剑川路951号，零号湾创业科技园；服务热线：15221328568<br>
		上海聚仪检测科技有限公司   版权所有
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    window.onload =function() {
        hMenu = $(".menuInfo").height(); 
        hContainer = $(".sellerinfo").height();
        if(hMenu > hContainer) {
            $(".sellerinfo").height(hMenu+30);
        }
    }    
</script>
