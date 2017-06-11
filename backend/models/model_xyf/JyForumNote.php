<?php

namespace backend\models\model_xyf;

use Yii;

/**
 * This is the model class for table "jy_forum_note".
 *
 * @property integer $id
 * @property string $bigtype
 * @property string $subtype
 * @property string $area
 * @property string $title
 * @property string $detail
 * @property string $author
 * @property string $datetime
 */
class JyForumNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_forum_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bigtype', 'subtype', 'title', 'detail'], 'required'],
            [['detail'], 'string'],
            [['datetime'], 'safe'],
            [['bigtype', 'subtype', 'area', 'title'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bigtype' => '需求类型：',
            'subtype' => '所属学科：',
            'area' => '所在地区：',
            'title' => '标题',
            'detail' => '需求描述',
            'author' => 'Author',
            'datetime' => 'Datetime',
        ];
    }
}
