<?php

namespace frontend\controllers;

use frontend\models\ShopAccountLogSearch;
use frontend\models\ShopAddress;
use frontend\models\ShopFavorite;
use frontend\models\ShopFavoriteSearch;
use frontend\models\ShopMember;
use frontend\models\ShopOrder;
use frontend\models\ShopProp;
use frontend\models\ShopWithdraw;
use frontend\models\ShopWithdrawSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\LoginForm;
use frontend\models\RegisterForm;
use frontend\models\ShopregForm;
use frontend\models\ContactForm;
use frontend\models\EntryForm;
use frontend\models\GlobalRegion;
use frontend\models\ShopAreas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\models\UserMenu;
use frontend\models\UserDetailForm;
use frontend\models\ShopPointLogSearch;
use frontend\models\ShopAddressSearch;
use frontend\models\ShopOrderSearch;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'mymain-9';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'height' => 40,
                'width' => 80,
                'maxLength' => 5,
                'minLength' => 4,
                'offset' => -1,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout="mymain-9";
        return $this->render('index-7');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('userhome', ['menu'=>UserMenu::getMenu()]);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goHome();
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = "Hello")
    {
        return $this->render('say', ['msg' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据

            // 做些有意义的事 ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionAreas($id)
    {
        //$id = Yii::$app->request->get( 'id' );
        $data = ArrayHelper::map(ShopAreas::find()->where(['parent_id'=>$id])->asArray()->all(),'area_id','area_name');
        //echo Yii::$app->urlManager->createUrl('/site/area');
        foreach($data as $value=>$name)
        {
            echo Html::tag('option',Html::encode($name),array('value'=>$value));
        }
    }

    public function actionUserhome()
    {
        return $this->render('userhome', ['menu'=>UserMenu::getMenu()]);
    }

    public function actionUserscore()
    {
        $searchModel = new ShopPointLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('userscore', ['menu'=>UserMenu::getMenu(),
            'userscore'=>new UserDetailForm(UserDetailForm::ViewScore),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUserfavorite()
    {
        $searchModel = new ShopFavoriteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userfavorite', ['menu'=>UserMenu::getMenu(),'dataProvider' => $dataProvider]);
    }

    public function actionUseraddsmy($id, $summary)
    {
        //$userFav = ShopFavorite::findOne(['user_id'=>Yii::$app->user->id, 'id'=>$id]);
        $userFav = ShopFavorite::findOne($id);
        $userFav->summary = $summary;
        if($userFav->save()) {
            echo "OK";
        } else {
            echo "FAILED";
        }
    }

    public function actionUserfvdel($id)
    {
        $userfvdel = ShopFavorite::findOne($id);
        if($userfvdel) {
            $userfvdel->delete();
        }
        return $this->redirect(['userfavorite']);
    }

    public function actionUseraddr()
    {
        $searchModel = new ShopAddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $useraddr = new UserDetailForm(UserDetailForm::ViewAddr);
        if($useraddr->load(Yii::$app->request->post()) && $useraddr->saveAccetpAddr()){
            return $this->redirect(['useraddr']);
        }
        return $this->render('useraddr', ['menu'=>UserMenu::getMenu(),'dataProvider' => $dataProvider, 'useraddr'=>$useraddr]);
    }

    //edit user accept address.
    public function actionUseraddrup($id)
    {
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $useraddrup = ShopAddress::findOne($post['ShopAddress']['id']);
            if($useraddrup->load($post) && $useraddrup->save()){
                return $this->redirect(['useraddr']);
            }
        } else {
            $useraddrup = ShopAddress::findOne($id);
            return $this->render('useraddrup', ['menu'=>UserMenu::getMenu(), 'useraddrup'=>$useraddrup]);
        }

    }

    public function actionUseraddrdel($id)
    {

         $useraddrdel = ShopAddress::findOne($id);
         if($useraddrdel) {
             $useraddrdel->delete();
         }
        return $this->redirect(['useraddr']);
    }

    public function actionUseraddrdf($id)
    {
        $useraddr = ShopAddress::findOne($id);
        if($useraddr->is_default == 0) {
            ShopAddress::updateAll(['is_default' => 0], 'user_id=:id', [':id' => Yii::$app->user->id]);
            $useraddr->is_default = 1;
            $useraddr->save();
        } else {
            $useraddr->is_default = 0;
            $useraddr->save();
        }
        return $this->redirect(['useraddr']);
    }

    public function actionUserchpwd()
    {
        $userpwd = new UserDetailForm(UserDetailForm::ViewChpwd);
        if ($userpwd->load(Yii::$app->request->post()) && $userpwd->saveNewpwd()) {
            return $this->goHome();
        }
        return $this->render('userchpwd', ['menu'=>UserMenu::getMenu(), 'userpwd'=>$userpwd]);
    }

    public function actionUserinfo()
    {
        $userinfo = new UserDetailForm(UserDetailForm::ViewInfo);
        if($userinfo->load(Yii::$app->request->post()) && $userinfo->saveInfo()) {
            return $this->goHome();
        }
        return $this->render('userinfo', ['menu'=>UserMenu::getMenu(), 'userinfo'=>$userinfo]);
    }

    public function actionUserrecom()
    {
        return $this->render('userrecom', ['menu'=>UserMenu::getMenu(), 'model'=>new UserDetailForm('')]);
    }

    public function actionUseraccount()
    {
        $searchAccount = new ShopAccountLogSearch();
        $paramsAccount = Yii::$app->request->queryParams;
        if(!isset($params['sort'])) {
            $params['sort'] = '-time';
        }
        $dataAccount = $searchAccount->search($paramsAccount);

        $member = ShopMember::findOne(Yii::$app->user->id);

        $searchWithdraw = new ShopWithdrawSearch();
        $dataWithdraw = $searchWithdraw->search([]);


        $withdraw = new ShopWithdraw();
        if($withdraw->load(Yii::$app->request->post()) && $withdraw->saveWithdraw()){
            return $this->redirect(['useraccount']);
        }

        return $this->render(
            'useraccount',
            [
                'menu'=>UserMenu::getMenu(),
                'member'=>$member,
                'dataAccount' => $dataAccount,
                'dataWithdraw' => $dataWithdraw,
                'withdraw'=>$withdraw,
            ]
        );
    }

    public function actionUserorder()
    {
        $searchModel = new ShopOrderSearch(['user_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('userorder', ['menu'=>UserMenu::getMenu(), 'dataProvider' => $dataProvider]);
    }

    public function actionUserorderinfo($id)
    {
        $order = ShopOrder::find()->where(['id'=>$id, 'user_id'=>Yii::$app->user->id])->one();
        if ($order) {
            return $this->render('userorderinfo', ['menu' => UserMenu::getMenu(), 'order' => $order]);
        } else {
            return $this->goBack();
        }
    }

    public function actionUserorderop($id, $op)
    {
        $order = ShopOrder::find()->where(['id'=>$id, 'user_id'=>Yii::$app->user->id])->one();
        if (null == $order) {
            return $this->goBack();
        }
        if($op == 'cancel'){
            if(0 == $order->distribution_status && 1 == $order->status){
                $order->status = 3;
                if($order->save() && 0 == $order->pay_status && $order->prop) {
                    $prop = ShopProp::findOne($order->prop);
                    $prop->is_close = 0;
                    $prop->save();
                }
            }
        } else if($op == 'confirm'){
            $order->status = 5;
            $order->completion_time = date('Y-m-d H:i:s',time());
            if(1 == $order->distribution_status && $order->save()) {
                $this->redirect(['evaluation']);
            }
        }
       return $this->redirect(['userorderinfo', 'id'=>$id]);
    }
}
