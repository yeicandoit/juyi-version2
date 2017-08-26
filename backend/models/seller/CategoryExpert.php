<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%category_expert}}".
 *
 * @property string $id
 * @property string $expert_id
 * @property string $category_id
 */
class CategoryExpert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_expert}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expert_id', 'category_id'], 'required'],
            [['expert_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'expert_id' => Yii::t('app', '专家ID'),
            'category_id' => Yii::t('app', '分类ID'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
