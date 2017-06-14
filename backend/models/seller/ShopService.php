<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%shop_service}}".
 *
 * @property string $id
 * @property string $service
 * @property integer $shopid
 * @property integer $type
 */
class ShopService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service', 'shopid', 'type'], 'required'],
            [['shopid', 'type'], 'integer'],
            [['service'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service' => Yii::t('app', '服务类型'),
            'shopid' => Yii::t('app', '所属商家'),
            'type' => Yii::t('app', '1:检测中心 2:专家解码 3:科研辅助 4:数值模拟'),
        ];
    }
}
