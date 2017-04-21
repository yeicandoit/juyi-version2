<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_brand".
 *
 * @property string $id
 * @property string $name
 * @property string $logo
 * @property string $url
 * @property string $description
 * @property integer $sort
 * @property string $category_ids
 */
class ShopBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['sort'], 'integer'],
            [['name', 'logo', 'url', 'category_ids'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '品牌ID'),
            'name' => Yii::t('app', '品牌名称'),
            'logo' => Yii::t('app', 'logo地址'),
            'url' => Yii::t('app', '网址'),
            'description' => Yii::t('app', '描述'),
            'sort' => Yii::t('app', '排序'),
            'category_ids' => Yii::t('app', '品牌分类,逗号分割id'),
        ];
    }
}
