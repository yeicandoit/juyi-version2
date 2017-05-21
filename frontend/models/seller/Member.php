<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property string $user_id
 * @property string $true_name
 * @property string $telephone
 * @property string $mobile
 * @property string $contact_addr
 * @property string $qq
 * @property integer $sex
 * @property string $birthday
 * @property integer $group_id
 * @property integer $exp
 * @property integer $point
 * @property integer $grade
 * @property string $message_ids
 * @property string $time
 * @property string $zip
 * @property integer $status
 * @property string $prop
 * @property string $balance
 * @property string $last_login
 * @property string $custom
 * @property string $email
 * @property string $affliation
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $area
 */
class Member extends \yii\db\ActiveRecord
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
            [['user_id', 'sex', 'group_id', 'exp', 'point', 'grade', 'status', 'country', 'province', 'city', 'area'], 'integer'],
            [['birthday', 'time', 'last_login'], 'safe'],
            [['message_ids', 'prop'], 'string'],
            [['balance'], 'number'],
            [['true_name', 'telephone'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['contact_addr'], 'string', 'max' => 250],
            [['qq'], 'string', 'max' => 15],
            [['zip'], 'string', 'max' => 10],
            [['custom', 'email'], 'string', 'max' => 255],
            [['affliation'], 'string', 'max' => 80],
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
            'contact_addr' => Yii::t('app', '联系地址'),
            'qq' => Yii::t('app', 'QQ'),
            'sex' => Yii::t('app', '性别1男2女'),
            'birthday' => Yii::t('app', '生日'),
            'group_id' => Yii::t('app', '分组'),
            'exp' => Yii::t('app', '经验值'),
            'point' => Yii::t('app', '积分'),
            'grade' => Yii::t('app', '用户评分'),
            'message_ids' => Yii::t('app', '消息ID'),
            'time' => Yii::t('app', '注册日期时间'),
            'zip' => Yii::t('app', '邮政编码'),
            'status' => Yii::t('app', '用户状态 1正常状态 2 删除至回收站 3锁定'),
            'prop' => Yii::t('app', '用户拥有的工具'),
            'balance' => Yii::t('app', '用户余额'),
            'last_login' => Yii::t('app', '最后一次登录时间'),
            'custom' => Yii::t('app', '用户习惯方式,配送和支付方式等信息'),
            'email' => Yii::t('app', 'Email'),
            'affliation' => Yii::t('app', '单位'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
        ];
    }
}
