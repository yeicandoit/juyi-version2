<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%goodsspec}}".
 *
 * @property string $id
 * @property integer $goodsid
 * @property string $specname
 * @property string $market_price
 * @property string $sell_price
 */
class Goodsspec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goodsspec}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsid'], 'integer'],
            [['market_price', 'sell_price'], 'number'],
            [['specname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goodsid' => Yii::t('app', 'Goodsid'),
            'specname' => Yii::t('app', 'Specname'),
            'market_price' => Yii::t('app', 'Market Price'),
            'sell_price' => Yii::t('app', 'Sell Price'),
        ];
    }
}
