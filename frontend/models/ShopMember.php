<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_member".
 *
 * @property string $user_id
 * @property string $true_name
 * @property string $telephone
 * @property string $mobile
 * @property string $area
 * @property string $contact_addr
 * @property string $qq
 * @property integer $sex
 * @property string $birthday
 * @property integer $group_id
 * @property integer $exp
 * @property integer $point
 * @property string $message_ids
 * @property string $time
 * @property string $zip
 * @property integer $status
 * @property string $prop
 * @property string $balance
 * @property string $last_login
 * @property string $custom
 * @property string $email
 *
 * @property ShopUser $user
 */
class ShopMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'sex', 'group_id', 'exp', 'point', 'status'], 'integer'],
            [['birthday', 'time', 'last_login'], 'safe'],
            [['message_ids', 'prop'], 'string'],
            [['balance'], 'number'],
            [['true_name', 'telephone'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['area', 'custom', 'email'], 'string', 'max' => 255],
            [['contact_addr'], 'string', 'max' => 250],
            [['qq'], 'string', 'max' => 15],
            [['zip'], 'string', 'max' => 10],
            //[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', '用户ID'),
            'true_name' => Yii::t('app', '真实姓名'),
            'telephone' => Yii::t('app', '联系电话'),
            'mobile' => Yii::t('app', '手机'),
            'area' => Yii::t('app', '地区'),
            'contact_addr' => Yii::t('app', '联系地址'),
            'qq' => Yii::t('app', 'QQ'),
            'sex' => Yii::t('app', '性别1男2女'),
            'birthday' => Yii::t('app', '生日'),
            'group_id' => Yii::t('app', '分组'),
            'exp' => Yii::t('app', '经验值'),
            'point' => Yii::t('app', '积分'),
            'message_ids' => Yii::t('app', '消息ID'),
            'time' => Yii::t('app', '注册日期时间'),
            'zip' => Yii::t('app', '邮政编码'),
            'status' => Yii::t('app', '用户状态 1正常状态 2 删除至回收站 3锁定'),
            'prop' => Yii::t('app', '用户拥有的工具'),
            'balance' => Yii::t('app', '用户余额'),
            'last_login' => Yii::t('app', '最后一次登录时间'),
            'custom' => Yii::t('app', '用户习惯方式,配送和支付方式等信息'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
