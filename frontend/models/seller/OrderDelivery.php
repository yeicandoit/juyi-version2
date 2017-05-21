<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%order_delivery}}".
 *
 * @property string $id
 * @property integer $userid
 * @property integer $deliveryid
 * @property integer $deliverystate
 * @property integer $oderid
 * @property integer $usertype
 */
class OrderDelivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_delivery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'oderid'], 'required'],
            [['userid', 'deliveryid', 'deliverystate', 'oderid', 'usertype'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', '用户或者商家id'),
            'deliveryid' => Yii::t('app', '快递单id'),
            'deliverystate' => Yii::t('app', '0：未寄送； 1：已经寄送'),
            'oderid' => Yii::t('app', '订单id'),
            'usertype' => Yii::t('app', '0 普通用户 1 商家'),
        ];
    }
}
