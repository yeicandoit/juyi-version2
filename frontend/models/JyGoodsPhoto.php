<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jy_goods_photo".
 *
 * @property string $id
 * @property string $img
 */
class JyGoodsPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_goods_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 32],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
        ];
    }
}
