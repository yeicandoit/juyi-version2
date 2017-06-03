 <?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="mybootstrap/flatui/img/favicon.ico">
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
     <?= $content ?>
 </div>  <!-- container -->


<footer class="footer">
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>