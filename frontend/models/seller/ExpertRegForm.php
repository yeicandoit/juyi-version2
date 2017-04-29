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
            $expert = new Expert();
            if ($expert) {
                $expert->name = $this->name;
                $expert->true_name = $this->trueName;
                $expert->password = md5($this->password);
                $expert->regedittime = date('Y-m-d H:i:s', time());
                $expert->logintime = date('Y-m-d H:i:s', 0);
                $expert->age = $this->age;
                $expert->sex = $this->sex;
                $expert->degree = $this->degree;
                $expert->title = $this->tile;
                $expert->mobile = $this->mobile;
                $expert->server_num = $this->serverNum;
                $expert->email = $this->email;
                $expert->country = isset($this->country) ? $this->country : 0;
                $expert->province = isset($this->province) ? $this->province : 0;
                $expert->city =  isset($this->city) ? $this->city : 0;
                $expert->area =  isset($this->area) ? $this->area : 0;
                $expert->address = $this->address;
                $expert->home_url = $this->homeUrl;
                $expert->affliation = $this->affliation;
                $expert->affliationtype = $this->affliationType;
                $expert->account = $this->account;

                if($expert->save()){
                    $shopMember = new ShopMember();
                    $shopMember->shopid = $expert->id;
                    $shopMember->name = $expert->name;
                    $shopMember->password = $expert->password;
                    $shopMember->regtype = 'expert';
                    return $shopMember->save();
                }
            }
       }
        return false;
    }
}
