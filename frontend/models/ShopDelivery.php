<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_delivery".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $area_groupid
 * @property string $firstprice
 * @property string $secondprice
 * @property integer $type
 * @property string $first_weight
 * @property string $second_weight
 * @property string $first_price
 * @property string $second_price
 * @property integer $status
 * @property integer $sort
 * @property integer $is_save_price
 * @property string $save_rate
 * @property string $low_price
 * @property integer $price_type
 * @property integer $open_default
 * @property integer $is_delete
 *
 * @property ShopDeliveryExtend[] $shopDeliveryExtends
 */
class ShopDelivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_groupid', 'firstprice', 'secondprice'], 'string'],
            [['type', 'first_weight', 'second_weight', 'status', 'sort', 'is_save_price', 'price_type', 'open_default', 'is_delete'], 'integer'],
            [['first_weight', 'second_weight'], 'required'],
            [['first_price', 'second_price', 'save_rate', 'low_price'], 'number'],
            [['name', 'description'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '快递名称'),
            'description' => Yii::t('app', '快递描述'),
            'area_groupid' => Yii::t('app', '配送区域id'),
            'firstprice' => Yii::t('app', '配送地址对应的首重价格'),
            'secondprice' => Yii::t('app', '配送地区对应的续重价格'),
            'type' => Yii::t('app', '配送类型 0先付款后发货 1先发货后付款 2自提点'),
            'first_weight' => Yii::t('app', '首重重量(克)'),
            'second_weight' => Yii::t('app', '续重重量(克)'),
            'first_price' => Yii::t('app', '首重价格'),
            'second_price' => Yii::t('app', '续重价格'),
            'status' => Yii::t('app', '开启状态'),
            'sort' => Yii::t('app', '排序'),
            'is_save_price' => Yii::t('app', '是否支持物流保价 1支持保价 0  不支持保价'),
            'save_rate' => Yii::t('app', '保价费率'),
            'low_price' => Yii::t('app', '最低保价'),
            'price_type' => Yii::t('app', '费用类型 0统一设置 1指定地区费用'),
            'open_default' => Yii::t('app', '启用默认费用 1启用 0 不启用'),
            'is_delete' => Yii::t('app', '是否删除 0:未删除 1:删除'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryExtends()
    {
        return $this->hasMany(ShopDeliveryExtend::className(), ['delivery_id' => 'id']);
    }
}
