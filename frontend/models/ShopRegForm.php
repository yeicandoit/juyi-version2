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
class ShopregForm extends Model
{
    public $username;
    public $password;
    public $confirmpwd;
    public $shopRealName;
    public $phoneNumber;
    public $detailAddress;
    public $comWeb;
    public $shopType;
    public $email;
    public $provinces;
    public $citys;
    public $countrys;
    public $regType;

    public $file;

    private $_shop = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message'=>'用户名不能为空'],
            ['username', 'trim'],

            ['password', 'required', 'message'=>'密码不能为空'],
            ['confirmpwd', 'required', 'message'=>"确认密码不能为空"],
            ['confirmpwd', 'validatePassword'],

            ['shopRealName', 'required', 'message'=>"商户真实名称不能为空"],
            //['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
            ['file', 'file','checkExtensionByMimeType'=>false, 'extensions' => 'jpg, png', 'skipOnEmpty' => false],
            ['phoneNumber', 'required', 'message'=>"手机号码不能为空"],

            ['email', 'required', 'message'=>"邮箱不能为空"],
            ['email', 'filter', 'filter'=>'trim'],
            ['email', 'email'],

            ['detailAddress', 'required', 'message'=>"详细地址不能为空"],
            [['provinces', 'citys', 'countrys', 'regType', 'comWeb', 'shopType'], 'safe'],
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
            $this->_shop->true_name = $this->shopRealName;
            $this->_shop->mobile = $this->phoneNumber;
            //$this->_shop->shopType = $this->shopType;
            $this->_shop->phone = $this->regType;
            $this->_shop->paper_img = $this->file->baseName . '.' . $this->file->extension;
            $this->_shop->province = $this->provinces;
            $this->_shop->city = $this->citys;
            $this->_shop->area = $this->countrys;
            $this->_shop->address = $this->detailAddress;
            $this->_shop->home_url = $this->comWeb;

            return $this->_shop->save();
       }
    }
}
