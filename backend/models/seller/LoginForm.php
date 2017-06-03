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
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_shop = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required', 'message'=>'商户名不能为空'],
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
            $shop = $this->getShop();

            if (!$shop ) {
                $this->addError($attribute, '用户名不存在.');
                return;
            }
            if(!$shop->validatePassword(md5($this->password))) {
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
        if ($this->validate() && $this->_shop) {
            return Yii::$app->user->login($this->getShop(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getShop()
    {
        if ($this->_shop === false) {
            $this->_shop = ShopMember::find()->where(['username'=>$this->username])->one();
        }

        return $this->_shop;
    }
}
