<?php

namespace frontend\controllers;

use frontend\models\seller\CategoryExtend;
use frontend\models\seller\Expert;
use frontend\models\seller\ExpertExt;
use frontend\models\seller\Goods;
use frontend\models\seller\Goodscontent;
use frontend\models\seller\GoodsPhoto;
use frontend\models\seller\GoodsPhotoRelation;
use frontend\models\seller\Goodsspec;
use frontend\models\seller\Seller;
use frontend\models\seller\SellerExt;
use frontend\models\seller\ShopMember;
use frontend\models\seller\ShopMerchShipInfo;
use frontend\models\seller\Category;
use frontend\models\seller\Comment;
use frontend\models\seller\CommentSearch;
use frontend\models\Seller\GoodsSearch;
use frontend\models\ShopOrder;
use frontend\models\ShopOrderGoods;
use frontend\models\seller\RefundmentDoc;
use frontend\models\seller\RefundmentDocSearch;
use Yii;
use frontend\models\seller\ShopDeliverySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\seller\LoginForm;
use frontend\models\seller\SellerMenu;
use frontend\models\seller\ShopMerchShipInfoSearch;
use frontend\models\ShopOrderSearch;
use frontend\models\seller\ExpertregForm;
use frontend\models\seller\SellerregForm;
use yii\web\UploadedFile;
use frontend\models\seller\Areas;
use frontend\models\seller\SetappointmentForm;
use frontend\models\seller\Setappointment;
use yii\helpers\Html;

/**
 * ShopSellerController implements the CRUD actions for ShopSeller model.
 */
class ShopSellerController extends Controller
{
    //To enable ajaxupload, set csrf to be false;
    public $enableCsrfValidation = false;
    public $layout = 'shop';
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
        if (Yii::$app->user->isGuest) {
            return  $this->redirect(['login']);
        }
        return $this->render('sellerhome');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['sellerhome']);
        }
        return $this->render('login', ['model'=>$model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

    public function actionShopinfo()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect(['login']);
        }
        $shopMember = ShopMember::findOne(Yii::$app->user->id);
        $shopInfo = $shopMember->shopInfo;
        $shopView = $shopMember->regtype . "info";
        $shopExt = $shopInfo->ext;
        $shopExtView = $shopMember->regtype . "ext";
        if(!$shopInfo) {
            return false;
        }

        if($shopInfo->load(Yii::$app->request->post()) && $shopInfo->save()){
            return $this->redirect(['sellerhome']);
        }
        //return $this->render("$shopView", ['menu'=>SellerMenu::getMenu(), "$shopView"=>$shopInfo]);
        return $this->render("$shopView", ["$shopView"=>$shopInfo, "$shopExtView"=>$shopExt]);
    }

    public function actionExpertext()
    {
        $expertext = ExpertExt::find()->where(['expert_id'=> Yii::$app->user->id])->one();
        if($expertext->load(Yii::$app->request->post()) && $expertext->save()){
            return $this->redirect(['sellerhome']);
        }
        return $this->goBack();
    }

    public function actionSellerext()
    {
        $sellerext = SellerExt::find()->where(['seller_id'=> Yii::$app->user->id])->one();
        if($sellerext->load(Yii::$app->request->post()) && $sellerext->save()){
            return $this->redirect(['sellerhome']);
        }
        return $this->goBack();
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
        $searchModel = new RefundmentDocSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('refundment', [ 'dataProvider'=>$dataProvider]);
    }

    public function actionRefundmentinfo($id){
        $refundment = RefundmentDoc::findOne($id);
        return $this->render('refundmentinfo', [ 'refundment'=>$refundment]);
    }

    public function actionComment()
    {
        $searchModel = new CommentSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('comment', [ 'dataProvider'=>$dataProvider]);
    }

    public function actionCommentedit($id)
    {
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $comment = Comment::findOne($post['ShopComment']['id']);
            if($comment->load($post) && $comment->saveRecontents()){
                $this->redirect(['comment']);
            } else {
                $this->goBack();
            }
        }
        $comment = Comment::findOne($id);
        return $this->render('commentedit', [ 'comment'=>$comment]);
    }

    public function actionGoodsadd()
    {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $goods = new Goods();
            $goods->load($post);
            $goods->seller_id = Yii::$app->user->id;
            $goods->create_time = date('Y-m-d H:i:s',time());
            $goods->sort = isset($goods->sort) ? $goods->sort : 10;
            $goods->is_del = 3;
            if($goods->save()){
                if(isset($post['specName'])){
                    $goods->saveSpec($post['specName'], $post['specMktPrice'], $post['specSellPrice']);
                }
                if(isset($post['goodsCategory'])){
                    $goods->saveCat($post['goodsCategory']);
                }
                if(isset($post['goodsImgs'])){
                    $goods->saveImgs($post['goodsImgs']);
                }
                return $this->redirect(['goodslist']);
            }
            return $this->goHome();
        }
        $goods = new Goods();
        $goodsContent = new Goodscontent();
        return $this->render('goodsedit', ['goods'=>$goods, 'goodsContent'=>$goodsContent]);
    }

    public function actionGoodsedit($id)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $goods = Goods::findOne($post['Goods']['id']);
            $goods->load($post);
            if($goods->save()){
                if(isset($post['specName'])){
                    $goods->saveSpec($post['specName'], $post['specMktPrice'], $post['specSellPrice']);
                }
                if(isset($post['goodsImgs'])){
                    $goods->saveImgs($post['goodsImgs']);
                }
                return $this->redirect(['goodslist']);
            }
            return $this->goBack();
        }
        $goods = Goods::findOne($id);
        $goodsContent = Goodscontent::find()->where(['goodid'=>$id])->one();
        if($goodsContent == null) {
            $goodsContent = new Goodscontent();
        }
        return $this->render('goodsedit', ['goods'=>$goods, 'goodsContent'=>$goodsContent]);
    }

    public function actionGoodscontent()
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['Goodscontent']['goodid'])) {
                $goodsContent = Goodscontent::find()->where(['goodid' => $post['Goodscontent']['goodid']])->one();
                if (null == $goodsContent) {
                    $goodsContent = new Goodscontent();
                }
                $goodsContent->load($post);
                $goodsContent->save();
            }
            return $this->redirect(['goodslist']);
        }
    }

    public function actionGoodscategory()
    {
        $data = Category::find()->asArray()->all();
        $idname = ArrayHelper::map($data, 'id', 'name');
        $idmap = ArrayHelper::map($data, 'id', 'parent_id');
        return $this->renderAjax('goodscat', ['idname'=>$idname, 'idmap'=>$idmap]);
    }

    public function actionDelcat($goodsId, $catId)
    {
        $catExt = CategoryExtend::find()->where(['goods_id'=>$goodsId, 'category_id'=>$catId])->one();
        if($catExt->delete()){
            echo "OK";
        } else {
            echo "Failed";
        }
    }

    public function actionDelimg($goodsId, $photoId)
    {
        $photo = GoodsPhoto::findOne($photoId);
        $goodsPhotoRelation = GoodsPhotoRelation::find()->where(['goods_id'=>$goodsId, 'photo_id'=>$photoId])->one();
        $goods = Goods::findOne($goodsId);
        //If delete default img, set goods->img to be null
        if($goods->img == $photo->img){
            $goods->img = null;
            $goods->save();
        }
        if($photo->delete() && $goodsPhotoRelation->delete()){
            echo 'OK';
        } else {
            echo 'Failed';
        }
    }

    public function actionAddcat($goodsId, $catId)
    {
        $catExt = new CategoryExtend();
        $catExt->goods_id = $goodsId;
        $catExt->category_id = $catId;
        if($catExt->save()){
            echo "OK";
        } else {
            echo "Failed";
        }
    }

    public function actionDelspec($goodsId, $specName)
    {
        $spec = Goodsspec::find()->where(['goodsid'=>$goodsId, 'specname'=>$specName])->one();
        if($spec->delete()){
            echo "OK";
        } else {
            echo "Failed";
        }
    }

    public function actionGoodslist()
    {
        $searchModel = new GoodsSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('goodslist', ['dataProvider'=>$dataProvider]);
    }

    public function actionGoodsstat($id, $status)
    {
        $goods = Goods::findOne($id);
        if($goods){
            $goods->is_del = $status;
            $goods->save();
        }
        return $this->redirect(['goodslist']);
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

            $path="/goodsImg/";
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

    public function actionExpert($id)
    {
        $expert = Expert::findOne($id);
        $expertInfo = $expert->ext;
        return $this->render('expert', ['expert'=>$expert, 'expertInfo'=>$expertInfo]);
    }

    public function actionLab($id)
    {
        $lab = Seller::findOne($id);
        $labInfo = $lab->ext;
        return $this->render('lab', ['lab'=>$lab, 'labInfo'=>$labInfo]);
    }

    public function actionExpertreg()
    {
        $model = new ExpertregForm();
        if($model->load(Yii::$app->request->post())){
            if($model->register()) {
                return $this->redirect(['sellerhome']);
            }
        }
        return $this->render('expertreg', [
            'model' => $model,
        ]);
    }

    public function actionSellerreg()
    {
        $model = new SellerregForm();
        if($model->load(Yii::$app->request->post())){
            $model->file = UploadedFile::getInstance($model, 'file');
            $upSec = $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);

            if($upSec && $model->register()) {
                return $this->redirect(['sellerhome']);
            }
        }
        return $this->render('sellerreg', [
            'model' => $model,
        ]);
    }

    public function actionAreas($id)
    {
        $data = ArrayHelper::map(Areas::find()->where(['parent_id'=>$id])->asArray()->all(),'area_id','area_name');
        foreach($data as $value=>$name)
        {
            echo Html::tag('option',Html::encode($name),array('value'=>$value));
        }
    }

    public function actionSetappointment()
    {
        $model = new SetappointmentForm();
        $hintinfo = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($id = $model->appoint()) {
                $datainfo = Setappointment::find()->where(['goodid' => $id])->all();
                $hintinfo = "预约设定成功，如需要请继续设定";
                return $this->render('setappointment1', [
                    'model' => $model,
                    'hintinfo' => $hintinfo,
                    'datainfo' => $datainfo,
                ]);
            } else {
                echo "there are some wrong";
            }
        } else {
            return $this->render('setappointment', [
                'model' => $model,
                'hintinfo' => $hintinfo,
            ]);
        }
    }
}
