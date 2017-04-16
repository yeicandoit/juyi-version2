<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_withdraw".
 *
 * @property string $id
 * @property string $user_id
 * @property string $time
 * @property string $amount
 * @property string $name
 * @property integer $status
 * @property string $note
 * @property string $re_note
 * @property integer $is_del
 *
 * @property ShopUser $user
 */
class ShopWithdraw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_withdraw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'time', 'name', 'amount', 'note'], 'required'],
            [['user_id', 'status', 'is_del'], 'integer'],
            [['time'], 'safe'],
            [['amount'], 'number', 'min'=>0],
            [['name', 'note', 're_note'], 'string', 'max' => 255],
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
            'time' => Yii::t('app', '时间'),
            'amount' => Yii::t('app', '金额'),
            'name' => Yii::t('app', '开户姓名'),
            'status' => Yii::t('app', '-1失败,0未处理,1处理中,2成功'),
            'note' => Yii::t('app', '用户备注'),
            're_note' => Yii::t('app', '回复备注信息'),
            'is_del' => Yii::t('app', '0未删除,1已删除'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function saveWithdraw()
    {
        $this->user_id = Yii::$app->user->id;
        $this->time = date('Y-m-d H:i:s',time());
        return $this->save();
    }
}
