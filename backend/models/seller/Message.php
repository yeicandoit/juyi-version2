<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $time
 * @property integer $type
 */
class Message extends \yii\db\ActiveRecord
{
    const TYPE_TEST = 1;
    const TYPE_EXPERT = 2;
    const TYPE_RESEARCH = 3;
    const TYPE_SIMULATE = 4;
    const TYPE_USER = 5;
    const TYPE_ALL = 6;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'time'], 'required'],
            [['content'], 'string'],
            [['time'], 'safe'],
            [['type'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'content' => Yii::t('app', '内容'),
            'time' => Yii::t('app', '发送时间'),
            'type' => Yii::t('app', '1检测中心, 2专家, 3科研辅助，4数值模拟, 5普通用户，6全部'),
        ];
    }

    public static function getTypes()
    {
        return array(
            Message::TYPE_TEST => '检测中心',
            Message::TYPE_EXPERT => '专家',
            Message::TYPE_RESEARCH => '科研辅助',
            Message::TYPE_SIMULATE => '数值模拟',
            Message::TYPE_USER => '普通用户',
            Message::TYPE_ALL => '全部',
        );
    }
}
