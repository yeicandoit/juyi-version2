<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>


<style type="text/css">
#whole {
	width:1100px;
	margin:auto;
}
#left
{
	width:120px;
	float:left;
	border-right-style : double;
	border-right-width : 4px;
}

#right
{
	width:970px;
	float:right;
}
</style>
<script type="text/javascript">
</script>
<div class="sellerinfo">
<table class="table table-bordered" style="min-width: 750px">
  <caption>聚仪资讯</caption>
  <tbody>
           <?php foreach($allnews as $mm):?>
    <tr>
      <td><a href="<?= Yii::$app->params['fUrl'] . "site/shownews&id=$mm->id"?>" ><?= Html::encode($mm->title)?></a></td>
      <td>
         <form name="formpay" id="formpay" method="post" action="<?=Url::to(["admin/manageinformation"])?>">
                <input " type="hidden" name="newsid" value="<?= $mm->id ?>">
            	<input type="hidden"      name="<?= \Yii::$app->request->csrfParam; ?>"     value="<?= \Yii::$app->request->getCsrfToken();?>">
            	<button type="submit" class="btn btn-primary" > 删除资讯 </button>
            	</form>
      </td>
            <td>
         <form name="formpay" id="formpay" method="post" action="<?=Url::to(["admin/changeinformation"])?>">
                <input  type="hidden" name="newsid" value="<?= $mm->id ?>">
            	<input type="hidden"      name="<?= \Yii::$app->request->csrfParam; ?>"     value="<?= \Yii::$app->request->getCsrfToken();?>">
            	<button type="submit" class="btn btn-primary" > 修改资讯 </button>
            	</form>
      </td>
    </tr>
           <?php endforeach; ?>
  </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
