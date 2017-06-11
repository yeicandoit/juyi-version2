<?php
namespace backend\controllers;

use backend\models\model_xyf\JyAbout;
use backend\models\model_xyf\JyForumNote;
use backend\models\model_xyf\JyForumReply;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class XyfController extends Controller
{
    /**
     * @inheritdoc
     */
	public $layout = 'admin';
	//public $enableCsrfValidation = false;
	public function actionIndex()
	{
		return $this->render('index-7');
	}
	public function actionShowTopic(){
        $connection = \Yii::$app->db;
        $request = Yii::$app->request;
        $get = $request->get();
        $bigtype = $request->get('bigtype');
        $subtype = $request->get('subtype');
        $area = $request->get('area');
        $timesort = $request->get('timesort');
        $time= $request->get('time');
        if($bigtype==null && $subtype==null && $area==null && $timesort==null && $time==null) {
            $query = JyForumNote::find();
        }
        if($bigtype!=null) {
            if($bigtype!=4) {
                $query = JyForumNote::find()->where(['bigtype'=>$bigtype]);
            }else {
                $query = JyForumNote::find();
            }
        }
        if ($subtype != null) {
            $query = JyForumNote::find()->where(['subtype' => $subtype]);
        }
        if($area!=null) {
            if($area!=26) {
                $query = JyForumNote::find()->where(['area'=>$area]);
            }else {
                $query = JyForumNote::find();
            }
        }
        if($timesort!=null) {
            $query = JyForumNote::find();
        }
        if($time!=null) {
            if($time!=20) {
                #$sql="SELECT * FROM jy_forum_note where DATE_SUB(CURDATE(), INTERVAL '$time' DAY) <=date(`datetime`)";
                $query = JyForumNote::find();
                $query->where="DATE_SUB(CURDATE(), INTERVAL '$time' DAY) <=date(`datetime`)";
            }else {
                $query = JyForumNote::find();
            }
        }
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $topics = $query->orderBy(['datetime'=>SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('show-topic', [
            'topics' => $topics,
            'pagination' => $pagination,
        ]);
    }
    public function actionCreateTopic()
    {
     //   $this->layout="mymain-9";
        $model = new JyForumNote();
        date_default_timezone_set("Asia/Shanghai");
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 接收参数值并且保存到数据库
            $connection = \Yii::$app->db;
            $model->author="xyf";
            $model->datetime=date("Y-m-d H:i:s");
            $connection->createCommand()->insert('jy_forum_note', [
                'bigtype' => $model->bigtype,
                'subtype' => $model->subtype,
                'area'=> $model->area,
                'title'=>$model->title,
                'detail'=>$model->detail,
                'author'=>$model->author,
                'datetime'=>$model->datetime,
            ])->execute();
           return $this->render('create-topic-success');
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('create-topic', ['model' => $model]);
        }
    }

    public function actionShowTopicDetail(){
      //  $this->layout="mymain-9";
        date_default_timezone_set("Asia/Shanghai");
        $connection = \Yii::$app->db;
        $request = Yii::$app->request;
        $get = $request->get();
        //显示帖子的内容
        $topic_id = $request->get('id');
        $topic = JyForumNote::find()->where(['id' => $topic_id])->one();
        $replies =JyForumReply::find()->where(['topic_id' => $topic_id]);
        //评论分页显示
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $replies->count(),
        ]);
        $replies = $replies->orderBy(['reply_datetime'=>SORT_ASC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        //创建新回复
        $model = new JyForumReply();
        $connection = \Yii::$app->db;
        $model->reply_name="xyf";
        $model->reply_datetime=date("Y-m-d H:i:s");
        $model->topic_id = $topic_id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 接收参数值并且保存到数据库
            $connection = \Yii::$app->db;
            $model->reply_name="xyf";
            $model->reply_datetime=date("Y-m-d H:i:s");
            $connection->createCommand()->insert('jy_forum_reply', [
                'topic_id' => $model->topic_id,
                'reply_name'=>$model->reply_name,
                'reply_detail'=>$model->reply_detail,
                'reply_datetime'=>$model->reply_datetime,
            ])->execute();
            $model = new JyForumReply();
            //$replies =JyForumReply::find()->where(['topic_id' => $topic_id])->all();
            $replies =JyForumReply::find()->where(['topic_id' => $topic_id]);
            //评论分页显示
            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $replies->count(),
            ]);
            $replies = $replies->orderBy(['reply_datetime'=>SORT_ASC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            return $this->render('show-topic-detail', [
                'topic' => $topic,
                'replies'=>$replies,
                'model'=>$model,
                'pagination' => $pagination,
            ]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('show-topic-detail', [
                'topic' => $topic,
                'replies'=>$replies,
                'model'=>$model,
                'pagination' => $pagination,
            ]);
        }
    }
    public function actionReeditTopic(){
      //  $this->layout="mymain-9";
        date_default_timezone_set("Asia/Shanghai");
        $connection = \Yii::$app->db;
        $request = Yii::$app->request;
        $get = $request->get();
        $topic_id = $request->get('id');
        $topic = JyForumNote::find()->where(['id' => $topic_id])->one();
        $model = new JyForumNote();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 接收参数值并且保存到数据库
            $connection = \Yii::$app->db;
            $model->author="xyf";
            $model->datetime=date("Y-m-d H:i:s");
            $bigtype=$model->bigtype;
            $subtype=$model->subtype;
            $area=$model->area;
            $title=$model->title;
            $detail=$model->detail;
            $author=$model->author;
            $datetime=$model->datetime;
            $connection->createCommand("UPDATE jy_forum_note SET bigtype='$bigtype',subtype='$subtype',area='$area',title='$title',detail='$detail',author='$author',datetime='$datetime'WHERE id='$topic_id'")->execute();
            return $this->render('reedit-topic-success');
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('reedit-topic', [
                'topic' => $topic,
                'model'=>$model,
            ]);
        }
    }
    public function actionDeleteTopic()
    {
    //    $this->layout = "mymain-9";
        date_default_timezone_set("Asia/Shanghai");
        $connection = \Yii::$app->db;
        $request = Yii::$app->request;
        $get = $request->get();
        $topic_id = $request->get('id');
        $command = $connection->createCommand("Delete FROM jy_forum_note WHERE id='$topic_id'")->execute();
        $command2 = $connection->createCommand("Delete FROM jy_forum_reply WHERE topic_id='$topic_id'")->execute();
        return $this->render('delete-topic');
    }
    public function actionAdmin()
    {
     //   $this->layout="mymain-9";
        $model= new JySuperadmin();
        $connection = \Yii::$app->db;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据
            if ($model->username == "longyufeng" && $model->password == "longyufeng") {
                return $this->render('bethesuperadmin');
            } else {
                // 无论是初始化显示还是数据验证错误
                return $this->render('login-superadmin', ['model' => $model]);
            }
        }else{
            return $this->render('login-superadmin', ['model' => $model]);
        }
    }
    public function actionUpdateaboutjuyi(){
        $model = JyAbout::findOne(1);
        if($model == null){
            $model = new JyAbout();
        }
        $connection = \Yii::$app->db;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->jyjj!=null){
                $jyjj=$model->jyjj;
                $connection->createCommand("UPDATE jy_about SET jyjj='$jyjj'WHERE id=1")->execute();
            }
            if($model->tsfw!=null){
                $tsfw=$model->tsfw;
                $connection->createCommand("UPDATE jy_about SET tsfw='$tsfw'WHERE id=1")->execute();
            }
            if($model->hzgy!=null){
                $hzgy=$model->hzgy;
                $connection->createCommand("UPDATE jy_about SET hzgy='$hzgy'WHERE id=1")->execute();
            }
            if($model->cpyc!=null){
                $cpyc=$model->cpyc;
                $connection->createCommand("UPDATE jy_about SET cpyc='$cpyc'WHERE id=1")->execute();
            }
            if($model->hyzc!=null){
                $hyzc=$model->hyzc;
                $connection->createCommand("UPDATE jy_about SET hyzc='$hyzc'WHERE id=1")->execute();
            }
            if($model->cslc!=null){
                $cslc=$model->cslc;
                $connection->createCommand("UPDATE jy_about SET cslc='$cslc'WHERE id=1")->execute();
            }
            if($model->zffs!=null){
                $zffs=$model->zffs;
                $connection->createCommand("UPDATE jy_about SET zffs='$zffs'WHERE id=1")->execute();
            }
            if($model->lxkf!=null){
                $lxkf=$model->lxkf;
                $connection->createCommand("UPDATE jy_about SET lxkf='$lxkf'WHERE id=1")->execute();
            }
            if($model->sjzc!=null){
                $sjzc=$model->sjzc;
                $connection->createCommand("UPDATE jy_about SET sjzc='$sjzc'WHERE id=1")->execute();
            }
            if($model->rzlc!=null){
                $rzlc=$model->rzlc;
                $connection->createCommand("UPDATE jy_about SET rzlc='$rzlc'WHERE id=1")->execute();
            }
            if($model->fggf!=null){
                $fggf=$model->fggf;
                $connection->createCommand("UPDATE jy_about SET fggf='$fggf'WHERE id=1")->execute();
            }
            if($model->shtk!=null){
                $shtk=$model->shtk;
                $connection->createCommand("UPDATE jy_about SET shtk='$shtk'WHERE id=1")->execute();
            }
            if($model->tklc!=null){
                $tklc=$model->tklc;
                $connection->createCommand("UPDATE jy_about SET tklc='$tklc'WHERE id=1")->execute();
            }
            if($model->qxdd!=null){
                $qxdd=$model->qxdd;
                $connection->createCommand("UPDATE jy_about SET qxdd='$qxdd'WHERE id=1")->execute();
            }
            if($model->shkf!=null){
                $shkf=$model->shkf;
                $connection->createCommand("UPDATE jy_about SET shkf='$shkf'WHERE id=1")->execute();
            }
            if($model->lxjy!=null){
                $lxjy=$model->lxjy;
                $connection->createCommand("UPDATE jy_about SET lxjy='$lxjy'WHERE id=1")->execute();
            }
            if($model->yjjy!=null){
                $yjjy=$model->yjjy;
                $connection->createCommand("UPDATE jy_about SET yjjy='$yjjy'WHERE id=1")->execute();
            }
            return $this->render('update-aboutjuyisuccess');
        }else{
            return $this->render('updateaboutjuyi',['model'=>$model]);
        }
        return $this->render('updateaboutjuyi');
    }
    public function actionEditaboutjuyi(){
        $model = new JyAbout();
        $connection = \Yii::$app->db;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $connection->createCommand()->insert('jy_about', [
                'jyjj' => $model->jyjj,
                'tsfw' => $model->tsfw,
                'hzgy' => $model->hzgy,
                'cpyc' => $model->cpyc,
                'hyzc' => $model->hyzc,
                'cslc' => $model->cslc,
                'zffs' => $model->zffs,
                'lxkf' => $model->lxkf,
                'sjzc' => $model->sjzc,
                'rzlc' => $model->rzlc,
                'fggf' => $model->fggf,
                'shtk' => $model->shtk,
                'tklc' => $model->tklc,
                'qxdd' => $model->qxdd,
                'shkf' => $model->shkf,
                'lxjy' => $model->lxjy,
                'yjjy' => $model->yjjy,
            ])->execute();
            return $this->render('edit-aboutjuyisuccess');
        }else{
            return $this->render('edit-aboutjuyi',['model'=>$model]);
        }
    }
    public function actionShowaboutjuyi(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("juyijianjie",['all'=>$all]);
        return $this->render("show-aboutjuyi",['all'=>$all]);
    }
    public function actionShowjuyijianjie(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("juyijianjie",['all'=>$all]);
    }
    public function actionShowtesefuwu(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("tesefuwu",['all'=>$all]);
    }
    public function actionShowhezuogongying(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("hezuogongying",['all'=>$all]);
    }
    public function actionShowchengpinyingcai(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("chengpinyingcai",['all'=>$all]);
    }
    public function actionShowhuiyuanzhuce(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("huiyuanzhuce",['all'=>$all]);
    }
    public function actionShowceshiliucheng(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("ceshiliucheng",['all'=>$all]);
    }
    public function actionShowzhifufangshi(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("zhifufangshi",['all'=>$all]);
    }
    public function actionShowlianxikefu(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("lianxikefu",['all'=>$all]);
    }
    public function actionShowshangjiazhuce(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("shangjiazhuce",['all'=>$all]);
    }
    public function actionShowruzhuliucheng(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("ruzhuliucheng",['all'=>$all]);
    }
    public function actionShowfaguiguifan(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("faguiguifan",['all'=>$all]);
    }
    public function actionShowshouhoutiaokuan(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("shouhoutiaokuan",['all'=>$all]);
    }
    public function actionShowtuikuanliucheng(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("tuikuanliucheng",['all'=>$all]);
    }
    public function actionShowquxiaodingdan(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("quxiaodingdan",['all'=>$all]);
    }
    public function actionShowshouhoukefu(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("shouhoukefu",['all'=>$all]);
    }
    public function actionShowlianxijuyi(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("lianxijuyi",['all'=>$all]);
    }
    public function actionShowyijianjianyi(){
        $model=new JyAbout();
        $all = JyAbout::find()->where(['id' => 1])->one();
        return $this->render("yijianjianyi",['all'=>$all]);
    }
}
