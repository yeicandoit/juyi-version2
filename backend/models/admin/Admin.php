<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $id
 * @property string $admin_name
 * @property string $password
 * @property string $role_id
 * @property string $create_time
 * @property string $email
 * @property string $last_ip
 * @property string $last_time
 * @property integer $is_del
 *
 * @property QuickNaviga[] $quickNavigas
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_name', 'password', 'role_id'], 'required'],
            [['role_id', 'is_del'], 'integer'],
            [['create_time', 'last_time'], 'safe'],
            [['admin_name'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 255],
            [['last_ip'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '管理员ID'),
            'admin_name' => Yii::t('app', '用户名'),
            'password' => Yii::t('app', '密码'),
            'role_id' => Yii::t('app', '角色ID'),
            'create_time' => Yii::t('app', '创建时间'),
            'email' => Yii::t('app', 'Email'),
            'last_ip' => Yii::t('app', '最后登录IP'),
            'last_time' => Yii::t('app', '最后登录时间'),
            'is_del' => Yii::t('app', '删除状态 1删除,0正常'),
        ];
    }
}
