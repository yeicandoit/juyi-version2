<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%account}}".
 *
 * @property integer $userid
 * @property string $username
 * @property string $balance
 * @property string $paypasswd
 * @property string $lasttime
 * @property string $lastnum
 * @property integer $lastorderno
 * @property integer $state
 * @property integer $type
 * @property integer $operatorid
 */
class Acc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username'], 'required'],
            [['userid', 'lastorderno', 'state', 'type', 'operatorid'], 'integer'],
            [['balance', 'lastnum'], 'number'],
            [['lasttime'], 'safe'],
            [['username', 'paypasswd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => Yii::t('app', 'Userid'),
            'username' => Yii::t('app', 'Username'),
            'balance' => Yii::t('app', '余额'),
            'paypasswd' => Yii::t('app', '支付密码֧'),
            'lasttime' => Yii::t('app', 'Lasttime'),
            'lastnum' => Yii::t('app', '上次修改数额'),
            'lastorderno' => Yii::t('app', '上次修改账户单号'),
            'state' => Yii::t('app', '账户状态 0 冻结  1 开通'),
            'type' => Yii::t('app', '金额变动方式 0 增加 1 减少'),
            'operatorid' => Yii::t('app', '操作人员。0 系统自动 否则为相关管理员id'),
        ];
    }
}
