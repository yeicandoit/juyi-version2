<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_address".
 *
 * @property string $id
 * @property string $user_id
 * @property string $accept_name
 * @property string $zip
 * @property string $telphone
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $mobile
 * @property integer $is_default
 *
 * @property ShopUser $user
 */
class ShopAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'accept_name', 'province', 'city', 'area', 'address'], 'required'],
            [['user_id', 'country', 'province', 'city', 'area', 'is_default'], 'integer'],
            [['accept_name', 'telphone', 'mobile'], 'string', 'max' => 20],
            [['zip'], 'string', 'max' => 6],
            [['address'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', '用户ID'),
            'accept_name' => Yii::t('app', '收货人姓名'),
            'zip' => Yii::t('app', '邮编'),
            'telphone' => Yii::t('app', '联系电话'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'address' => Yii::t('app', '收货地址'),
            'mobile' => Yii::t('app', '手机'),
            'is_default' => Yii::t('app', '是否默认,0:为非默认,1:默认'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
