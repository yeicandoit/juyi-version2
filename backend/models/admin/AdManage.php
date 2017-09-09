<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%ad_manage}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $type
 * @property string $position_id
 * @property string $link
 * @property integer $order
 * @property string $start_time
 * @property string $end_time
 * @property string $content
 * @property string $description
 * @property string $goods_cat_id
 *
 * @property AdPosition $position
 */
class AdManage extends \yii\db\ActiveRecord
{
    const TYPE_IMG = 1;
    const TYPE_FLASH = 2;
    const TYPE_WORD = 3;
    const TYPE_CODE = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_manage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'position_id', 'order', 'content'], 'required'],
            [['type', 'position_id', 'order', 'goods_cat_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['link', 'description'], 'string', 'max' => 255],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '广告ID'),
            'name' => Yii::t('app', '广告名称'),
            'type' => Yii::t('app', '广告类型 1:img 2:flash 3:文字 4:code'),
            'position_id' => Yii::t('app', '广告位ID'),
            'link' => Yii::t('app', '链接地址'),
            'order' => Yii::t('app', '排列顺序'),
            'start_time' => Yii::t('app', '开始时间'),
            'end_time' => Yii::t('app', '结束时间'),
            'content' => Yii::t('app', '图片、flash路径，文字，富文本等'),
            'description' => Yii::t('app', '描述'),
            'goods_cat_id' => Yii::t('app', '绑定的商品分类ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(AdPosition::className(), ['id' => 'position_id']);
    }

    public static function getTypes()
    {
        return array(
            self::TYPE_IMG=>'图片',
            self::TYPE_FLASH=>'flash',
            self::TYPE_WORD=>'文字',
            self::TYPE_CODE=>'富文本',
        );
    }
}
