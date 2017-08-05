<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property string $id
 * @property string $name
 * @property string $logo
 * @property string $url
 * @property string $description
 * @property integer $sort
 * @property string $category_ids
 */
class Brand extends \yii\db\ActiveRecord
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
            [['sort', 'type'], 'integer'],
            [['name', 'logo', 'url'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', '品牌分类'),
        ];
    }

    public static function getTypetextArr()
    {
        return array(null=>'请选择', Goods::TYPE_TEST=>'检测', Goods::TYPE_EXPERT=>'专家', Goods::TYPE_RESEARCH=>"科研辅助", Goods::TYPE_SIMULATE=>'数值模拟');
    }
}
