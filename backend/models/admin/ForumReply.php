<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%forum_reply}}".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $reply_name
 * @property string $reply_detail
 * @property string $reply_datetime
 */
class ForumReply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forum_reply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id'], 'integer'],
            [['reply_detail'], 'required'],
            [['reply_detail'], 'string'],
            [['reply_datetime'], 'safe'],
            [['reply_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'topic_id' => Yii::t('app', 'Topic ID'),
            'reply_name' => Yii::t('app', 'Reply Name'),
            'reply_detail' => Yii::t('app', 'Reply Detail'),
            'reply_datetime' => Yii::t('app', 'Reply Datetime'),
        ];
    }
}
