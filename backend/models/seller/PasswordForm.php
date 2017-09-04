<?php

namespace backend\models\seller;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class PasswordForm extends Model
{
    public $oldpw;
    public $newpw;
    public $cfNewpw;

    public $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['oldpw', 'newpw', 'cfNewpw'], 'trim'],
            [['oldpw', 'newpw', 'cfNewpw'], 'string', 'max' => 64],
            [['oldpw', 'newpw', 'cfNewpw'], 'required', 'message'=>'不能为空'],
            ['cfNewpw', 'compare','compareAttribute'=>'newpw'],
            ['oldpw', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldpw' => Yii::t('app', '旧密码'),
            'newpw' => Yii::t('app', '新密码'),
            'cfNewpw' => Yii::t('app', '确认新密码'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user ) {
                $this->addError($attribute, '商家不存在.');
                return;
            }
            if(md5($this->oldpw) != $this->_user->password) {
                $this->addError($attribute, '原密码填写错误.');
                return;
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function save()
    {
        if ($this->validate()) {
            $this->_user->password = md5($this->newpw);
            return $this->_user->save();
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = ShopMember::findOne(Yii::$app->user->id);
        }

        return $this->_user;
    }
}
