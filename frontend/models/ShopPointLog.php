<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_point_log".
 *
 * @property string $id
 * @property string $user_id
 * @property string $datetime
 * @property integer $value
 * @property string $intro
 *
 * @property ShopUser $user
 */
class ShopPointLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_point_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'datetime', 'value', 'intro'], 'required'],
            [['user_id', 'value'], 'integer'],
            [['datetime'], 'safe'],
            [['intro'], 'string', 'max' => 50],
            //[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', '用户id'),
            'datetime' => Yii::t('app', '积分日期'),
            'value' => Yii::t('app', '积分'),
            'intro' => Yii::t('app', '说明'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ShopUser::className(), ['id' => 'user_id']);
    }
}
