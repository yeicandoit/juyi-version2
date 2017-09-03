<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%expert}}".
 *
 * @property string $id
 * @property string $name
 * @property string $true_name
 * @property string $password
 * @property string $regedittime
 * @property string $logintime
 * @property integer $age
 * @property integer $sex
 * @property string $degree
 * @property string $title
 * @property string $mobile
 * @property string $server_num
 * @property string $email
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $address
 * @property string $account
 * @property string $home_url
 * @property string $img
 * @property string $affliation
 * @property string $affliationtype
 * @property integer $grade
 * @property integer $comments
 */
class Expert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expert}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'true_name', 'password', 'regedittime', 'logintime', 'degree', 'mobile', 'server_num', 'email',
                'country', 'province', 'city', 'area', 'address', 'account', 'affliation', 'affliationtype', 'major'], 'safe'],
            [['regedittime', 'logintime'], 'safe'],
            [['age', 'sex', 'country', 'province', 'city', 'area', 'grade', 'comments'], 'integer'],
            [['name', 'true_name', 'degree', 'title', 'major'], 'string', 'max' => 60],
            [['password'], 'string', 'max' => 32],
            [['mobile', 'server_num', 'affliationtype'], 'string', 'max' => 20],
            [['email', 'address', 'account', 'home_url'], 'string', 'max' => 255],
            [['affliation'], 'string', 'max' => 80],
            ['img', 'file','checkExtensionByMimeType'=>false, 'extensions' => 'jpg, png, gif', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'true_name' => Yii::t('app', 'True Name'),
            'password' => Yii::t('app', 'Password'),
            'regedittime' => Yii::t('app', '注册时间'),
            'logintime' => Yii::t('app', '登录时间'),
            'age' => Yii::t('app', 'Age'),
            'sex' => Yii::t('app', 'Sex'),
            'degree' => Yii::t('app', '学历'),
            'title' => Yii::t('app', '职称'),
            'major' => Yii::t('app', '专业'),
            'mobile' => Yii::t('app', 'Mobile'),
            'server_num' => Yii::t('app', 'qq号码'),
            'email' => Yii::t('app', 'Email'),
            'country' => Yii::t('app', 'Country'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'area' => Yii::t('app', 'Area'),
            'address' => Yii::t('app', 'Address'),
            'account' => Yii::t('app', '帐号信息'),
            'home_url' => Yii::t('app', '个人网址'),
            'img' => Yii::t('app', '头像'),
            'affliation' => Yii::t('app', '单位'),
            'affliationtype' => Yii::t('app', '单位性质'),
            'grade' => Yii::t('app', '评分'),
            'comments' => Yii::t('app', '评论次数'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \maxmirazh33\image\Behavior::className(),
                'savePathAlias' => Yii::$app->basePath . '/web/images/',
                'urlPrefix' => '/images/',
                'crop' => true,
                'attributes' => [
                    'img' => [
                        //Use full path, or image\Behavior could not find file path.
                        'savePathAlias' => Yii::$app->basePath . '/web/images/',
                        'urlPrefix' => Yii::$app->params['imgGlobalPath'] . '/images/',
                        'width' => 150,
                        'height' => 200,
                    ],
                ],
            ],
            //other behaviors
        ];
    }

    public function getExt()
    {
        $ext = ExpertExt::find()->where(['expert_id'=>$this->id])->one();
        if(!$ext) {
            $ext = new ExpertExt();
            $ext->expert_id = $this->id;
            $ext->save();
        };
        return $ext;
    }

    public function getLocation($separator)
    {
        return Areas::findOne($this->province)->area_name . $separator .
        Areas::findOne($this->city)->area_name . $separator .
        Areas::findOne($this->area)->area_name;
    }

    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['seller_id'=>'id']);
    }

    public function getServices()
    {
        return $this->hasMany(ShopService::className(), ['shopid'=>'id']);
    }

    public static function getOptServs()
    {
        return array(
            '图谱/数据解析'=>'图谱/数据解析',
            '技术服务'=>'技术服务',
            '专利/技术转让'=>'专利/技术转让',
            '技术入股'=>'技术入股',
            '委托开发'=>'委托开发',
        );
    }

    public function saveImg()
    {
        if(isset($this->img) && strpos($this->img, '/') == false){
            $this->img = "images/" . $this->img; 
        }
        $connection = Yii::$app->db;
        $sql = "update jy_expert set img = \"$this->img\" where id = $this->id"; 
        $command=$connection->createCommand($sql);
        $command->execute();
    }

    public function setImage()
    {
        if(isset($this->img) && strpos($this->img, '/')){
            // images/<img_name>.jpg, remove 'images/'
            $this->img = substr($this->img, 7); 
        } 
    }

    public function getRelatedExperts()
    {
        $sql = "select id from jy_expert where id != $this->id";
        $idArr = Yii::$app->db->createCommand($sql)->queryAll();
        if($idArr) {
            $expertArr = array();
            if(count($idArr) > 5) {
                $idRandArr = array_rand($idArr, 5);
                foreach ($idRandArr as $k=>$v){
                    $expertArr[] = Expert::findOne($idArr[$v]['id']);
                }
            } else {
                foreach ($idArr as $k=>$v){
                    $expertArr[] = Expert::findOne($v['id']);
                }
            }
            return $expertArr;
        }
        return null;
    }

    public function hasConcened()
    {
        if(Yii::$app->user->isGuest){
            return false;
        }
        if(Favorite::find()->where(['user_id'=>Yii::$app->user->id, 'rid'=>$this->id, 'cat_id'=>Favorite::CatExpert])->one()){
            return true;
        } else {
            return false;
        }
    }
}
