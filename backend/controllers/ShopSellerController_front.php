<?php

namespace frontend\controllers;

use frontend\models\seller\Expert;
use frontend\models\seller\Seller;
use frontend\models\seller\Favorite;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * ShopSellerController implements the CRUD actions for ShopSeller model.
 */
class ShopSellerController extends Controller
{
    //To enable ajaxupload, set csrf to be false;
    public $enableCsrfValidation = false;
    public $layout = 'mymain-11';
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

   // public function actionExpert($id)
    public function actionExpert($id)
    {
    	$this->layout= "mymain-11";
    	
    	//$request = Yii::$app->request;
    	//$id=$request->post("choosedid");
    	$expert = Expert::findOne($id);
    	$expertInfo = $expert->ext;
    	
    	/*
    	//判断终端类型
    	$is_mobile = null;
    	 
    	if ( isset( $is_mobile ) ) {
    		echo  $is_mobile;
    	}
    	 
    	if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
    		$is_mobile = false;
    	} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
    			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
    			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
    			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
    			|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
    			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
    			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
    		$is_mobile = true;
    	} else {
    		$is_mobile = false;
    	}
    	 
    	
    	if($is_mobile)
    	{
    		$this->layout= "mymain-mobile";
    		
    		return $this->render('expertmobile', ['expert'=>$expert, 'expertInfo'=>$expertInfo]);
    		
    	}
    	else 
    	{   	
    
       			 return $this->render('expert', ['expert'=>$expert, 'expertInfo'=>$expertInfo]);
    	}
*/
        $relatedExperts = $expert->relatedExperts; 	
    	return $this->render('expert', ['expert'=>$expert, 'expertInfo'=>$expertInfo, 'relatedExperts'=>$relatedExperts]);
    	//return $this->render('expert', ['expert'=>$expert, 'expertInfo'=>$expertInfo]);
    	 
    }

    public function actionLab($id)
    {
        $lab = Seller::findOne($id);
        $labInfo = $lab->ext;
        $pages = new Pagination(['totalCount' =>$lab->pageGoods()->count(), 'pageSize' => '12']);
        $model = $lab->pageGoods()->offset($pages->offset)->limit($pages->limit)->all();
        $relatedLabs = $lab->relatedLabs;
        return $this->render('lab', ['lab'=>$lab, 'labInfo'=>$labInfo, 'model'=>$model, 'pages' => $pages, 'relatedLabs'=>$relatedLabs]);
    }

    public function actionFavoriteexpert($id, $type)
    {
        //$type = 0, will not concern; $type = 1, will concern
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }
        if(Favorite::favorite($id, $type, Favorite::CatExpert)){
            echo "OK";
        } else {
            echo "Failed";
        }
    }
    
    public function actionResearch($id)
    {
        $research = Seller::findOne($id);
        $researchInfo = $research->ext;
        //TODO only fix 1000000059's reserve length is too long, will remove this code later.
        if($id == 1000000059 && strlen($researchInfo->reserve1) > 40){
            $researchInfo->reserve1 = substr($researchInfo->reserve1, 0, 61);
        }
        $pages = new Pagination(['totalCount' =>$research->pageGoods()->count(), 'pageSize' => '12']);
        $model = $research->pageGoods()->offset($pages->offset)->limit($pages->limit)->all();
        $relatedLabs = $research->relatedLabs;
        return $this->render('research', ['lab'=>$research, 'labInfo'=>$researchInfo, 'model'=>$model, 'pages' => $pages, 'relatedLabs'=>$relatedLabs]);
    }

    public function actionSimulate($id)
    {
        $simulate = Seller::findOne($id);
        $simulateInfo = $simulate->ext;
        $pages = new Pagination(['totalCount' =>$simulate->pageGoods()->count(), 'pageSize' => '12']);
        $model = $simulate->pageGoods()->offset($pages->offset)->limit($pages->limit)->all();
        $relatedLabs = $simulate->relatedLabs;
        return $this->render('simulate', ['lab'=>$simulate, 'labInfo'=>$simulateInfo, 'model'=>$model, 'pages' => $pages, 'relatedLabs'=>$relatedLabs]);
    }
}
