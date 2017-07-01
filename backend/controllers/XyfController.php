<?php
namespace backend\controllers;

use backend\models\model_xyf\JyAbout;
use backend\models\model_xyf\JyForumNote;
use backend\models\model_xyf\JyForumReply;
use Yii;
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->render('update-aboutjuyisuccess');
        }else{
            return $this->render('updateaboutjuyi',['model'=>$model]);
        }
        return $this->render('updateaboutjuyi');
    }
}
