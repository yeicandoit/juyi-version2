<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "jy_announcement".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $time
 */
class JyAnnouncement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_announcement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['time', 'keywords', 'description'], 'safe'],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'time' => 'Time',
            'keywords'=>Yii::t('app', 'SEO关键词'),
            'description'=>Yii::t('app', 'SEO描述'),
        ];
    }
}
