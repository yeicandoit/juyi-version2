<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_account_log".
 *
 * @property string $id
 * @property string $admin_id
 * @property string $user_id
 * @property integer $type
 * @property integer $event
 * @property string $time
 * @property string $amount
 * @property string $amount_log
 * @property string $note
 *
 * @property ShopUser $user
 */
class ShopAccountLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'user_id', 'type', 'event'], 'integer'],
            [['event', 'time', 'amount', 'amount_log'], 'required'],
            [['time'], 'safe'],
            [['amount', 'amount_log'], 'number'],
            [['note'], 'string'],
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
            'admin_id' => Yii::t('app', '管理员ID'),
            'user_id' => Yii::t('app', '用户id'),
            'type' => Yii::t('app', '0增加,1减少'),
            'event' => Yii::t('app', '操作类型，意义请看accountLog类'),
            'time' => Yii::t('app', '发生时间'),
            'amount' => Yii::t('app', '金额'),
            'amount_log' => Yii::t('app', '每次增减后面的金额记录'),
            'note' => Yii::t('app', '备注'),
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
