<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_areas".
 *
 * @property string $area_id
 * @property string $parent_id
 * @property string $area_name
 * @property string $sort
 */
class ShopAreas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'area_name'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['area_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => Yii::t('app', 'Area ID'),
            'parent_id' => Yii::t('app', '上一级的id值'),
            'area_name' => Yii::t('app', '地区名称'),
            'sort' => Yii::t('app', '排序'),
        ];
    }
}
