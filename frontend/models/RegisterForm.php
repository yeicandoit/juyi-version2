<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\ShopMember;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $confirmpwd;
    public $email;
    public $acceptLicense;
    public $verifyCode;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message'=>'邮箱不能为空'],
            ['email', 'filter', 'filter'=>'trim'],
            ['email', 'email'],

            ['username', 'required', 'message'=>'用户名不能为空'],
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 20, 'message' => '字符串长度不符合要求'],
            ['username', 'match', 'pattern'=> "!^[_a-zA-Z0-9\\x{4e00}-\\x{9fa5}]{2,20}$!u", 'message'=>'用户名可以为字母、数字、下划线和中文'],
            ['username', 'validateUsername'],

            ['password', 'required', 'message'=>'密码不能为空'],
            ['password', 'string', 'min' => 6, 'max' => 32],

            ['confirmpwd', 'required', 'message'=>"确认密码不能为空"],
            //['confirmpwd', 'compare', 'compareAttribute'=>'password', 'message'=>'两次密码输入不一致.'],TODO debug 为什么compare不起作用
            ['confirmpwd', 'validatePassword'],

            ['acceptLicense', 'compare', 'compareValue'=>true, 'message'=>'请同意协议并勾选'],

            ['verifyCode', 'required', 'message'=>'请填写验证码'],
            ['verifyCode', 'captcha', 'message' => '验证码错误'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if($this->getUser())
            {
                $this->addError($attribute, '用户名已存在');
            }
        }
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password != $this->confirmpwd) {
                $this->addError($attribute, '两次输入密码不一致.');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::find()->where(['username'=>$this->username])->one();
        }

        return $this->_user;
    }

    public function register()
    {
        if($this->validate()){
            $this->_user = new User();
            $this->_user->username = $this->username;
            $this->_user->password = md5($this->password);

            $mail= Yii::$app->mailer->compose();
            $mail->setTo($this->email);
            $mail->setSubject("邮件测试");
            $code    = base64_encode("Hello world");
            $content = "http://localhost:8080/index.php?code=$code";
            $mail->setHtmlBody("<br>$content");    //发布可以带html标签的文本
            if ($mail->send()) {
                if($this->_user->save()){
                    $member = new ShopMember();
                    $member->email = $this->email;
                    $member->user_id = $this->_user->id;
                    $member->time =  date('Y-m-d H:i:s',time());
                    $member->status = 3;
                    return $member->save();
                } else {
                    return false;
                }
            }
        }

        return false;
    }
}
