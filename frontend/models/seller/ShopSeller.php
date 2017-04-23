<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "shop_seller".
 *
 * @property string $id
 * @property string $seller_name
 * @property string $password
 * @property string $create_time
 * @property string $login_time
 * @property integer $is_vip
 * @property integer $is_del
 * @property integer $is_lock
 * @property string $true_name
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $paper_img
 * @property string $cash
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $account
 * @property string $server_num
 * @property string $home_url
 * @property integer $sort
 * @property string $tax
 * @property string $seller_message_ids
 * @property integer $grade
 * @property integer $sale
 * @property integer $comments
 *
 * @property ShopBill[] $shopBills
 * @property ShopDeliveryExtend[] $shopDeliveryExtends
 */
class ShopSeller extends \yii\db\ActiveRecord
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
            //[['seller_name', 'password', 'true_name', 'mobile', 'phone', 'province', 'city', 'area', 'address'], 'required'],
            [['create_time', 'login_time'], 'safe'],
            [['is_vip', 'is_del', 'is_lock', 'country', 'province', 'city', 'area', 'sort', 'grade', 'sale', 'comments'], 'integer'],
            [['cash', 'tax'], 'number'],
            [['account', 'seller_message_ids'], 'string'],
            [['seller_name', 'true_name'], 'string', 'max' => 80],
            [['password'], 'string', 'max' => 32],
            [['email', 'paper_img', 'address', 'home_url'], 'string', 'max' => 255],
            [['mobile', 'phone', 'server_num'], 'string', 'max' => 20],
            [['seller_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'seller_name' => Yii::t('app', '登录用户名'),
            'password' => Yii::t('app', '密码'),
            'create_time' => Yii::t('app', '加入时间'),
            'login_time' => Yii::t('app', '最后登录时间'),
            'is_vip' => Yii::t('app', '是否是特级商家'),
            'is_del' => Yii::t('app', '0:未删除,1:已删除'),
            'is_lock' => Yii::t('app', '0:未锁定,1:已锁定'),
            'true_name' => Yii::t('app', '商家真实名称'),
            'email' => Yii::t('app', '电子邮箱'),
            'mobile' => Yii::t('app', '手机号码'),
            'phone' => Yii::t('app', '座机号码'),
            'paper_img' => Yii::t('app', '执照证件照片'),
            'cash' => Yii::t('app', '保证金'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'address' => Yii::t('app', '地址'),
            'account' => Yii::t('app', '收款账号信息'),
            'server_num' => Yii::t('app', '客服号码'),
            'home_url' => Yii::t('app', '企业URL网站'),
            'sort' => Yii::t('app', '排序'),
            'tax' => Yii::t('app', '税率'),
            'seller_message_ids' => Yii::t('app', '商户消息ID'),
            'grade' => Yii::t('app', '评分总数'),
            'sale' => Yii::t('app', '总销量'),
            'comments' => Yii::t('app', '评论次数'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopBills()
    {
        return $this->hasMany(ShopBill::className(), ['seller_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryExtends()
    {
        return $this->hasMany(ShopDeliveryExtend::className(), ['seller_id' => 'id']);
    }

    public function getExpertInfo()
    {
        return $this->hasOne(ExpertInfo::className(), ['seller_id' => 'id']);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;

    }
}
