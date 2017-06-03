<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%goods_photo}}".
 *
 * @property string $id
 * @property string $img
 */
class GoodsPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'img' => Yii::t('app', '原始图片路径'),
        ];
    }
}
