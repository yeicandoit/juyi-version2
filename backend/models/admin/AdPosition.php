<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%ad_position}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property integer $fashion
 * @property integer $status
 *
 * @property AdManage[] $adManages
 */
class AdPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'width', 'height', 'fashion', 'status'], 'required'],
            [['width', 'height', 'fashion', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '广告位ID'),
            'name' => Yii::t('app', '广告位名称'),
            'width' => Yii::t('app', '广告位宽度'),
            'height' => Yii::t('app', '广告位高度'),
            #'fashion' => Yii::t('app', '1:轮显;2:随即'),
            #'status' => Yii::t('app', '1:开启; 0: 关闭'),
            'fashion' => Yii::t('app', '显示方式'),
            'status' => Yii::t('app', '状态'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdManages()
    {
        return $this->hasMany(AdManage::className(), ['position_id' => 'id']);
    }
}
