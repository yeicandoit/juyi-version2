<?php

namespace backend\controllers;

use backend\models\admin\ExpertSearch;
use backend\models\admin\SellerSearch;
use backend\models\seller\Expert;
use backend\models\seller\ExpertExt;
use backend\models\seller\Seller;
use backend\models\seller\SellerExt;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\admin\LoginForm;
use backend\models\seller\GoodsSearch;
use backend\models\seller\Goods;
use backend\models\seller\Goodscontent;

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
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('goodslist', ['dataProvider'=>$dataProvider]);
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
        return $this->render('goodslist', ['dataProvider'=>$dataProvider]);
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

    public function actionSellerlist()
    {
        $searchModel = new SellerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('sellerlist', ['dataProvider'=>$dataProvider]);
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
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $id = $post['Seller']['id'];
            $shopInfo = Seller::findOne($id);
            if($shopInfo && $shopInfo->load($post) && $shopInfo->save()){
                return $this->redirect(['sellerlist']);
            }
        } else {
            $shopInfo = Seller::findOne($id);
        }
        if(!$shopInfo) {
            return false;
        }
        return $this->render("sellerinfo", ["sellerinfo"=>$shopInfo,]);
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
        return $this->render('expertlist', ['dataProvider'=>$dataProvider]);
    }

    public function actionExpertinfo($id)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $shopInfo = Expert::findOne($id);
            if($shopInfo && $shopInfo->load($post) && $shopInfo->save()){
                return $this->redirect(['expertlist']);
            }
        } else {
            $shopInfo = Expert::findOne($id);
        }
        if(!$shopInfo) {
            return false;
        }
        return $this->render("expertinfo", ["expertinfo"=>$shopInfo,]);
    }
}