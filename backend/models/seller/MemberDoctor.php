<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%member_doctor}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $tel
 * @property string $email
 * @property string $title
 * @property string $job
 */
class MemberDoctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_doctor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel'], 'integer'],
            [['name', 'email', 'title', 'job'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '导师姓名'),
            'tel' => Yii::t('app', '导师电话'),
            'email' => Yii::t('app', '导师邮箱'),
            'title' => Yii::t('app', '导师职称'),
            'job' => Yii::t('app', '导师职位'),
        ];
    }
}
