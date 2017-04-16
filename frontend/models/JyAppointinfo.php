<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%appointinfo}}".
 *
 * @property integer $appointid
 * @property integer $goodid
 * @property string $username
 * @property string $appointdate
 * @property string $appointslot
 * @property integer $appointnum
 * @property string $appointtime
 * @property string $appointaddress
 * @property string $appointwords
 * @property integer $paymentstate
 */
class JyAppointinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%appointinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodid', 'appointnum', 'paymentstate'], 'integer'],
            [['appointdate'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['appointslot', 'appointaddress'], 'string', 'max' => 20],
            [['appointtime'], 'string', 'max' => 50],
            [['appointwords'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appointid' => 'Appointid',
            'goodid' => 'Goodid',
            'username' => 'Username',
            'appointdate' => 'Appointdate',
            'appointslot' => 'Appointslot',
            'appointnum' => 'Appointnum',
            'appointtime' => 'Appointtime',
            'appointaddress' => 'Appointaddress',
            'appointwords' => 'Appointwords',
            'paymentstate' => 'Paymentstate',
        ];
    }
}
