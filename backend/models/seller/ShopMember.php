<?php

namespace backend\models\seller;

use backend\models\admin\CommendGoods;
use Yii;

/**
 * This is the model class for table "{{%shop_member}}".
 *
 * @property string $id
 * @property integer $shopid
 * @property string $name
 * @property string $password
 */
class ShopMember extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const TYPE_TEST = 'seller';
    const TYPE_EXPERT = 'expert';
    const TYPE_RESEARCH = 'research';
    const TYPE_SIMULATE = 'simulate';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'password', 'regtype'], 'required'],
            [['id'], 'integer'],
            [['username', 'regtype'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '商户id'),
            'username' => Yii::t('app', '用户名'),
            'password' => Yii::t('app', '密码'),
            'regtype' => Yii::t('app', '注册类型'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->authKey;
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
        return true;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getShopInfo()
    {
        if('expert' != $this->regtype){
            return Seller::findOne($this->id);
        } else {
            return Expert::findOne($this->id);
        }

        return false;
    }

    public function getRegtime()
    {
        if('expert' != $this->regtype){
            return Seller::findOne($this->id)->create_time;
        }

        return Expert::findOne($this->id)->regedittime;
    }

    public static function commendType2RegType($type)
    {
        //注册类型：expert, seller, simulate, research
        //推荐类型：1. 热门仪器 2. 热门机构 3. 聚仪专家 4. 热门辅助 5. 热门模拟
        //$type 值不应为2，若为2，当作1 热门仪器处理
        $arr = array(CommendGoods::HotOrganization=>'seller', CommendGoods::HotExpert=>'expert');
        return $arr[$type];
    }
}
