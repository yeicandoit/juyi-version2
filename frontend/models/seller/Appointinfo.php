<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%appointinfo}}".
 *
 * @property integer $appointid
 * @property integer $goodid
 * @property integer $userid
 * @property string $appointdate
 * @property string $appointslot
 * @property integer $appointnum
 * @property string $appointtime
 * @property integer $orderstate
 * @property integer $specid
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
            [['goodid', 'userid', 'appointnum', 'orderstate', 'specid'], 'integer'],
            [['appointdate'], 'safe'],
            [['appointslot'], 'string', 'max' => 20],
            [['appointtime'], 'string', 'max' => 50],
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
            'userid' => Yii::t('app', '预约人id'),
            'appointdate' => Yii::t('app', '预约时间'),
            'appointslot' => Yii::t('app', '预留：预约时间段'),
            'appointnum' => Yii::t('app', '预约数量'),
            'appointtime' => Yii::t('app', '预约下单时间'),
            'orderstate' => Yii::t('app', '是否生成订单'),
            'specid' => Yii::t('app', '预约设定的规格，0为没有规格'),
        ];
    }

    public function getGood()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goodid']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
}
