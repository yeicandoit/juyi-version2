<?php

namespace frontend\controllers;

use frontend\models\seller\SellerDetailForm;
use frontend\models\seller\ShopMerchShipInfo;
use frontend\models\seller\ShopSpec;
use frontend\models\seller\ShopSpecSearch;
use frontend\models\ShopCategory;
use frontend\models\ShopComment;
use frontend\models\ShopCommentSearch;
use frontend\models\ShopGoods;
use frontend\models\ShopGoodsSearch;
use frontend\models\ShopOrder;
use frontend\models\ShopOrderGoods;
use frontend\models\ShopRefundmentDoc;
use frontend\models\ShopRefundmentDocSearch;
use Yii;
use frontend\models\seller\ShopSeller;
use frontend\models\seller\ShopSellerSearch;
use frontend\models\seller\ShopDeliverySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\seller\LoginForm;
use frontend\models\seller\SellerMenu;
use frontend\models\seller\ShopMerchShipInfoSearch;
use frontend\models\ShopOrderSearch;

/**
 * ShopSellerController implements the CRUD actions for ShopSeller model.
 */
class ShopSellerController extends Controller
{
    //To enable ajaxupload, set csrf to be false;
    public $enableCsrfValidation = false;
    public $layout = 'mymain-9';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ShopSeller models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopSellerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSellerhome()
    {
        return $this->render('sellerhome', ['menu'=>SellerMenu::getMenu()]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $seller = ShopSeller::find()->where(['seller_name'=>$model->username])->one();
            return $this->render('sellerhome', ['menu'=>SellerMenu::getMenu(), 'seller'=>$seller, 'sellerid'=>Yii::$app->user->id]);
        }
        return $this->render('login', ['model'=>$model]);
    }

    public function actionSellerinfo()
    {
        $sellerinfo = new SellerDetailForm();
        if($sellerinfo->load(Yii::$app->request->post()) && $sellerinfo->saveInfo()){
            return $this->redirect(['sellerhome']);
        }
        return $this->render('sellerinfo', ['menu'=>SellerMenu::getMenu(), 'sellerinfo'=>$sellerinfo]);
    }

    public function actionMerchship()
    {
        $searchModel = new ShopMerchShipInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('merchship', ['menu'=>SellerMenu::getMenu(), 'dataProvider'=>$dataProvider]);
    }

    public function actionShipinfo()
    {
        $shipinfo = new SellerDetailForm(SellerDetailForm::ViewAddr);
        if($shipinfo->load(Yii::$app->request->post()) && $shipinfo->saveShipInfo()){
            return $this->redirect(['merchship']);
        }
        return $this->render('shipinfo', ['menu'=>SellerMenu::getMenu(), 'shipinfo'=>$shipinfo]);
    }

    public function actionShipview($id)
    {
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $shipinfo = ShopMerchShipInfo::findOne($post['ShopMerchShipInfo']['id']);
            if($shipinfo->load($post) && $shipinfo->save()){
                return $this->redirect(['merchship']);
            }
        }
        $shipinfo = ShopMerchShipInfo::findOne($id);
        return $this->render('shipview', ['menu'=>SellerMenu::getMenu(), 'shipinfo'=>$shipinfo]);
    }

    public function actionShipdel($id)
    {
        $shipinfo = ShopMerchShipInfo::findOne($id);
        if($shipinfo) {
            $shipinfo->delete();
        }
        return $this->redirect(['merchship']);
    }

    public function actionShipdef($id)
    {
        $merchship = ShopMerchShipInfo::findOne($id);
        if($merchship->is_default == 0) {
            ShopMerchShipInfo::updateAll(['is_default' => 0], 'seller_id=:id', [':id' => Yii::$app->user->id]);
            $merchship->is_default = 1;
            $merchship->save();
        } else {
            $merchship->is_default = 0;
            $merchship->save();
        }
        return $this->redirect(['merchship']);
    }

    public function actionDelivery()
    {
        $searchModel = new ShopDeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('delivery', ['menu'=>SellerMenu::getMenu(), 'dataProvider' => $dataProvider,]);
    }

    public function actionOrder()
    {
        $searchModel = new ShopOrderSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('order', ['menu'=>SellerMenu::getMenu(), 'dataProvider'=>$dataProvider]);
    }

    public function actionOrderinfo($id)
    {
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $order = ShopOrder::findOne($post['ShopOrder']['id']);
            if($order->load($post) && $order->save()){
                return $this->render('orderinfo', ['menu'=>SellerMenu::getMenu(), 'order'=>$order]);
            } else {
                $this->goBack();
            }
        }
        $order = ShopOrder::findOne($id);
        return $this->render('orderinfo', ['menu'=>SellerMenu::getMenu(), 'order'=>$order]);
    }

    public function actionOrderdiscount($id, $discount)
    {
        $order = ShopOrder::find()->where(['id'=>$id, 'status'=>1, 'distribution_status'=>0])->one();
        if($order){
            $newOrderAmount = $order->order_amount - $order->discount + $discount;
            $order->discount = $discount;
            $order->order_amount = $newOrderAmount;
            if($order->save()){
                die(json_encode(array('result' => true,'orderAmount' => $newOrderAmount)));
            }
        }
        die(json_encode(array('result' => false)));
    }

    public function actionRefundment()
    {
        $searchModel = new ShopRefundmentDocSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('refundment', ['menu'=>SellerMenu::getMenu(), 'dataProvider'=>$dataProvider]);
    }

    public function actionRefundmentinfo($id){
        $refundment = ShopRefundmentDoc::findOne($id);
        return $this->render('refundmentinfo', ['menu'=>SellerMenu::getMenu(), 'refundment'=>$refundment]);
    }

    public function actionComment()
    {
        $searchModel = new ShopCommentSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('comment', ['menu'=>SellerMenu::getMenu(), 'dataProvider'=>$dataProvider]);
    }

    public function actionCommentedit($id)
    {
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $comment = ShopComment::findOne($post['ShopComment']['id']);
            if($comment->load($post) && $comment->saveRecontents()){
                $this->redirect(['comment']);
            } else {
                $this->goBack();
            }
        }
        $comment = ShopComment::findOne($id);
        return $this->render('commentedit', ['menu'=>SellerMenu::getMenu(), 'comment'=>$comment]);
    }

    public function actionGoodsadd()
    {
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $goods = new ShopGoods();
            $goods->load($post);
            $goods->seller_id = Yii::$app->user->id;
            $goods->create_time = date('Y-m-d H:i:s',time());
            $goods->sort = isset($goods->sort) ? $goods->sort : 10;
            $goods->is_del = 3;
            $specArr = array();
            $specArr['specPay'] = $post['specPay'];
            $specArr['specTest'] = $post['specTest'];
            $goods->spec_array = json_encode($specArr);
            if($goods->save()){
                if(isset($post['goodsCategory'])){
                    $goods->saveCat($post['goodsCategory']);
                }
                return $this->redirect(['goodslist']);
            }
            return $this->goHome();
        }
        $goods = new ShopGoods();
        return $this->render('goodsedit', ['menu'=>SellerMenu::getMenu(), 'goods'=>$goods]);
    }

    public function actionGoodsedit($id)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $goods = ShopGoods::findOne($post['ShopGoods']);
            $goods->load($post);
            if($goods->save()){
                if(isset($post['goodsCategory'])){
                    $goods->saveCat($post['goodsCategory']);
                }
                return $this->redirect(['goodslist']);
            }
            return $this->goHome();
        }
        $goods = ShopGoods::findOne($id);
        return $this->render('goodsedit', ['menu'=>SellerMenu::getMenu(), 'goods'=>$goods]);
    }

    public function actionGoodscategory()
    {
        $data = ShopCategory::find()->asArray()->all();
        $idname = ArrayHelper::map($data, 'id', 'name');
        $idmap = ArrayHelper::map($data, 'id', 'parent_id');
        return $this->renderAjax('goodscat', ['idname'=>$idname, 'idmap'=>$idmap]);
    }

    public function actionGoodslist()
    {
        $searchModel = new ShopGoodsSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('goodslist', ['menu'=>SellerMenu::getMenu(), 'dataProvider'=>$dataProvider]);
    }

    public function actionGoodsstat($id, $status)
    {
        $goods = ShopGoods::findOne($id);
        if($goods){
            $goods->is_del = $status;
            $goods->save();
        }
        return $this->redirect(['goodslist']);
    }

    public function actionSpeclist()
    {
        $searchModel = new ShopSpecSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('speclist', ['menu'=>SellerMenu::getMenu(), 'dataProvider'=>$dataProvider]);
    }

    public function actionSpecedit($id)
    {
        $spec = ShopSpec::findOne($id);
        return $this->render('specedit', ['menu'=>SellerMenu::getMenu(), 'spec'=>$spec]);
    }

    public function actionAccount()
    {
        $startDate = '';
        $endDate = '';
        if(Yii::$app->request->isPost){
            $startDate = Yii::$app->request->post('startDate');
            $endDate = Yii::$app->request->post('endDate');
        }
        $countData = ShopOrderGoods::sellerAmount(Yii::$app->user->id, $startDate, $endDate);
        return $this->render('account', ['menu'=>SellerMenu::getMenu(), 'countData'=>$countData]);
    }

    public  function  actionUpload()
    {
        $path = Yii::$app->basePath."/web/avatar/";
        $tmpath="/avatar/";
        if(!empty($_FILES)){
            //得到上传的临时文件流
            $tempFile = $_FILES['myfile']['tmp_name'];
            //允许的文件后缀
            $fileTypes = array('jpg','jpeg','gif','png');

            //得到文件原名
            $fileName = iconv("UTF-8","GB2312",$_FILES["myfile"]["name"]);
            if(false == in_array(substr(strrchr($fileName,"."),1), $fileTypes)){
                die("图片格式不正确!");
            }
            $saveName = Yii::$app->user->getId().'_'.time().'.'.substr(strrchr($fileName,"."),1);
            //最后保存服务器地址
            if(!is_dir($path)){
                mkdir($path);
            }
            if (move_uploaded_file($tempFile, $path.$saveName)){
                $info= $tmpath.$saveName;
            }else{
                $info=$fileName."上传失败！";
            }
            echo $info;
        }
    }

    public function actionCutpic(){
        if(Yii::$app->request->isAjax){
            $imgCrtMap = array('jpg'=>'imagecreatefromjpeg', 'jpeg'=>'imagecreatefromjpeg',
                'png'=>'imagecreatefrompng', 'gif'=>'imagecreatefromgif');
            $imgSaveMap = array('jpg'=>'imagejpeg', 'jpeg'=>'imagejpeg',
                'png'=>'imagepng', 'gif'=>'imagegif');

            $path="/avatar/";
            $targ_w = $targ_h = 300;
            $imgSrc =Yii::$app->request->post('f');
            $imgSrc=Yii::$app->basePath.'/web'.$imgSrc;//真实的图片路径
            $suffix = substr(strrchr($imgSrc,"."),1);
            $img_r = $imgCrtMap[$suffix]($imgSrc);
            $ext=$path.Yii::$app->user->getId().'_'.time().".$suffix";//生成的引用路径
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            imagecopyresampled($dst_r,$img_r,0,0,Yii::$app->request->post('x'),Yii::$app->request->post('y'),
                $targ_w,$targ_h,Yii::$app->request->post('w'),Yii::$app->request->post('h'));
            $img=Yii::$app->basePath.'/web/'.$ext;//真实的图片路径
            if($imgSaveMap[$suffix]($dst_r,$img)){
                unlink($imgSrc);
                $arr['status']=1;
                $arr['data']=$ext;
                $arr['info']='裁剪成功！';
                echo json_encode($arr);

            }else{
                $arr['status']=0;
                echo json_encode($arr);
            }
            exit;
        }
    }

    public function actionExpert()
    {
        return $this->render('expert');
    }

    public function actionLab()
    {
        return $this->render('lab');
    }
}
