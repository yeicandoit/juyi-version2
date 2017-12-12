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
class AdminForm extends Model
{
    public $username;
    public $password;
    public $cfpwd;

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
            ['cfpwd', 'required', 'message'=>'确认密码不能为空'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', '用户名'),
            'password' => Yii::t('app', '密码'),
            'cfpwd' => Yii::t('app', '确认密码'),
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

            if ($admin ) {
                $this->addError($attribute, '此账户已经被注册.');
                return;
            }
            if($this->password != $this->cfpwd) {
                $this->addError($attribute, '两次输入密码不一致.');
                return;
            }
        }
    }

    public function addAdmin()
    {
        if ($this->validate()) {
            $shopmember = new ShopMember();
            $maxAdminId = ShopMember::find()->where(['regtype'=>'admin'])->max('id');
            $shopmember->id = $maxAdminId + 1;
            $shopmember->username = $this->username;
            $shopmember->password = md5($this->password);
            $shopmember->regtype = 'admin';
            if($shopmember->save()){
                return true;
            }
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
