<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "shop_merch_ship_info".
 *
 * @property string $id
 * @property string $ship_name
 * @property string $ship_user_name
 * @property integer $sex
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $postcode
 * @property string $address
 * @property string $mobile
 * @property string $telphone
 * @property integer $is_default
 * @property string $note
 * @property string $addtime
 * @property integer $is_del
 * @property string $seller_id
 */
class ShopMerchShipInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_merch_ship_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ship_name', 'ship_user_name', 'province', 'city', 'area', 'address', 'mobile', 'addtime', 'seller_id'], 'required'],
            [['sex', 'country', 'province', 'city', 'area', 'is_default', 'is_del', 'seller_id'], 'integer'],
            [['note'], 'string'],
            [['addtime'], 'safe'],
            [['ship_name', 'ship_user_name', 'address'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 6],
            [['mobile', 'telphone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ship_name' => Yii::t('app', '发货点名称'),
            'ship_user_name' => Yii::t('app', '发货人姓名'),
            'sex' => Yii::t('app', '性别 0:女 1:男'),
            'country' => Yii::t('app', '国id'),
            'province' => Yii::t('app', '省id'),
            'city' => Yii::t('app', '市id'),
            'area' => Yii::t('app', '地区id'),
            'postcode' => Yii::t('app', '邮编'),
            'address' => Yii::t('app', '具体地址'),
            'mobile' => Yii::t('app', '手机'),
            'telphone' => Yii::t('app', '电话'),
            'is_default' => Yii::t('app', '1为默认地址，0则不是'),
            'note' => Yii::t('app', '备注'),
            'addtime' => Yii::t('app', '保存时间'),
            'is_del' => Yii::t('app', '0为删除，1为显示'),
            'seller_id' => Yii::t('app', '商家ID'),
        ];
    }
}
