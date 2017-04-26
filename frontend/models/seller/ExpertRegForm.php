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
class ExpertregForm extends Model
{
    public $name;
    public $trueName;
    public $password;
    public $confirmPwd;
    public $age;
    public $sex;
    public $degree;
    public $tile;
    public $mobile;
    public $serverNum;
    public $email;
    public $verifyCode;
    public $country;
    public $province;
    public $city;
    public $area;
    public $address;
    public $homeUrl;
    public $affliation;
    public $affliationType;
    public $title;
    public $account;

    public $regType;

    private $expert = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message'=>'用户名不能为空'],
            ['name', 'trim'],
            ['name', 'validateName'],
            ['trueName', 'required', 'message'=>"商户真实名称不能为空"],
            ['password', 'required', 'message'=>'密码不能为空'],
            ['confirmPwd', 'required', 'message'=>"确认密码不能为空"],
            ['confirmPwd', 'validatePassword'],
            ['degree', 'required', 'message'=>'学历不能为空'],
            ['mobile', 'required', 'message'=>"手机号码不能为空"],
            ['email', 'required', 'message'=>"邮箱不能为空"],
            ['email', 'filter', 'filter'=>'trim'],
            ['email', 'email'],
            ['serverNum', 'required', 'message'=>'QQ不能为空'],
            [['country', 'province', 'city', 'area'], 'safe'], //TODO if set to be 'required', $this->validate() will return false!!!
            ['address', 'required', 'message'=>"详细地址不能为空"],
            ['affliation', 'required', 'message'=>"单位不能为空"],
            ['affliationType', 'required', 'message'=>"单位不能为空"],
            ['account', 'required', 'message'=>"账户不能为空"],
            [['age', 'sex', 'title', 'homeUrl', 'regType'], 'safe'],

            ['verifyCode', 'required', 'message'=>'请填写验证码'],
            ['verifyCode', 'captcha', 'message' => '验证码错误'],
        ];
    }

    public function validateName($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(Expert::find()->where(['name'=>$this->name])->one())
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
            if ($this->password != $this->confirmPwd) {
                $this->addError($attribute, '两次输入密码不一致.');
            }
        }
    }

    public function register()
    {
        if($this->validate()){
            $this->expert = new Expert();
            if ($this->expert) {
                $this->expert->name = $this->name;
                $this->expert->true_name = $this->trueName;
                $this->expert->password = md5($this->password);
                $this->expert->regedittime = date('Y-m-d H:i:s', time());
                $this->expert->logintime = date('Y-m-d H:i:s', 0);
                $this->expert->age = $this->age;
                $this->expert->sex = $this->sex;
                $this->expert->degree = $this->degree;
                $this->expert->title = $this->tile;
                $this->expert->mobile = $this->mobile;
                $this->expert->server_num = $this->serverNum;
                $this->expert->email = $this->email;
                $this->expert->country = isset($this->country) ? $this->country : 0;
                $this->expert->province = isset($this->province) ? $this->province : 0;
                $this->expert->city =  isset($this->city) ? $this->city : 0;
                $this->expert->area =  isset($this->area) ? $this->area : 0;
                $this->expert->address = $this->address;
                $this->expert->home_url = $this->homeUrl;
                $this->expert->affliation = $this->affliation;
                $this->expert->affliationtype = $this->affliationType;
                $this->expert->account = $this->account;

                return $this->expert->save();
            }
       }
        return false;
    }
}
