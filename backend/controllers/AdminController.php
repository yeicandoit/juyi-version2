<?php

namespace backend\controllers;

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
}