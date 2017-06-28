<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%seller}}".
 *
 * @property string $id
 * @property string $seller_name
 * @property string $true_name
 * @property string $affliation
 * @property string $affliationtype
 * @property string $login_time
 * @property string $phone
 * @property string $country
 * @property string $email
 * @property string $mobile
 * @property string $server_num
 * @property string $password
 * @property string $paper_img
 * @property string $cash
 * @property string $create_time
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $account
 * @property integer $grade
 * @property integer $comments
 * @property integer $sale
 * @property string $qualification
 * @property string $logo
 * @property integer $sort
 * @property integer $is_lock
 * @property string $tax
 * @property string $seller_message_ids
 * @property integer $is_del
 * @property integer $is_vip
 * @property string $home_url
 */
class Seller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seller}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_name', 'true_name', 'affliation', 'affliationtype', 'login_time', 'phone', 'country', 'mobile', 'server_num', 'password', 'paper_img', 'cash', 'create_time', 'province', 'city', 'area', 'address', 'account', 'qualification'], 'safe'],
            [['login_time', 'create_time'], 'safe'],
            [['country', 'province', 'city', 'area', 'grade', 'comments', 'sale', 'sort', 'is_lock', 'is_del', 'is_vip'], 'integer'],
            [['cash', 'tax'], 'number'],
            [['seller_message_ids'], 'string'],
            [['seller_name', 'true_name', 'affliation'], 'string', 'max' => 80],
            [['affliationtype', 'phone', 'mobile', 'server_num'], 'string', 'max' => 20],
            [['email', 'paper_img', 'address', 'account', 'home_url'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 32],
            [['qualification'], 'string', 'max' => 10],
            [['seller_name'], 'unique'],
            ['logo', 'file','checkExtensionByMimeType'=>false, 'extensions' => 'jpg, png, gif', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'seller_name' => Yii::t('app', '商家登录用户名'),
            'true_name' => Yii::t('app', '商家真实名称'),
            'affliation' => Yii::t('app', '单位名称'),
            'affliationtype' => Yii::t('app', '单位性质'),
            'login_time' => Yii::t('app', '最后登录时间'),
            'phone' => Yii::t('app', '座机号码'),
            'country' => Yii::t('app', '国ID'),
            'email' => Yii::t('app', '电子邮箱'),
            'mobile' => Yii::t('app', '手机号码'),
            'server_num' => Yii::t('app', 'QQ号码'),
            'password' => Yii::t('app', '商家密码'),
            'paper_img' => Yii::t('app', '执照证件照片'),
            'cash' => Yii::t('app', '保证金'),
            'create_time' => Yii::t('app', '加入时间'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'address' => Yii::t('app', '地址'),
            'account' => Yii::t('app', '收款账号信息'),
            'grade' => Yii::t('app', '评分'),
            'comments' => Yii::t('app', '评论次数'),
            'sale' => Yii::t('app', '总销量'),
            'qualification' => Yii::t('app', '资格认证'),
            'logo' => Yii::t('app', 'LOGO图标'),
            'sort' => Yii::t('app', '排序'),
            'is_lock' => Yii::t('app', '0:未锁定,1:已锁定'),
            'tax' => Yii::t('app', '税率'),
            'seller_message_ids' => Yii::t('app', '商户消息ID'),
            'is_del' => Yii::t('app', '0:未删除,1:已删除'),
            'is_vip' => Yii::t('app', '是否是特级商家'),
            'home_url' => Yii::t('app', '企业URL网站'),
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
                    'logo' => [
                        //Use full path, or image\Behavior could not find file path.
                        'savePathAlias' => Yii::$app->basePath . '/web/images/',
                        'width' => 200,
                        'urlPrefix' => Yii::$app->params['imgGlobalPath'] . '/images/',
                        'height' => 200,
                    ],
                ],
            ],
            //other behaviors
        ];
    }

    public function getExt()
    {
        $ext = SellerExt::find()->where(['seller_id'=>$this->id])->one();
        if(!$ext) {
            $ext = new SellerExt();
            $ext->seller_id = $this->id;
            $ext->save();
        };
        return $ext;
    }

    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['seller_id'=>'id']);
    }

    public function pageGoods()
    {
        return Goods::find()->andWhere(['seller_id'=>$this->id]);
    }

    public function getServices()
    {
        return $this->hasMany(ShopService::className(), ['shopid'=>'id']);
    }

    // 获取科研辅助服务类型
    public static function getOptServs()
    {
        return array(
            '试验台加工'=>'试验台加工',
            '仪器维修'=>'仪器维修',
            '仪器租赁'=>'仪器租赁',
            '仪器销售'=>'仪器销售',
            '实验耗材'=>'实验耗材',
        );
    }

    public function saveImg()
    {
        if(isset($this->logo) && strpos($this->logo, '/') == false){
            $this->logo = "images/" . $this->logo; 
        }
        $connection = Yii::$app->db;
        $sql = "update jy_seller set logo = \"$this->logo\" where id = $this->id"; 
        $command=$connection->createCommand($sql);
        $command->execute();

    }

    public function setImage()
    {
        if(isset($this->logo) && strpos($this->logo, '/')){
            // images/<img_name>.jpg, remove 'images/'
            $this->logo = substr($this->logo, 7); 
        } 
    }

    public function getLocation($separator)
    {
        return Areas::findOne($this->province)->area_name . $separator .
        Areas::findOne($this->city)->area_name . $separator .
        Areas::findOne($this->area)->area_name;
    }

    public function getRelatedLabs()
    {
        $sql = "select id from jy_shop_member where regtype = (select regtype from jy_shop_member where id = $this->id) and id != $this->id";
        $idArr = Yii::$app->db->createCommand($sql)->queryAll();
        if($idArr) {
            $labArr = array();
            if(count($idArr) > 3) {
                $idRandArr = array_rand($idArr, 3);
                foreach ($idRandArr as $k=>$v){
                    $labArr[] = Seller::findOne($idArr[$v]['id']);
                }
            } else {
                foreach ($idArr as $k=>$v){
                    $labArr[] = Seller::findOne($v['id']);
                }
            }
            return $labArr;
        }
        return null;
    }
}
