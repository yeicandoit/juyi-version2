<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_payment".
 *
 * @property string $id
 * @property string $name
 * @property integer $type
 * @property string $class_name
 * @property string $description
 * @property string $logo
 * @property integer $status
 * @property integer $order
 * @property string $note
 * @property string $poundage
 * @property integer $poundage_type
 * @property string $config_param
 * @property integer $client_type
 */
class ShopPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'class_name', 'logo'], 'required'],
            [['type', 'status', 'order', 'poundage_type', 'client_type'], 'integer'],
            [['description', 'note', 'config_param'], 'string'],
            [['poundage'], 'number'],
            [['name', 'class_name'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '支付名称'),
            'type' => Yii::t('app', '1:线上、2:线下'),
            'class_name' => Yii::t('app', '支付类名称'),
            'description' => Yii::t('app', '描述'),
            'logo' => Yii::t('app', '支付方式logo图片路径'),
            'status' => Yii::t('app', '安装状态 0启用 1禁用'),
            'order' => Yii::t('app', '排序'),
            'note' => Yii::t('app', '支付说明'),
            'poundage' => Yii::t('app', '手续费'),
            'poundage_type' => Yii::t('app', '手续费方式 1百分比 2固定值'),
            'config_param' => Yii::t('app', '配置参数,json数据对象'),
            'client_type' => Yii::t('app', '1:PC端 2:移动端 3:通用'),
        ];
    }
}
