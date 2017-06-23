<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "jy_information".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $time
 */
class JyInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_information';
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
            [['title'], 'string', 'max' => 255],
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
        ];
    }
}
