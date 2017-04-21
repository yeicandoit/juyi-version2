<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_prop".
 *
 * @property string $id
 * @property string $name
 * @property string $card_name
 * @property string $card_pwd
 * @property string $start_time
 * @property string $end_time
 * @property string $value
 * @property integer $type
 * @property string $condition
 * @property integer $is_close
 * @property string $img
 * @property integer $is_userd
 * @property integer $is_send
 * @property string $seller_id
 */
class ShopProp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%prop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_time', 'end_time'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['value'], 'number'],
            [['type', 'is_close', 'is_userd', 'is_send', 'seller_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['card_name', 'card_pwd'], 'string', 'max' => 32],
            [['condition', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '道具名称'),
            'card_name' => Yii::t('app', '道具的卡号'),
            'card_pwd' => Yii::t('app', '道具的密码'),
            'start_time' => Yii::t('app', '开始时间'),
            'end_time' => Yii::t('app', '结束时间'),
            'value' => Yii::t('app', '面值'),
            'type' => Yii::t('app', '道具类型 0:代金券'),
            'condition' => Yii::t('app', '条件数据 type=0时,表示ticket的表id,模型id'),
            'is_close' => Yii::t('app', '是否关闭 0:正常,1:关闭,2:下订单未支付时临时锁定'),
            'img' => Yii::t('app', '道具图片'),
            'is_userd' => Yii::t('app', '是否被使用过 0:未使用,1:已使用'),
            'is_send' => Yii::t('app', '是否被发送过 0:否 1:是'),
            'seller_id' => Yii::t('app', '所属商户ID'),
        ];
    }
}
