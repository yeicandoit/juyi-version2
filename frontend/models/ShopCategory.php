<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_category".
 *
 * @property string $id
 * @property string $name
 * @property string $parent_id
 * @property integer $sort
 * @property integer $visibility
 * @property string $keywords
 * @property string $descript
 * @property string $title
 * @property string $seller_id
 *
 * @property ShopCategoryExtend[] $shopCategoryExtends
 */
class ShopCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['parent_id', 'sort', 'visibility', 'seller_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['keywords', 'descript', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '分类ID'),
            'name' => Yii::t('app', '分类名称'),
            'parent_id' => Yii::t('app', '父分类ID'),
            'sort' => Yii::t('app', '排序'),
            'visibility' => Yii::t('app', '首页是否显示 1显示 0 不显示'),
            'keywords' => Yii::t('app', 'SEO关键词和检索关键词'),
            'descript' => Yii::t('app', 'SEO描述'),
            'title' => Yii::t('app', 'SEO标题title'),
            'seller_id' => Yii::t('app', '商家ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopCategoryExtends()
    {
        return $this->hasMany(ShopCategoryExtend::className(), ['category_id' => 'id']);
    }
}
