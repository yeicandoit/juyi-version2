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
class SellerregForm extends Model
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

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message'=>'用户名不能为空'],
            ['username', 'trim'],
            ['username', 'validateName'],

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

    public function validateName($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(Seller::find()->where(['seller_name'=>$this->username])->one())
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
            $seller = new Seller();
            $seller->seller_name = $this->username;
            $seller->true_name = $this->shopRealName;
            $seller->affliation = '';
            $seller->affliationtype = '';
            $seller->login_time = date('Y-m-d H:i:s', 0);
            $seller->phone = '';
            $seller->country = 0;
            $seller->email = $this->email;
            $seller->mobile = $this->phoneNumber;
            $seller->server_num = '';
            $seller->password = md5($this->password);
            $seller->paper_img = $this->file->baseName . '.' . $this->file->extension;
            $seller->create_time = date('Y-m-d H:i:s',time());
            $seller->cash = 0;
            $seller->province = $this->provinces;
            $seller->city = $this->citys;
            $seller->area = $this->countrys;
            $seller->address = $this->detailAddress;
            $seller->account = '';
            $seller->qualification = '';

            if($seller->save()){
                $shopMember = new ShopMember();
                $shopMember->shopid = $seller->id;
                $shopMember->name = $seller->seller_name;
                $shopMember->password = $seller->password;
                $shopMember->regtype = 'seller';
                return $shopMember->save();
            }
        }
        return false;
    }
}
