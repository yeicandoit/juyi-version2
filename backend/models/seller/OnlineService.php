<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%shop_service}}".
 *
 * @property string $id
 * @property string $qq
 * @property integer $seller_id
 */
class OnlineService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%online_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qq', 'seller_id'], 'required'],
            ['seller_id', 'integer'],
            ['qq', 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'qq' => Yii::t('app', 'QQ'),
            'seller_id' => Yii::t('app', '商家ID'),
        ];
    }
}
