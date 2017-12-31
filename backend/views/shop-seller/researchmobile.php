<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./jquery.min.js"></script>
    <script src="./jqmb/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="./jqmb/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="./css/sellerhome.css">
    <title>检测中心实验室</title>
    <style type="text/css">
        Table tbody tr {
            border-bottom: 0.1rem solid grey;
        }
        Table thead tr {
            border-bottom: 0.1rem solid grey;
        }
        .font1 {
            font-size: 1em;
            text-decoration: none;
        }
        .myp {
            font-size: 0.8rem;
        }
        .hot {
            float: left;
            padding: 1rem;
        }
        .fiterp {
            float: left;
            margin-right: 1rem;
            border: 0.1em solid;
            border-radius: 1rem;
            padding: 0.3rem;
            background-color: rgb(236, 237, 248);
        }
        .p-brand {
            float: left;
            margin: 0.3rem;
            margin-right: 1rem;
            border: 0.1em solid;
            border-radius: 1rem;
            padding: 0.3rem;
            background-color: rgb(236, 237, 248);
        }
        .ui-block-a, .ui-block-b, .ui-block-c, .ui-block-d {
            background-color: #e8e8e8;
            border: 1px solid #e9e9e9;
            font-weight: bold;
            text-align: center;
        }
        .floatdiv {
            float: left;
        }
        ul li {
            list-style: none;
            margin-top: 1rem;
        }
        ul {
            padding-left: 0.5rem;
            margin: 1rem;
        }
        .ui-table-columntoggle-btn {
            display: none !important;
        }
    </style>
    <script  type="text/javascript">
        function showlab(id)
        {
            for(var i=0; i<4; i++){
                $("#showlab_"+i).hide();
            }
            $("#showlab_"+id).show();
        }

        var pagenum=0;
        $(document).on("pagecreate","#pageone",function(){
            $("#addmore").on("tap",function(){
                pagenum+=1;
                $.ajax({
                    url:"<?=Url::to(["shop-seller/shopgoods"])?>",
                    data:"page="+pagenum+"&shopid="+<?=$lab->id?>,
                    success:function(result){
                        var myobj = eval('(' + result + ')');
                        for(var i=0;i<myobj.length;i++){  
                            var str1="<tr>";
                            var str2= "<td style='width:8rem;'>  <img src= "    + myobj[i]['img'] + " alt='Norway' style='width:100%'>    </td>";
                            var str3="<td>  <div class='myp'>" +  myobj[i]['name']  + "</div>";
                            var str4= "<div class='myp'>品  &nbsp&nbsp 牌："+  myobj[i]['brand']+ "</div>";
                            var str5= "<div class='myp'>型  &nbsp&nbsp 号："+  myobj[i]['brandversion']+ "</div>";
                            var str6="<div class='myp'>销售价："+  myobj[i]['sell_price']+ "</div>";
                            var str7="	 <div class='myp' style='text-decoration:line-through;color:red'>市场价："+  myobj[i]['market_price']+ "</div>";
                            var str9="</tr>  ";

                            var str=str1+str2+str3+str4+str5+str6+str7+str9;
                            $("#goodTable").append(str);
                        }  
                    }});
            })
        });
    </script>
</head>

<body>
<div data-role="page" id="pageone">
    <div data-role="header">
        <a href="#pagetwo" class="ui-btn ui-corner-all ui-btn-icon-right">实验室信息</a>
        <h1>科研辅助实验室</h1>
        <?php   if (Yii::$app->user->isGuest):?>
             <a href="<?=Url::to(['site/login'])?>" data-ajax="false" class="ui-btn ui-corner-all ui-icon-user ui-btn-icon-notext"></a>	
        <?php endif;?>
        <?php  if (!Yii::$app->user->isGuest):?>
             <a href="#page-logined"  class="ui-btn ui-corner-all ui-icon-user ui-btn-icon-notext" style="background-color:blue"></a>	
        <?php endif;?>

        <div data-role="navbar">
            <ul>
                <li><a href="#" onclick="showlab(1)">科研商品</a></li>
                <li><a href="#" onclick="showlab(2)">公司简介</a></li>
                <li><a href="#" onclick="showlab(3)">科研队伍</a></li>
                <li><a href="#" onclick="showlab(4)">科研成果</a></li>
            </ul>
        </div>
    </div>   <!-- pageone header -->

    <div data-role="main" class="ui-content">
        <div id="showlab_2" style="display:none"><?=$labInfo->description?></div>
        <div id="showlab_3" style="display:none"><?=$labInfo->team?></div>
        <div id="showlab_4" style="display:none"><?=$labInfo->outwork?></div>
        <div id="showlab_1">
            <table data-role="table" data-mode="columntoggle" class="ui-responsive" id="goodTable">
                <thead>
                <tr>
                    <th>
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model as $k=>$g): ?>
                    <tr>
                        <td style="width:8rem;">
                            <img src="<?= $g['img'] ?>" alt="Norway" style="width:100%">
                        </td>
                        <td>
                            <div class="myp"><?= Html::encode($g['name']); ?></div>
                            <div class="myp">品 &nbsp&nbsp 牌：<?= Html::encode(isset($g->brandid)? $g->brand->name: ''); ?></div>
                            <div class="myp">型 &nbsp&nbsp 号：<?= Html::encode($g->brandversion); ?></div>
                            <div class="myp">销售价：
                                <?php if ($g['sell_price'] == 0) {
                                    echo "价格面议";
                                } else {
                                    echo $g['sell_price'] . "元/样";
                                }
                                ?>
                            </div>
                            <div class="myp" style="text-decoration:line-through;color:red">市场价：
                                <?php if ($g['market_price'] == 0) {
                                    echo "价格面议";
                                } else {
                                    echo $g['market_price'] . "元/样";
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div id="addmore" style="text-align:right"><a href="#">加载更多商品</a></div>
            <div style="width:3.1rem;height:3.1rem;background-color:rgb(44,124,193);position:fixed;right:1rem;bottom:2.5rem;border-radius:2rem;text-align:center;"> 
            <a href="#pageone" data-ajax="false"><img src="upload/2017/up-1.png" style="margin-top: 0.4rem"></a>
            </div>
        </div><!--show_lab_1-->
        </div><!--date-role:main-->
    </div><!-- pageone content -->
    <div data-role="footer" data-position="fixed">
    </div><!-- pageone footer -->
</div>  <!-- pageone -->

<div data-role="page"  id="pagetwo">
    <div data-role="header">
        <h1>实验室相关信息</h1><a href="#pageone">返回</a>
    </div>
    <div data-role="main" class="ui-content">
        <div class="ui-grid-a ui-responsive">
            <div class="ui-block-a">
                <div style="width:50%;margin:auto">
                    <?= Html::img($lab->logo)?>
                </div>
            </div>
            <div class="ui-block-b">
                <table data-role="table" class="ui-responsive" data-mode="columntoggle" style="background-color:white">
                    <thead><tr><th></th><th></th></tr></thead>
                    <tbody>
                        <tr><td>名称</td><td><?= $lab->true_name?></td></tr>
                        <tr><td>所在地</td><td><?= $lab->getLocation("/")?></td></tr>
                        <?php $grade = 14 * $lab->grade?>
                        <tr><td>评分</td><td><span class="grade"><i style=<?="width:$grade" . "px"?>></i></span></td></tr>
                        <?php if("" != $lab->ext->reserve1){?>
                            <tr><td>宣传语</td><td><?=$lab->ext->reserve1?></td></tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div data-role="header">
            <h1>相关实验室</h1>
        </div>
        <table data-role="table" data-mode="columntoggle" class="ui-responsive" id="goodTable">
                <thead><tr><th></th><th></th></tr></thead>
                <tbody>
                <?php if(null != $relatedLabs){?>
                <?php foreach ($relatedLabs as $k=>$v): ?>
                    <tr>
                    <td>
                        <a href=<?=Url::to(['shop-seller/lab', 'id'=>$v->id])?> data-ajax="false"><?= Html::img("@web/$v->logo", ['style' => 'width:80px;height:60px;padding-top:5px']) ?></a>
                    </td>
                    <td>
                        <a href=<?=Url::to(['shop-seller/lab', 'id'=>$v->id])?> data-ajax="false"><?=$v->true_name?></a>
                    </td>
                    </tr>
                <?php endforeach; ?>
                <?php }?>
                </tbody>
            </table>


    </div><!-- main -->
</div>  <!-- pagetwo -->

</body>
</html>
