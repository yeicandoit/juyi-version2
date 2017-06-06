<?php

namespace backend\controllers;

use backend\models\seller\Appointinfo;
use backend\models\seller\CategoryExtend;
use backend\models\seller\Delivery;
use backend\models\seller\Expert;
use backend\models\seller\Goods;
use backend\models\seller\GoodsConsult;
use backend\models\seller\GoodsConsultSearch;
use backend\models\seller\Goodscontent;
use backend\models\seller\GoodsPhoto;
use backend\models\seller\GoodsPhotoRelation;
use backend\models\seller\Goodsspec;
use backend\models\seller\OrderDelivery;
use backend\models\seller\Seller;
use backend\models\seller\ShopMember;
use backend\models\seller\Category;
use backend\models\seller\Comment;
use backend\models\seller\CommentSearch;
use backend\models\seller\GoodsSearch;
use backend\models\seller\Order;
use backend\models\seller\RefundmentDoc;
use backend\models\seller\RefundmentDocSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\seller\LoginForm;
use backend\models\seller\OrderSearch;
use backend\models\seller\ExpertregForm;
use backend\models\seller\SellerregForm;
use yii\web\UploadedFile;
use backend\models\seller\Areas;
use backend\models\seller\SetappointmentForm;
use backend\models\seller\Setappointment;
use backend\models\seller\AppointinfoSearch;
use yii\helpers\Html;
use yii\data\Pagination;

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

    //When have logged in as admin, redirect to shop backend view, will meetting some error.
    //shouldLogin will resolve this issue.
    public function shouldLogin()
    {
        if(Yii::$app->user->isGuest){
            return true;
        }
        if(!isset(Yii::$app->params['regtype'])){
            Yii::$app->params['regtype'] = ShopMember::findOne(Yii::$app->user->id)->regtype;
        }
        if((Yii::$app->params['regtype']) != 'seller' && (Yii::$app->params['regtype']) != 'expert'){
            return true;
        }
        return false;
    }

    public function actionSellerhome()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $id = Yii::$app->user->id;
        $goodsCnt = Goods::find()->where(['seller_id'=>$id])->count();
        $commentCnt = Comment::find()->where(['seller_id'=>$id])->count();
        $appointCnt = Appointinfo::find()->joinWith(["good"])->andFilterWhere([ 'jy_goods.seller_id' => Yii::$app->user->id])->count();
        $orderCnt = Order::find()->where(['seller_id'=>$id])->count();
        $refundCnt = RefundmentDoc::find()->where(['seller_id'=>$id])->count();

        $summary = array(
            'goodsCnt' => $goodsCnt,
            'commentCnt' => $commentCnt,
            'appointCnt' => $appointCnt,
            'orderCnt' => $orderCnt,
            'refundCnt' => $refundCnt
        );

        $startDate = ShopMember::findOne(Yii::$app->user->id)->regtime;
        $endDate = date("Y-m-d");
        $countData = Order::sellerAmount(Yii::$app->user->id, $startDate, $endDate);
        return $this->render('sellerhome', ['summary'=>$summary, 'countData'=>$countData]);
    }

    public function actionLogin()
    {
        if(!$this->shouldLogin()) {
            return $this->redirect(['sellerhome']);
        }
        if(!Yii::$app->user->isGuest){ //When have logged in as admin, should log out firstly.
            return $this->redirect(['logout']);
        }
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
        if ($this->shouldLogin()) {
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
        return $this->render("$shopView", ["$shopView"=>$shopInfo, "$shopExtView"=>$shopExt]);
    }

    public function actionShopdetail()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }
        $shopMember = ShopMember::findOne(Yii::$app->user->id);
        $shopDetail = $shopMember->shopInfo->ext;
        if($shopDetail->load(Yii::$app->request->post()) && $shopDetail->save()){
            return $this->redirect(['sellerhome']);
        }
        return $this->render("shopdetail", ["detail"=>$shopDetail, 'regtype'=>$shopMember->regtype]);
    }

    public function actionOrder()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new OrderSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('order', ['dataProvider'=>$dataProvider]);
    }

    public function actionOrderinfo($id)
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $order = Order::findOne($post['Order']['id']);
            if($order->load($post) && $order->save()){
                return $this->render('orderinfo', ['order'=>$order]);
            } else {
                return $this->redirect(['order']);
            }
        }
        $order = Order::findOne($id);
        return $this->render('orderinfo', ['order'=>$order]);
    }

    public function actionDelivery()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $delivery = new Delivery();
            if($delivery->load($post) && $delivery->save()){
                $orderDelivery = new OrderDelivery();
                $orderDelivery->load($post);
                $orderDelivery->deliveryid = $delivery->id;
                $orderDelivery->save();
                $order = Order::findOne($orderDelivery->oderid);
                $order->load($post);
                $order->save();
                return $this->redirect(['orderinfo', 'id'=>$order->id]);
            }
        }
        return $this->goBack();
    }

    public function actionRefundment()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new RefundmentDocSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('refundment', [ 'dataProvider'=>$dataProvider]);
    }

    public function actionRefundmentinfo($id)
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $refundment = RefundmentDoc::findOne($post['RefundmentDoc']['id']);
            if($refundment->load($post) && $refundment->save()){
                return $this->render('refundmentinfo', [ 'refundment'=>$refundment]);
            } else {
                return $this->redirect(['refundment']);
            }
        }

        $refundment = RefundmentDoc::findOne($id);
        return $this->render('refundmentinfo', [ 'refundment'=>$refundment]);
    }

    public function actionComment()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new CommentSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('comment', [ 'dataProvider'=>$dataProvider]);
    }

    public function actionCommentedit($id)
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $comment = Comment::findOne($post['Comment']['id']);
            if($comment->load($post) && $comment->saveRecontents()){
                $this->redirect(['comment']);
            } else {
                $this->redirect(['comment']);
            }
        }
        $comment = Comment::findOne($id);
        return $this->render('commentedit', [ 'comment'=>$comment]);
    }

    public function actionGoodsadd()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
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
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

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

    public function actionGoodsseo()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['Goods']['id'])) {
                $good = Goods::findOne($post['Goods']['id']);
                if (null != $good) {
                    $good->load($post);
                    $good->save();
                }
            }
            return $this->redirect(['goodslist']);
        }
    }

    public function actionGoodscontent()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

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
            unlink(Yii::$app->basePath.'/web/'.$goods->img);
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
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new GoodsSearch(['seller_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('goodslist', ['dataProvider'=>$dataProvider]);
    }

    public function actionGoodsstat($id, $status)
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $goods = Goods::findOne($id);
        if($goods){
            $goods->is_del = $status;
            $goods->save();
        }
        return $this->redirect(['goodslist']);
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

    public function actionCutpic()
    {
        if(Yii::$app->request->isAjax){
            $imgCrtMap = array('jpg'=>'imagecreatefromjpeg', 'jpeg'=>'imagecreatefromjpeg',
                'png'=>'imagecreatefrompng', 'gif'=>'imagecreatefromgif');
            $imgSaveMap = array('jpg'=>'imagejpeg', 'jpeg'=>'imagejpeg',
                'png'=>'imagepng', 'gif'=>'imagegif');

            $path="/goodsImg/";
            $targ_w = $targ_h = Yii::$app->request->post('w');
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
        $pages = new Pagination(['totalCount' =>$lab->pageGoods()->count(), 'pageSize' => '1']);
        $model = $lab->pageGoods()->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('lab', ['lab'=>$lab, 'labInfo'=>$labInfo, 'model'=>$model, 'pages' => $pages]);
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
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new GoodsSearch(['seller_id'=>Yii::$app->user->id, 'is_del'=>0]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('setappointment', ['dataProvider'=>$dataProvider]);
    }

    public function actionEditappointment($id, $status)
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $model = new SetappointmentForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($id = $model->appoint()) {
            } else {
                echo 'there are some wrong';
            }
        }

        $datainfo = Setappointment::find()->where(['goodid' => $id])->all();
        $stat = '添加预约';
        if(2 == $status) {
            $stat = '修改预约';
        }
        $good = Goods::findOne($id);
        return $this->render('editappointment', ['stat'=>$stat, 'good'=>$good, 'model'=>$model, 'datainfo' => $datainfo]);
    }

    public function actionAppointinfo()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new AppointinfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('appointinfo', ['dataProvider'=>$dataProvider]);
    }

    public function actionAccount()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $startDate = '';
        $endDate = '';
        if(Yii::$app->request->isPost){
            $startDate = Yii::$app->request->post('startDate');
            $endDate = Yii::$app->request->post('endDate');
        }
        $countData = Order::sellerAmount(Yii::$app->user->id, $startDate, $endDate);
        return $this->render('account', [ 'countData'=>$countData]);
    }

    public function actionConsult()
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        $searchModel = new GoodsConsultSearch(['sell_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('consult', [ 'consult'=>$dataProvider]);
    }

    public function actionConsultinfo($id)
    {
        if ($this->shouldLogin()) {
            return  $this->redirect(['login']);
        }

        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $consult = GoodsConsult::findOne($post['GoodsConsult']['id']);
            if($consult->load($post) && $consult->save()){
                $this->redirect(['consult']);
            } else {
                $this->redirect(['consult']);
            }
        }

        $consult = GoodsConsult::findOne($id);
        return $this->render('consultinfo', [ 'consult'=>$consult]);
    }
}