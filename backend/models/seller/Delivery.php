<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%delivery}}".
 *
 * @property string $id
 * @property string $name
 * @property string $number
 * @property string $description
 * @property string $area_groupid
 * @property string $firstprice
 * @property string $secondprice
 * @property integer $type
 * @property string $first_weight
 * @property string $second_weight
 * @property string $first_price
 * @property string $second_price
 * @property integer $status
 * @property integer $sort
 * @property integer $is_save_price
 * @property string $save_rate
 * @property string $low_price
 * @property integer $price_type
 * @property integer $open_default
 * @property integer $is_delete
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number', 'description'], 'required'],
            [['description', 'area_groupid', 'firstprice', 'secondprice'], 'string'],
            [['type', 'first_weight', 'second_weight', 'status', 'sort', 'is_save_price', 'price_type', 'open_default', 'is_delete'], 'integer'],
            [['first_price', 'second_price', 'save_rate', 'low_price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '快递公司名称'),
            'number' => Yii::t('app', '快递单号'),
            'description' => Yii::t('app', '快递补充说明'),
            'area_groupid' => Yii::t('app', '配送区域id'),
            'firstprice' => Yii::t('app', '配送地址对应的首重价格'),
            'secondprice' => Yii::t('app', '配送地区对应的续重价格'),
            'type' => Yii::t('app', '配送类型 0先付款后发货 1先发货后付款 2自提点'),
            'first_weight' => Yii::t('app', '首重重量(克)'),
            'second_weight' => Yii::t('app', '续重重量(克)'),
            'first_price' => Yii::t('app', '首重价格'),
            'second_price' => Yii::t('app', '续重价格'),
            'status' => Yii::t('app', '开启状态'),
            'sort' => Yii::t('app', '排序'),
            'is_save_price' => Yii::t('app', '是否支持物流保价 1支持保价 0  不支持保价'),
            'save_rate' => Yii::t('app', '保价费率'),
            'low_price' => Yii::t('app', '最低保价'),
            'price_type' => Yii::t('app', '费用类型 0统一设置 1指定地区费用'),
            'open_default' => Yii::t('app', '其他地区是否启用默认费用 1启用 0 不启用'),
            'is_delete' => Yii::t('app', '是否删除 0:未删除 1:删除'),
        ];
    }
}
