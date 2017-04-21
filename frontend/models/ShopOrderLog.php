<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_order_log".
 *
 * @property string $id
 * @property string $order_id
 * @property string $user
 * @property string $action
 * @property string $addtime
 * @property string $result
 * @property string $note
 *
 * @property ShopOrder $order
 */
class ShopOrderLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['addtime'], 'safe'],
            [['user', 'action'], 'string', 'max' => 20],
            [['result'], 'string', 'max' => 10],
            [['note'], 'string', 'max' => 100],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', '订单id'),
            'user' => Yii::t('app', '操作人：顾客或admin或seller'),
            'action' => Yii::t('app', '动作'),
            'addtime' => Yii::t('app', '添加时间'),
            'result' => Yii::t('app', '操作的结果'),
            'note' => Yii::t('app', '备注'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(ShopOrder::className(), ['id' => 'order_id']);
    }
}
