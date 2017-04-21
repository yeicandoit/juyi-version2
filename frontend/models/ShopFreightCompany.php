<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_freight_company".
 *
 * @property string $id
 * @property string $freight_type
 * @property string $freight_name
 * @property string $url
 * @property integer $sort
 * @property integer $is_del
 *
 * @property ShopDeliveryDoc[] $shopDeliveryDocs
 */
class ShopFreightCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%freight_company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['freight_type', 'freight_name', 'url'], 'required'],
            [['sort', 'is_del'], 'integer'],
            [['freight_type', 'freight_name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'freight_type' => Yii::t('app', '货运类型'),
            'freight_name' => Yii::t('app', '货运公司名称'),
            'url' => Yii::t('app', '网址'),
            'sort' => Yii::t('app', '排序'),
            'is_del' => Yii::t('app', '0未删除1删除'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryDocs()
    {
        return $this->hasMany(ShopDeliveryDoc::className(), ['freight_id' => 'id']);
    }
}
