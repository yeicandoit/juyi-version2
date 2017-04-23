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
class SellerDetailForm extends Model
{
    public $name;
    public $newpwd;
    public $cfmnewpwd;
    public $truename;
    public $paperimg;
    public $cash;
    public $account;
    public $mobile;
    public $email;
    public $province;
    public $city;
    public $area;
    public $address;
    public $homeurl;
    public $regType;

    public $title;
    public $institute;
    public $lab;
    public $description;
    public $direction;
    public $education;
    public $work;
    public $research;
    public $project;
    public $award;

    //For merch ship info
    public $shipName;
    public $shipUserName;
    public $sex;
    public $telphone;
    public $postcode;
    public $isdefault;

    public $_seller = false;
    public $_expertInfo = false;
    const ViewAddr = 'viewaddr';

    public function __construct($view = '')
    {
        parent::__construct();
        if(self::ViewAddr == $view){

        } else {
            $this->_seller = ShopSeller::findOne(Yii::$app->user->id);
            $this->name = $this->_seller->seller_name;
            $this->truename = $this->_seller->true_name;
            $this->paperimg = $this->_seller->paper_img;
            $this->cash = $this->_seller->cash;
            $this->account = $this->_seller->account;
            $this->mobile = $this->_seller->mobile;
            $this->email = $this->_seller->email;
            $this->address = $this->_seller->address;
            $this->homeurl = $this->_seller->home_url;
            $this->province = $this->_seller->province;
            $this->city = $this->_seller->city;
            $this->area = $this->_seller->area;
            $this->regType = $this->_seller->phone;
            if('expertreg' == $this->regType) {
                $this->_expertInfo = $this->_seller->expertInfo;
                if($this->_expertInfo){
                    $this->institute = $this->_expertInfo->institute;
                    $this->lab = $this->_expertInfo->lab;
                    $this->description = $this->_expertInfo->description;
                    $this->direction = $this->_expertInfo->direction;
                    $this->education = $this->_expertInfo->education;
                    $this->work = $this->_expertInfo->work;
                    $this->research = $this->_expertInfo->research;
                    $this->project = $this->_expertInfo->project;
                    $this->award = $this->_expertInfo->award;
                    $this->title = $this->_expertInfo->title;
                }
            }
        }
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'newpwd', 'cfmnewpwd', 'truename', 'paperimg', 'cash', 'account', 'mobile', 'email', 'province',
                'city', 'area', 'address', 'homeurl', 'regType', 'title', 'institute', 'lab', 'description', 'direction',
            'education', 'work', 'research', 'project', 'award'], 'safe'],
            [[ 'province', 'city', 'area'], 'integer'],
            ['cash', 'number'],
            ['account', 'string'],
            ['truename', 'string', 'max' => 80],
            [['newpwd', 'cfmnewpwd'], 'string', 'max' => 32],
            ['cfmnewpwd', 'compare', 'compareAttribute'=> 'newpwd'],
            [['email', 'paperimg', 'address'], 'string', 'max' => 255],
            ['mobile', 'string', 'max' => 20],

            //For merch ship info
            [['shipName', 'shipUserName'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 6],
            ['telphone', 'string', 'max' => 20],
            [['sex',  'is_default'], 'integer'],
            [['shipName', 'shipUserName', 'sex', 'address', 'province', 'city', 'area', 'address', 'mobile',], 'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', '登录用户名'),
            'oldpwd' => Yii::t('app', '原密码'),
            'newpwd' => Yii::t('app', '新密码'),
            'cfmnewpwd' => Yii::t('app', '确认新密码'),
            'truename' => Yii::t('app', '商户真实名称'),
            'cash' => Yii::t('app', '保证金数额'),
            'paperimg' => Yii::t('app', '商户资质材料'),
            'account' => Yii::t('app', '收款账号'),
            'mobile' => Yii::t('app', '手机号码'),
            'email' => Yii::t('app', '邮箱'),
            'address' => Yii::t('app', '详细地址'),
            'homeurl' => Yii::t('app', '企业官网'),
        ];
    }

    public function saveInfo()
    {
        if($this->_seller == false){
            $this->_seller = ShopSeller::findOne(Yii::$app->user->id);
        }
        $this->_seller->account = $this->account;
        $this->_seller->mobile = $this->mobile;
        $this->_seller->email = $this->email;
        $this->_seller->address = $this->address;
        $this->_seller->home_url = $this->homeurl;
        $this->_seller->province = $this->province;
        $this->_seller->city = $this->city;
        $this->_seller->area = $this->area;
        //TODO enable changing password later.
        //if( ''!=$this->newpwd){
        //    if($this->newpwd == $this->cfmnewpwd){
        //        $this->_seller->password = md5($this->newpwd);
        //    } else {
        //        return false;
        //    }
        //}

        return $this->_seller->update();
    }

    public function saveExpertInfo()
    {
        if($this->_expertInfo) {
        } else {
            $this->_expertInfo = new ExpertInfo();
        }
        if ($this->_expertInfo) {
            $this->_expertInfo->seller_id = Yii::$app->user->id;
            $this->_expertInfo->title = $this->title;
            $this->_expertInfo->institute = $this->institute;
            $this->_expertInfo->lab = $this->lab;
            $this->_expertInfo->description = $this->description;
            $this->_expertInfo->direction = $this->direction;
            $this->_expertInfo->education = $this->education;
            $this->_expertInfo->work = $this->work;
            $this->_expertInfo->research = $this->research;
            $this->_expertInfo->project = $this->project;
            $this->_expertInfo->award = $this->award;
        }
        return $this->_expertInfo->save();
    }

    public function saveShipInfo()
    {
        $shopMerchShipInfo =new ShopMerchShipInfo();
        if($shopMerchShipInfo) {
            $shopMerchShipInfo->seller_id = Yii::$app->user->id;
            $shopMerchShipInfo->ship_name = $this->shipName;
            $shopMerchShipInfo->ship_user_name = $this->shipUserName;
            $shopMerchShipInfo->sex = $this->sex;
            $shopMerchShipInfo->province = $this->province;
            $shopMerchShipInfo->city = $this->city;
            $shopMerchShipInfo->area = $this->area;
            $shopMerchShipInfo->address = $this->address;
            $shopMerchShipInfo->postcode = $this->postcode;
            $shopMerchShipInfo->mobile = $this->mobile;
            $shopMerchShipInfo->telphone = $this->telphone;
            $shopMerchShipInfo->is_default = isset($this->isdefault)? $this->isdefault : 0;
            $shopMerchShipInfo->addtime = date('Y-m-d H:i:s',time());
            return $shopMerchShipInfo->save();
        }
        return false;
    }
}
