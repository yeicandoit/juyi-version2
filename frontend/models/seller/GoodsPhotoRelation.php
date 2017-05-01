<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%goods_photo_relation}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $photo_id
 */
class GoodsPhotoRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_photo_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'photo_id'], 'required'],
            [['goods_id', 'photo_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goods_id' => Yii::t('app', '商品ID'),
            'photo_id' => Yii::t('app', '图片ID'),
        ];
    }
}
