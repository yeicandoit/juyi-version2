<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\seller\ShopSeller;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ExpertregForm extends Model
{
    public $username;
    public $realname;
    public $password;
    public $confirmpwd;
    public $phoneNumber;
    public $detailAddress;
    public $email;
    public $verifyCode;
    public $province;
    public $city;
    public $area;
    public $comWeb;
    public $regType;

    private $_shop = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message'=>'用户名不能为空'],
            ['username', 'trim'],
            ['username', 'validateUsername'],

            ['password', 'required', 'message'=>'密码不能为空'],
            ['confirmpwd', 'required', 'message'=>"确认密码不能为空"],
            ['confirmpwd', 'validatePassword'],

            ['realname', 'required', 'message'=>"商户真实名称不能为空"],
            ['phoneNumber', 'required', 'message'=>"手机号码不能为空"],

            ['email', 'required', 'message'=>"邮箱不能为空"],
            ['email', 'filter', 'filter'=>'trim'],
            ['email', 'email'],

            ['detailAddress', 'required', 'message'=>"详细地址不能为空"],

            [['province', 'city', 'area', 'comWeb', 'regType'], 'safe'],

            ['verifyCode', 'required', 'message'=>'请填写验证码'],
            ['verifyCode', 'captcha', 'message' => '验证码错误'],
        ];
    }

    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(ShopSeller::find()->where(['seller_name'=>$this->username])->one())
            {
                $this->addError($attribute, '用户名已存在');
            }
        }
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
            if ($this->password != $this->confirmpwd) {
                $this->addError($attribute, '两次输入密码不一致.');
            }
        }
    }

    public function register()
    {
        if($this->validate()){
            $this->_shop = new ShopSeller();
            $this->_shop->seller_name = $this->username;
            $this->_shop->create_time = date('Y-m-d H:i:s',time());
            $this->_shop->email = $this->email;
            $this->_shop->password = md5($this->password);
            $this->_shop->true_name = $this->realname;
            $this->_shop->mobile = $this->phoneNumber;
            $this->_shop->phone = $this->regType;
            $this->_shop->province = isset($this->province) ? $this->province : 0;
            $this->_shop->city = isset($this->city) ? $this->city : 0;
            $this->_shop->area = isset($this->area) ? $this->area : 0;
            $this->_shop->address = $this->detailAddress;
            $this->_shop->home_url = $this->comWeb;

            return $this->_shop->save();
       }
    }
}
