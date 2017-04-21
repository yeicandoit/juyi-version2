<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jy_goods_photo_relation".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $photo_id
 */
class JyGoodsPhotoRelation extends \yii\db\ActiveRecord
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
            [['goods_id'], 'required'],
            [['goods_id'], 'integer'],
            [['photo_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'photo_id' => 'Photo ID',
        ];
    }
}
