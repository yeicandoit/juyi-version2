<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%appointinfo}}".
 *
 * @property integer $appointid
 * @property integer $goodid
 * @property integer $shopid
 * @property string $username
 * @property string $appointdate
 * @property string $appointslot
 * @property integer $appointnum
 * @property string $appointtime
 * @property string $appointaddress
 * @property string $appointwords
 * @property integer $paymentstate
 */
class Appointinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%appointinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodid', 'shopid', 'appointnum', 'paymentstate'], 'integer'],
            [['appointdate'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['appointslot', 'appointaddress'], 'string', 'max' => 20],
            [['appointtime'], 'string', 'max' => 50],
            [['appointwords'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appointid' => Yii::t('app', '预约号'),
            'goodid' => Yii::t('app', '商品id'),
            'shopid' => Yii::t('app', '商家id'),
            'username' => Yii::t('app', '预约人'),
            'appointdate' => Yii::t('app', '预约日期'),
            'appointslot' => Yii::t('app', 'Appointslot'),
            'appointnum' => Yii::t('app', '预约数量'),
            'appointtime' => Yii::t('app', 'Appointtime'),
            'appointaddress' => Yii::t('app', '预约地址'),
            'appointwords' => Yii::t('app', 'Appointwords'),
            'paymentstate' => Yii::t('app', '是否付款'),
        ];
    }

    public function getGood()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goodid']);
    }
}
