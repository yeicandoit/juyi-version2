<?php

namespace backend\models\admin;

use backend\models\seller\ShopMember;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_admin = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required', 'message'=>'管理名不能为空'],
            ['username', 'trim'],
            ['password', 'required', 'message'=>'密码不能为空'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
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
            $admin = $this->getAdmin();

            if (!$admin ) {
                $this->addError($attribute, '管理名不存在.');
                return;
            }
            if(!$admin->validatePassword(md5($this->password))) {
                Yii::info("original password is $this->password, md5 is:" . md5($this->password));
                $this->addError($attribute, '密码错误.');
                return;
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() && $this->_admin) {
            return Yii::$app->user->login($this->getAdmin(), $this->rememberMe ? 3600*24*1 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getAdmin()
    {
        if ($this->_admin === false) {
            $this->_admin = ShopMember::find()->where(['username'=>$this->username, 'regtype'=>'admin'])->one();
        }

        return $this->_admin;
    }
}
