<?php

namespace frontend\models\seller;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model implements \yii\web\IdentityInterface
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $id;

    private $_seller = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required', 'message'=>'商户/专家名不能为空'],
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
            $seller = $this->getSeller();

            if (!$seller ) {
                $this->addError($attribute, '用户名不存在.');
                return;
            }
            if(!$seller->validatePassword(md5($this->password))) {
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
        if ($this->validate()) {
            if($this->_seller){
                $this->id = $this->_seller->id;
            }
            return Yii::$app->user->login($this, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getSeller()
    {
        if ($this->_seller === false) {
            $this->_seller = ShopSeller::find()->where(['seller_name'=>$this->username])->one();
        }

        return $this->_seller;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->authKey;
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
