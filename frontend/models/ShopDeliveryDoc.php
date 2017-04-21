<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_delivery_doc".
 *
 * @property string $id
 * @property string $order_id
 * @property string $user_id
 * @property string $admin_id
 * @property string $seller_id
 * @property string $name
 * @property string $postcode
 * @property string $telphone
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $mobile
 * @property string $time
 * @property string $freight
 * @property string $delivery_code
 * @property string $delivery_type
 * @property string $note
 * @property integer $if_del
 * @property string $freight_id
 *
 * @property ShopFreightCompany $freight0
 * @property ShopOrder $order
 */
class ShopDeliveryDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery_doc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'name', 'province', 'city', 'area', 'address', 'time', 'delivery_code', 'delivery_type'], 'required'],
            [['order_id', 'user_id', 'admin_id', 'seller_id', 'country', 'province', 'city', 'area', 'if_del', 'freight_id'], 'integer'],
            [['time'], 'safe'],
            [['freight'], 'number'],
            [['note'], 'string'],
            [['name', 'delivery_code', 'delivery_type'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 6],
            [['telphone', 'mobile'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 250],
            [['freight_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopFreightCompany::className(), 'targetAttribute' => ['freight_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '发货单ID'),
            'order_id' => Yii::t('app', '订单ID'),
            'user_id' => Yii::t('app', '用户ID'),
            'admin_id' => Yii::t('app', '管理员ID'),
            'seller_id' => Yii::t('app', '商户ID'),
            'name' => Yii::t('app', '收货人'),
            'postcode' => Yii::t('app', '邮编'),
            'telphone' => Yii::t('app', '联系电话'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'address' => Yii::t('app', '收货地址'),
            'mobile' => Yii::t('app', '手机'),
            'time' => Yii::t('app', '创建时间'),
            'freight' => Yii::t('app', '运费'),
            'delivery_code' => Yii::t('app', '物流单号'),
            'delivery_type' => Yii::t('app', '物流方式'),
            'note' => Yii::t('app', '管理员添加的备注信息'),
            'if_del' => Yii::t('app', '0:未删除 1:已删除'),
            'freight_id' => Yii::t('app', '货运公司ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFreight0()
    {
        return $this->hasOne(ShopFreightCompany::className(), ['id' => 'freight_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(ShopOrder::className(), ['id' => 'order_id']);
    }

    public function getShopDelivery()
    {
        return $this->hasOne(ShopDelivery::className(), ['id' => 'delivery_type']);
    }
}
