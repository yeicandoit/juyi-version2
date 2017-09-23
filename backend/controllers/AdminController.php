<?php

namespace backend\controllers;

use backend\models\admin\AdManage;
use backend\models\admin\AdManageSearch;
use backend\models\admin\AdPosition;
use backend\models\admin\AdPositionSearch;
use backend\models\admin\AnnounceNewsForm;
use backend\models\admin\AppointinfoSearch;
use backend\models\admin\BrandSearch;
use backend\models\admin\CommendGoods;
use backend\models\admin\CommendGoodsSearch;
use backend\models\admin\ForumNote;
use backend\models\admin\ForumNoteSearch;
use backend\models\admin\ForumReply;
use backend\models\admin\ForumReplySearch;
use backend\models\admin\JyAnnouncement;
use backend\models\admin\JyInformation;
use backend\models\admin\SetInformationForm;
use backend\models\seller\Appointinfo;
use backend\models\seller\Brand;
use backend\models\seller\Comment;
use backend\models\seller\Delivery;
use backend\models\admin\ExpertSearch;
use backend\models\admin\MemberSearch;
use backend\models\admin\SellerSearch;
use backend\models\seller\Expert;
use backend\models\seller\ExpertExt;
use backend\models\seller\GoodsConsult;
use backend\models\seller\GoodsConsultSearch;
use backend\models\seller\Member;
use backend\models\seller\MemberDoctor;
use backend\models\seller\Message;
use backend\models\seller\MessageSearch;
use backend\models\seller\Seller;
use backend\models\seller\SellerExt;
use backend\models\seller\ShopMember;
use backend\models\seller\User;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\admin\LoginForm;
use backend\models\seller\GoodsSearch;
use backend\models\seller\Goods;
use backend\models\seller\Goodscontent;
use backend\models\seller\Order;
use backend\models\seller\OrderSearch;
use backend\models\seller\OrderDelivery;
use backend\models\seller\RefundmentDoc;
use backend\models\seller\GoodService;
use backend\models\seller\RefundmentDocSearch;
use backend\models\seller\Setappointment;
use backend\models\seller\SetappointmentForm;
use backend\models\seller\CommentSearch;
use AlipayConfig;
use AlipayTradeService;
use AlipayTradeRefundContentBuilder;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    //To enable ajaxupload, set csrf to be false;
    public $enableCsrfValidation = false;
    public $layout = 'admin';

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

    public function actionAdminhome()
    {
        $testCnt = ShopMember::find()->where(['regtype'=>'seller'])->count();
        $researchCnt = ShopMember::find()->where(['regtype'=>'research'])->count();
        $simulateCnt = ShopMember::find()->where(['regtype'=>'simulate'])->count();
        $expertCnt = Expert::find()->count();
        $account = Order::getSale(null);
        $testAccount = Order::getSale(null, ShopMember::TYPE_TEST);
        $researchAccount = Order::getSale(null, ShopMember::TYPE_RESEARCH);
        $simulateAccount = Order::getSale(null, ShopMember::TYPE_SIMULATE);
        $expertAccount = Order::getSale(null, ShopMember::TYPE_EXPERT);
        $userCnt = User::find()->count();
        $goodsCnt = Goods::find()->count();
        $goodsTestCnt = Goods::find()->where(['goodtype'=>Goods::TYPE_TEST])->count();
        $goodsResearchCnt = Goods::find()->where(['goodtype'=>Goods::TYPE_RESEARCH])->count();
        $goodsExpertCnt = Goods::find()->where(['goodtype'=>Goods::TYPE_EXPERT])->count();
        $goodsSimulateCnt = Goods::find()->where(['goodtype'=>Goods::TYPE_SIMULATE])->count();
        $orderCnt = Order::find()->count();
        $appointCnt = Appointinfo::find()->count();
        $shopCnt_ = Seller::find()->where(['is_del'=>1])->count();
        $goodsCnt_ = Goods::find()->where(['is_del'=>3])->count();
        $orderCnt_ = $orderCnt - Order::find()->where(['status'=>7])->count();
        $consultCnt_ = GoodsConsult::find()->where(['answer'=>null])->count();
        $refundmentCnt_ = RefundmentDoc::find()->count();

        $summary = array(
            'testCnt' => $testCnt,
            'researchCnt' => $researchCnt,
            'simulateCnt' => $simulateCnt,
            'expertCnt' => $expertCnt,
            'account' => $account,
            'testAccount' => $testAccount,
            'researchAccount' => $researchAccount,
            'expertAccount' => $expertAccount,
            'simulateAccount' => $simulateAccount,
            'userCnt' => $userCnt,
            'goodsCnt' => $goodsCnt,
            'goodsTestCnt' => $goodsTestCnt,
            'goodsResearchCnt' => $goodsResearchCnt,
            'goodsExpertCnt' => $goodsExpertCnt,
            'goodsSimulateCnt' => $goodsSimulateCnt,
            'orderCnt' => $orderCnt,
            'appointCnt' => $appointCnt,
            'shopCnt_' => $shopCnt_,
            'goodsCnt_' => $goodsCnt_,
            'orderCnt_' => $orderCnt_,
            'consultCnt_' => $consultCnt_,
            'refundmentCnt_' => $refundmentCnt_,
        );

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['not in', '{{%order}}.status', [7]])->limit(10);

        return $this->render('adminhome', ['summary'=>$summary, 'dataProvider'=>$dataProvider, 'searchModel'=>$searchModel]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['adminhome']);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['adminhome']);
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }


    public function actionGoodslist()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('goodslist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionGoodsstat($id, $status)
    {
        $goods = Goods::findOne($id);
        if($goods){
            $goods->is_del = $status;
            $goods->save();
        }
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
                if(isset($post['goodsCategory'])){
                    $goods->saveCat($post['goodsCategory']);
                }
                if(isset($post['goodsImgs'])){
                    $goods->saveImgs($post['goodsImgs']);
                }
                if(isset($post['newBrand']) && '' != $post['newBrand']){
                    $goods->saveBrand($post['newBrand'], $goods->goodtype);
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
            return $this->redirect(['goodsedit', 'id'=>$post['Goodscontent']['goodid']]);
        }
    }

    public function actionGoodsseo()
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(isset($post['Goods']['id'])) {
                $good = Goods::findOne($post['Goods']['id']);
                if (null != $good) {
                    $good->load($post);
                    $good->save();
                }
            }
            return $this->redirect(['goodsedit', 'id'=>$post['Goods']['id']]);
        }
    }

    public function actionGoodsadd()
    {
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $goods = new Goods();
            $goods->load($post);
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
                if(isset($post['goodService'])){
                    $goods->saveGoodService($post['goodService']);
                }
                if(isset($post['goodsImgs'])){
                    $goods->saveImgs($post['goodsImgs']);
                }
                if(isset($post['newBrand']) && '' != $post['newBrand']){
                    $goods->saveBrand($post['newBrand'], $goods->goodtype);
                }
                return $this->redirect(['goodslist']);
            }
            return $this->goHome();
        }
        $goods = new Goods();
        $goodsContent = new Goodscontent();
        return $this->render('goodsedit', ['goods'=>$goods, 'goodsContent'=>$goodsContent]);
    }

    public function actionShoplist()
    {
        $searchModel = new SellerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('sellerlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionSellerlist()
    {
        $searchModel = new SellerSearch(['type'=>'seller']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('sellerlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionResearchlist()
    {
        $searchModel = new SellerSearch(['type'=>'research']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('sellerlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionSimulatelist()
    {
        $searchModel = new SellerSearch(['type'=>'simulate']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('sellerlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionSellerstat($id, $status)
    {
        $seller = Seller::findOne($id);
        if($seller){
            $seller->is_del = $status;
            $seller->save();
        }
    }

    public function actionSellerinfo($id)
    {
        $shopInfo = Seller::findOne($id);
        $shopMember = ShopMember::findOne($id);
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($shopInfo && $shopInfo->load($post) && $shopInfo->save()){
                $shopInfo->saveImg();
                if($shopMember){
                    $shopMember->load($post);
                    if(isset($post['ShopMember']['password'])){
                        $shopMember->password = md5($post['ShopMember']['password']);
                    }
                    $shopMember->save();
                }
                $shopInfo->setImage();
                $info = '更新成功!!';
                return $this->render("sellerinfo", ["sellerinfo"=>$shopInfo, 'shopMember'=>$shopMember, 'info'=>$info]);
            }
        }
        if(!$shopInfo) {
            return false;
        }

        $info = '';
        $shopInfo->setImage();
        return $this->render("sellerinfo", ["sellerinfo"=>$shopInfo, 'shopMember'=>$shopMember, 'info'=>$info]);
    }

    public function actionShopdetail($id, $type)
    {
        if('seller' == $type) {
            $shopDetail = SellerExt::find()->where(['seller_id'=>$id])->one();
            if(null == $shopDetail) {
                $shopDetail = new SellerExt();
                $shopDetail->seller_id = $id;
            }
        } else {
            $shopDetail = ExpertExt::find()->where(['expert_id'=>$id])->one();
            if(null == $shopDetail){
                $shopDetail = new ExpertExt();
                $shopDetail->expert_id = $id;
            }
        }
        //The action in the view will contain $id and $type
        if($shopDetail->load(Yii::$app->request->post()) && $shopDetail->save()){
            return $this->redirect(["$type" . 'list']);
        }
        return $this->render("shopdetail", ["detail"=>$shopDetail, 'regtype'=>$type]);
    }

    public function actionExpertlist()
    {
        $searchModel = new ExpertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('expertlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionExpertinfo($id)
    {
        $shopInfo = Expert::findOne($id);
        $shopMember = ShopMember::findOne($id);
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($shopInfo && $shopInfo->load($post) && $shopInfo->save()){
                $shopInfo->saveImg();
                $post = Yii::$app->request->post();
                if(isset($post['expertCategory'])){
                    $shopInfo->saveCat($post['expertCategory']);
                }
                if($shopMember){
                    if(isset($post['ShopMember']['password'])){
                        $shopMember->password = md5($post['ShopMember']['password']);
                    }
                    $shopMember->save();
                }
                $shopInfo->setImage();
                return $this->redirect(["expertinfo", 'id'=>$id]);
            }
        }
        if(!$shopInfo) {
            return false;
        }
        $shopInfo->setImage();
        return $this->render("expertinfo", ["expertinfo"=>$shopInfo, 'shopMember'=>$shopMember]);
    }

    public function actionMemberlist()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('memberlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionMemberinfo($id)
    {
        $memberInfo = Member::findOne($id);
        $doc = null;
        if($memberInfo && Member::TYPE_STUDENT == $memberInfo->type){
            $doc = MemberDoctor::findOne($memberInfo->docid);
        }
        if(Yii::$app->request->isPost){
            if($memberInfo && $memberInfo->load(Yii::$app->request->post()) && $memberInfo->save()){
                return $this->redirect(['memberlist']);
            }
        }
        if(!$memberInfo) {
            return false;
        }


        return $this->render("memberinfo", ["memberinfo"=>$memberInfo,'doc'=>$doc]);
    }
    public function actionOrderlist()
    {   
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('orderlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionOrderok()
    {
        $searchModel = new OrderSearch(['status'=>7]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('orderlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionOrderstay()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['not in', 'jy_order.status', [7]]);
        return $this->render('orderlist', ['dataProvider'=>$dataProvider]);
    }

    public function actionOrderinfo($id)
    {
        if(Yii::$app->request->isPost){
            $order = Order::findOne($id);
            if($order->load(Yii::$app->request->post()) && $order->save()){
                return $this->render('orderinfo', ['order'=>$order]);
            } else {
                return $this->redirect(['orderlist']);
            }
        }
        $order = Order::findOne($id);
        return $this->render('orderinfo', ['order'=>$order]);
    }

    public function actionDelivery()
    {
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
                $order->send_time = date('Y-m-d H:i:s',time());
                $order->save();
                return $this->redirect(['orderinfo', 'id'=>$order->id]);
            }
        }
        return $this->goBack();
    }

    public function actionRefundmentlist()
    {
        $searchModel = new RefundmentDocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('refundment', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionRefundmentinfo($id)
    {
        if(Yii::$app->request->isPost){
            $refundment = RefundmentDoc::findOne($id);
            if($refundment->load(Yii::$app->request->post()) && $refundment->save()){
                return $this->render('refundmentinfo', [ 'refundment'=>$refundment]);
            } else {
                return $this->redirect(['refundmentlist']);
            }
        }

        $refundment = RefundmentDoc::findOne($id);
        return $this->render('refundmentinfo', [ 'refundment'=>$refundment]);
    }

    public function actionRefundment($id)
    {
        $refundment = RefundmentDoc::findOne($id);
        $refundOk = false;

        if($refundment->way == 'origin' && $refundment->order->pay_type == 1){
            $RequestBuilder=new AlipayTradeRefundContentBuilder();
            $RequestBuilder->setOutTradeNo($refundment->order_no);
            $RequestBuilder->setTradeNo('');
            $RequestBuilder->setRefundAmount($refundment->amount);
            $RequestBuilder->setOutRequestNo($refundment->order_id);
            $RequestBuilder->setRefundReason($refundment->reason);

            $aop = new AlipayTradeService(AlipayConfig::$config);
            $response = $aop->Refund($RequestBuilder);
            if(10000 == $response->code){
                $refundOk = true;
            }
        } else if($refundment->way == 'balance' || ($refundment->way == 'origin' && ($refundment->order->pay_type == 0 || $refundment->order->pay_type = 3))) {
            $refundment->refundBalance();
        }
        if($refundOk){
            $refundment->pay_status = RefundmentDoc::REFUND_OK;
            $refundment->dispose_time = $response->gmt_refund_pay;
            $refundment->save();

            $refundment->order->status = 7;
            $refundment->order->completion_time = $refundment->dispose_time;
            if($refundment->amount > 0 && $refundment->amount < $refundment->order->real_amount) {
                $refundment->order->real_amount -= $refundment->amount;
            }
            $refundment->order->save();
        }
        return $this->redirect(['refundmentlist']);
    }

    public function actionAppointlist()
    {
        $searchModel = new AppointinfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('appointlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionSetappointment()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('setappointment', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionEditappointment($id, $status)
    {
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

    public function actionCommentlist()
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('commentlist', [ 'searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionCommentedit($id)
    {
        if(Yii::$app->request->post()){
            $comment = Comment::findOne($id);
            if($comment->load(Yii::$app->request->post()) && $comment->saveRecontents()){
                $this->redirect(['commentlist']);
            } else {
                $this->redirect(['commentlist']);
            }
        }
        $comment = Comment::findOne($id);
        return $this->render('commentedit', [ 'comment'=>$comment]);
    }

    public function actionDelcomment($id)
    {
        $comment = Comment::findOne($id);
        if($comment){
            $comment->delete();
        }
        return $this->redirect(['commentlist']);
    }

    public function actionAccount()
    {
        $startDate = '2017-05-02';
        $endDate = date("Y-m-d");
        $sellerId = null;
        $shopType = null;
        if(Yii::$app->request->isPost){
            $startDate = Yii::$app->request->post('startDate');
            $endDate = Yii::$app->request->post('endDate');
        }
        $countData = Order::sellerAmount($sellerId , $startDate, $endDate, $shopType);
        return $this->render('account', [ 'countData'=>$countData, 'startDate'=>$startDate, 'endDate'=>$endDate]);
    }

    public function actionAccounttype($shopType)
    {
        $startDate = '2017-05-02';
        $endDate = date("Y-m-d");
        $sellerId = null;
        if(Yii::$app->request->isPost){
            $startDate = Yii::$app->request->post('startDate');
            $endDate = Yii::$app->request->post('endDate');
        }
        $countData = Order::sellerAmount($sellerId, $startDate, $endDate, $shopType);
        return $this->render('accounttype', [ 'countData'=>$countData, 'startDate'=>$startDate, 'endDate'=>$endDate,
        'shopType'=>$shopType]);
    }

    public function actionConsultlist()
    {
        $searchModel = new GoodsConsultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('consult', [ 'searchModel'=>$searchModel, 'consult'=>$dataProvider]);
    }

    public function actionConsultstay()
    {
        $searchModel = new GoodsConsultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //TODO This method may be not good, should update it later.
        $dataProvider->query->Where(['answer'=>null]);
        return $this->render('consult', [ 'consult'=>$dataProvider]);
    }

    public function actionConsultinfo($id, $type)
    {
        if(Yii::$app->request->isPost){
            $consult = GoodsConsult::findOne($id);
            if($consult->load(Yii::$app->request->post()) && $consult->save()){
                $this->redirect(['consultlist']);
            } else {
                $this->redirect(['consultlist']);
            }
        }

        $consult = GoodsConsult::findOne($id);
        if('check' == $type) {
            return $this->render('consultinfo', ['consult' => $consult]);
        } elseif('delete' == $type) {
            $consult->del = 1;
            $consult->save();
            $this->redirect(['consultlist']);
        } elseif('restore' == $type) {
            $consult->del = 0;
            $consult->save();
            $this->redirect(['consultlist']);
        }
    }

    public function actionAnnouncenews()
    {
        $model = new AnnounceNewsForm();
        $info="";
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->savenews())
            {
                $info="发布成功，继续发布";
            }
        }
        return $this->render('announcenews', ['model' => $model, 'info' => $info]);
    }

    public function actionManagenews()
    {
        $request = Yii::$app->request;
        $newsid=0;
        $newsid=$request->post("newsid");
        if($newsid)
        {
            $con1=Yii::$app->db->createCommand("DELETE FROM jy_announcement WHERE id = '{$newsid}'")->execute();
        }
        $news=JyAnnouncement::find();
        // var_dump($allnews);
        $pagination = new Pagination(['defaultPageSize' => 20, 'totalCount' => $news->count(),]);
        $allnews = $news->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('managenews', ["allnews" => $allnews, 'pagination' => $pagination,]);
    }
    public function actionChangenews()
    {
        $model = new AnnounceNewsForm();
        $info = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->changenews()) {
                $info = "修改成功，继续修改";
            }
        }
        if (Yii::$app->request->post('postnewsid')) {
            $newsid = Yii::$app->request->post("postnewsid");
            $news = JyAnnouncement::findone($newsid);
            $model->title = $news->title;
            $model->content = $news->content;
            $model->keywords = $news->keywords;
            $model->description = $news->description;
        }
        return $this->render('changenews', ['model' => $model, 'info' => $info, 'news' => $news,]);
    }

    public function actionSetinformation()
    {
        $model=new SetInformationForm();
        $info="";
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->savenews())
            {
                $info="发布成功，继续发布";
            }
        }
        return $this->render('setinformation', ['model' => $model, 'info' => $info]);
    }

    public function actionManageinformation()
    {
        $request = Yii::$app->request;
        $newsid=0;
        $newsid=$request->post("newsid");
        if($newsid)
        {
            $con1=Yii::$app->db->createCommand("DELETE FROM jy_information WHERE id = '{$newsid}'")->execute();
        }
        $news=JyInformation::find();
        // var_dump($allnews);
        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $news->count(),
        ]);
        $allnews = $news->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('manageinformation', ["allnews" => $allnews, 'pagination' => $pagination,]);
    }

    public function actionChangeinformation()
    {
        $model=new SetInformationForm();
        $info="";
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->changenews())
            {
                $info="修改成功，继续修改";
            }
        }
        if(Yii::$app->request->post())
        {
            $newsid=Yii::$app->request->post("newsid");
            $news=JyInformation::findone($newsid);
            $model->title = $news->title;
            $model->content = $news->content;
        }
        return $this->render('changeinformation', ['model' => $model, 'info' => $info, 'news' => $news,]);
    }

    public function actionHot($type = CommendGoods::HotDevice, $info = '')
    {
        $searchModel = new CommendGoodsSearch(['type' => $type]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('hot', ['hot' => $dataProvider, 'type' => $type, 'info'=>$info]);
    }

    public function actionAddhot($type, $hot)
    {
        $info = '';
        if(CommendGoods::HotDevice == $type || CommendGoods::HotHelp == $type || CommendGoods::HotSimulate == $type){
            $good = Goods::find()->where(['goodtype'=>Goods::commendType2GoodType($type), 'goods_no'=>$hot])->one();
            if(null != $good) {
                $cg = CommendGoods::find()->where(['type'=>$type, 'commend_id'=>$good->id])->one();
                if(isset($cg)) {
                    $info = '已经添加过, 不能重复添加';
                } else {
                    $cg = new CommendGoods();
                    $cg->type = $type;
                    $cg->commend_id = $good->id;
                    $cg->add_time = date("Y-m-d H:i:s");;
                    if ($cg->save()){
                        $info = '添加成功';
                    } else {
                        $info = '添加失败！！';
                    }
                }
            } else {
                $info = '商品不存在！！';
            }
        } else if(CommendGoods::HotOrganization == $type || CommendGoods::HotExpert == $type){
            $it = ShopMember::find()->where(['regtype'=>ShopMember::commendType2RegType($type), 'username'=>$hot])->one();
            if(null != $it) {
                $cg = CommendGoods::find()->where(['type'=>$type, 'commend_id'=>$it->id])->one();
                if(isset($cg)) {
                    $info = '已经添加过, 不能重复添加';
                } else {
                    $cg = new CommendGoods();
                    $cg->type = $type;
                    $cg->commend_id = $it->id;
                    if ($cg->save()){
                        $info = '添加成功';
                    } else {
                        $info = '添加失败！！';
                    }
                }
            } else {
                $info = '添加失败！！';
            }
        }
        return $this->redirect(['hot', 'type'=>$type, 'info'=>$info]);
    }

    public function actionDelhot($id, $type)
    {
        $commend = CommendGoods::findOne($id);
        if(null != $commend) {
            $commend->delete();
        }
        return $this->redirect(['hot', 'type'=>$type]);
    }
    public function actionBrandlist()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('brandlist', ['searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionDelbrand($id)
    {
        $brand = Brand::findOne($id);
        if($brand) {
            $brand->delete();
        }
        return $this->redirect(['brandlist']);
    }

    public function actionEditbrand($id)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $id = $post['Brand']['id'];
            $brandInfo = Brand::findOne($id);
            if($brandInfo && $brandInfo->load($post) && $brandInfo->save()){
                return $this->redirect(['brandlist']);
            }
        } else {
            $brandInfo = Brand::findOne($id);
        }
        if(!$brandInfo) {
            return false;
        }

        return $this->render("brand", ["brand"=>$brandInfo]);
    }

    public function actionAddgoodservice($goodId, $service)
    {
        $goodServ = new GoodService();
        $goodServ->goodid = $goodId;
        $goodServ->service = $service;
        $goodServ->type = Goods::findOne($goodId)->goodtype;
        if($goodServ->save()){
            echo $goodServ->id;
        } else {
            echo "Failed";
        }
    }

    public function actionDelgoodservice($id)
    {
        $goodServ = GoodService::findOne($id);
        if($goodServ->delete()){
            echo "OK";
        } else {
            echo "Failed";
        }
    }

    public function actionMessage($id)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $mg = Message::findOne($post['Message']['id']);
            if($mg->load($post) && $mg->save()){
                return $this->redirect(['messagelist']);
            }
        }
        $mg = Message::findOne($id);
        return $this->render('message', ['message' => $mg]);
    }

    public function actionAddmessage()
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $mg = new Message();
            $mg->time = date("Y-m-d H:i:s");
            if($mg->load($post) && $mg->save()){
                return $this->redirect(['messagelist']);
            }
        }
        $mg = new Message();
        return $this->render('message', ['message' => $mg]);
    }

    public function actionDelmessage($id)
    {
        $mg = Message::findOne($id);
        if($mg){
            $mg->delete();
        }
        return $this->redirect(['messagelist']);
    }

    public function actionMessagelist()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('messagelist', [ 'searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionForum()
    {
        $searchModel = new ForumNoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('forum', [ 'searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionForumnoteinfo($id)
    {
        $forumnote = ForumNote::findOne($id);
        $replys = new ForumReplySearch(['topic_id'=>$id]);
        $replylist = $replys->search(Yii::$app->request->queryParams);
        return $this->render('forumnoteinfo', ['forumnote'=>$forumnote, 'replylist'=>$replylist]);
    }

    public function actionDelforumnote($id)
    {
        $forumnote = ForumNote::findOne($id);
        if($forumnote && $forumnote->delete()){
            ForumReply::deleteAll(['topic_id'=>$id]);
        }
        return $this->redirect(['forum']);
    }

    public function actionAdpos()
    {
        $adPos = new AdPosition();
        if(Yii::$app->request->isPost){
            if($adPos->load(Yii::$app->request->post())){
                $adPos->save();
                $info = '添加成功';
                return $this->render('adpos', ['adPos'=>$adPos, 'info'=>$info]);
            }
        }
        $info = null;
        return $this->render('adpos', ['adPos'=>$adPos, 'info'=>$info]);
    }

    public function actionAdposlist()
    {
        $searchModel = new AdPositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('adposlist', [ 'searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionAdposstat($id, $val, $type)
    {
        $adpos = AdPosition::findOne($id);
        $flag = false;
        if($adpos){
            $adpos->$type = $val;
            if($adpos->save()){
                $flag = true;
            }
        }
        if($flag){
            echo 'OK';
        } else {
            echo 'Failed';
        }
    }

    public function actionAd($id = null)
    {
        if(isset($id)){
            $ad = AdManage::findOne($id);
        } else {
            $ad = new AdManage();
        }
        if(Yii::$app->request->isPost){
            if($ad->load(Yii::$app->request->post())){
                $ad->save();
                $info = '添加成功';
                return $this->render('ad', ['ad'=>$ad, 'info'=>$info]);
            }
        }
        $info = null;
        return $this->render('ad', ['ad'=>$ad, 'info'=>$info]);
    }

    public function actionAdlist()
    {
        $searchModel = new AdManageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('adlist', [ 'searchModel'=>$searchModel, 'dataProvider'=>$dataProvider]);
    }

    public function actionDelad($id)
    {
        $ad = AdManage::findOne($id);
        if($ad){
            $ad->delete();
        }
        return $this->redirect(['admin/adlist']);
    }
}
