<?php

namespace backend\models\model_xyf;

use Yii;

/**
 * This is the model class for table "jy_forum_reply".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $reply_name
 * @property string $reply_detail
 * @property string $reply_datetime
 */
class JyForumReply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_forum_reply';
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
            'id' => 'ID',
            'topic_id' => 'Topic ID',
            'reply_name' => 'Reply Name',
            'reply_detail' => '发表回复',
            'reply_datetime' => 'Reply Datetime',
        ];
    }
}
