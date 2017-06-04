<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\admin\LoginForm;
use backend\models\seller\GoodsSearch;
use backend\models\seller\Goods;

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
}