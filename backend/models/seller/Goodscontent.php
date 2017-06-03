<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%goodscontent}}".
 *
 * @property string $id
 * @property integer $goodid
 * @property string $content
 */
class Goodscontent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goodscontent}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodid'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goodid' => Yii::t('app', 'Goodid'),
            'content' => Yii::t('app', 'Content'),
        ];
    }
}
