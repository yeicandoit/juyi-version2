<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%shop_member}}".
 *
 * @property string $id
 * @property integer $shopid
 * @property string $name
 * @property string $password
 */
class ShopMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopid', 'name', 'password', 'regtype'], 'required'],
            [['shopid'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['regtype'], 'string', 'max' => 20],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shopid' => Yii::t('app', '商户id'),
            'name' => Yii::t('app', '商户名'),
            'password' => Yii::t('app', '密码'),
            'regtype' => Yii::t('app', '注册类型'),
        ];
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
