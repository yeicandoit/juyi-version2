<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%forum_note}}".
 *
 * @property integer $id
 * @property string $bigtype
 * @property string $subtype
 * @property string $area
 * @property string $title
 * @property string $detail
 * @property string $author
 * @property string $datetime
 * @property string $deadline
 * @property string $money
 * @property string $email
 * @property string $telephone
 */
class ForumNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forum_note}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bigtype', 'subtype', 'title', 'detail'], 'required'],
            [['detail'], 'string'],
            [['datetime', 'deadline'], 'safe'],
            [['bigtype', 'subtype', 'area', 'title', 'money', 'email', 'telephone'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bigtype' => Yii::t('app', 'Bigtype'),
            'subtype' => Yii::t('app', 'Subtype'),
            'area' => Yii::t('app', '地区'),
            'title' => Yii::t('app', '标题'),
            'detail' => Yii::t('app', 'Detail'),
            'author' => Yii::t('app', '作者'),
            'datetime' => Yii::t('app', '发帖时间'),
            'deadline' => Yii::t('app', 'Deadline'),
            'money' => Yii::t('app', 'Money'),
            'email' => Yii::t('app', 'Email'),
            'telephone' => Yii::t('app', 'Telephone'),
        ];
    }
}
