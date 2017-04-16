<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "shop_spec".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property integer $type
 * @property string $note
 * @property integer $is_del
 * @property integer $seller_id
 */
class ShopSpec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_spec';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'string'],
            [['type', 'is_del', 'seller_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '规格名称'),
            'value' => Yii::t('app', '规格值'),
            'type' => Yii::t('app', '显示类型 1文字 2图片'),
            'note' => Yii::t('app', '备注说明'),
            'is_del' => Yii::t('app', '是否删除1删除'),
            'seller_id' => Yii::t('app', '商家ID'),
        ];
    }
}
