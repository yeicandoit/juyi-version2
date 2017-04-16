<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jy_appointinfo".
 *
 * @property integer $id
 * @property string $username
 * @property string $appointdate
 * @property string $appointslot
 * @property string $appointtime
 */
class JyAppointinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_appointinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'appointdate', 'appointslot'], 'required'],
            
            [['appointdate'], 'safe'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'appointdate' => 'Appointdate',
            'appointslot' => 'Appointslot',
            'appointtime' => 'Appointtime',
        ];
    }
}
