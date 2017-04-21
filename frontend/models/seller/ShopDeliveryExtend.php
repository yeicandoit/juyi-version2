<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "shop_delivery_extend".
 *
 * @property string $id
 * @property string $delivery_id
 * @property string $area_groupid
 * @property string $firstprice
 * @property string $secondprice
 * @property string $first_weight
 * @property string $second_weight
 * @property string $first_price
 * @property string $second_price
 * @property integer $is_save_price
 * @property string $save_rate
 * @property string $low_price
 * @property integer $price_type
 * @property integer $open_default
 * @property string $seller_id
 *
 * @property ShopDelivery $delivery
 * @property ShopSeller $seller
 */
class ShopDeliveryExtend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery_extend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_id', 'first_weight', 'second_weight', 'seller_id'], 'required'],
            [['delivery_id', 'first_weight', 'second_weight', 'is_save_price', 'price_type', 'open_default', 'seller_id'], 'integer'],
            [['area_groupid', 'firstprice', 'secondprice'], 'string'],
            [['first_price', 'second_price', 'save_rate', 'low_price'], 'number'],
            [['delivery_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopDelivery::className(), 'targetAttribute' => ['delivery_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopSeller::className(), 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'delivery_id' => Yii::t('app', '配送方式关联ID'),
            'area_groupid' => Yii::t('app', '单独配置地区id'),
            'firstprice' => Yii::t('app', '单独配置地区对应的首重价格'),
            'secondprice' => Yii::t('app', '单独配置地区对应的续重价格'),
            'first_weight' => Yii::t('app', '首重重量(克)'),
            'second_weight' => Yii::t('app', '续重重量(克)'),
            'first_price' => Yii::t('app', '默认首重价格'),
            'second_price' => Yii::t('app', '默认续重价格'),
            'is_save_price' => Yii::t('app', '是否支持物流保价 1支持保价 0  不支持保价'),
            'save_rate' => Yii::t('app', '保价费率'),
            'low_price' => Yii::t('app', '最低保价'),
            'price_type' => Yii::t('app', '费用类型 0统一设置 1指定地区费用'),
            'open_default' => Yii::t('app', '启用默认费用 1启用 0 不启用'),
            'seller_id' => Yii::t('app', '商家ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(ShopDelivery::className(), ['id' => 'delivery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(ShopSeller::className(), ['id' => 'seller_id']);
    }
}
