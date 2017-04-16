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
class UserDetailForm extends Model
{

    public $duration = true;
    public $consignee;
    public $province;
    public $city;
    public $country;
    public $created_at;

    public $score;

    //for userchpwd view
    public $oldpwd;
    public $newpwd;
    public $cfmnewpwd;

    //for userinfo view
    public $loginName;
    public $trueName;
    public $birthday;
    public $gender;
    public $contactAddr;
    public $mobile;
    public $email;
    public $zip;
    public $qq;

    //for useraddr view
    public $acceptName;
    public $acceptProvince;
    public $acceptCity;
    public $acceptCountry;
    public $acceptDetailAddr;
    public $acceptZip;
    public $acceptTelephone;
    public $acceptMobile;
    public $acceptIsDefault;



    private $_user = false;
    private $_member = false;
    private $_acceptaddr = false;

    const ViewScore = 'viewscore';
    const ViewChpwd = 'viewchpwd';
    const ViewInfo = 'viewinfo';
    const ViewAddr = 'viewaddr';

    public function __construct($view)
    {
        parent::__construct();
        if (self::ViewScore == $view) {
            $this->score = ShopMember::findOne(Yii::$app->user->id)->point;
        } else if (self::ViewChpwd == $view) {
            $this->_user = User::findOne(Yii::$app->user->id);
        } else if (self::ViewInfo == $view) {
            $this->_user = User::findOne(Yii::$app->user->id);
            $this->_member = ShopMember::findOne(Yii::$app->user->id);

            if($this->_user) {
                $this->loginName = $this->_user->username;
            }
            if($this->_member) {
                $this->trueName = $this->_member->true_name;
                $this->birthday = $this->_member->birthday;
                $this->gender = $this->_member->sex;
                $this->contactAddr = $this->_member->contact_addr;
                $this->mobile = $this->_member->mobile;
                $this->email = $this->_member->email;
                $this->zip = $this->_member->zip;
                $this->qq = $this->_member->qq;
                $area = explode(',', $this->_member->area);
                if (count($area) >= 4) {
                    $this->province = $area[1];
                    $this->city = $area[2];
                    $this->country = $area[3];
                }
            }
        } else if(self::ViewAddr == $view) {
            //Nothing to do
        }
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //for userchpwd view
            ['oldpwd', 'required'],
            ['oldpwd', 'validateOldpwd'],
            ['newpwd', 'required'],
            ['newpwd', 'string', 'min' => 6, 'max' => 32],
            ['cfmnewpwd', 'required'],
            ['cfmnewpwd', 'compare', 'compareAttribute'=> 'newpwd'],

            //for userinfo view
            [['province', 'city', 'country', 'loginName',
            'trueName', 'birthday', 'gender', 'contactAddr', 'mobile',
            'email', 'zip', 'qq'], 'safe'],

            //for useraddr view
            [['acceptName','acceptProvince', 'acceptCity','acceptCountry','acceptDetailAddr'],'required'],
            [[ 'acceptZip','acceptTelephone','acceptMobile', 'acceptIsDefault'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldpwd' => Yii::t('app', '原密码'),
            'newpwd' => Yii::t('app', '新密码'),
            'cfmnewpwd' => Yii::t('app', '确认新密码'),
        ];
    }

    public function validateOldpwd($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if($this->_user){
                if(!$this->_user->validatePassword(md5($this->oldpwd))) {
                    $this->addError($attribute, '原密码错误.');
                }
            } else{
                $this->addError($attribute, '登陆超时，请重新登陆.');
            }
        }
    }

    public function saveNewpwd()
    {
        if($this->validate() && $this->_user) {
            $this->_user->password = md5($this->newpwd);
            return $this->_user->save();
        }

        return false;
    }

    public function saveInfo()
    {
        if($this->_member) {
            $this->_member->true_name = $this->trueName;
            $this->_member->birthday = $this->birthday;
            $this->_member->sex = $this->gender;
            $this->_member->contact_addr = $this->contactAddr;
            $this->_member->mobile = $this->mobile;
            $this->_member->email = $this->email;
            $this->_member->zip = $this->zip;
            $this->_member->qq = $this->qq;
            $this->_member->area = "," . $this->province . "," . $this->city . "," . $this->country . ",";

            return $this->_member->update();
        }

        Yii::info("_member is false");
        return false;
    }

    public function saveAccetpAddr()
    {
        $this->_acceptaddr = new ShopAddress();
        if($this->_acceptaddr){
            $this->_acceptaddr->user_id = Yii::$app->user->id;
            $this->_acceptaddr->accept_name = $this->acceptName;
            $this->_acceptaddr->province = $this->acceptProvince;
            $this->_acceptaddr->city = $this->acceptCity;
            $this->_acceptaddr->area = $this->acceptCountry;
            $this->_acceptaddr->address = $this->acceptDetailAddr;
            $this->_acceptaddr->zip = $this->acceptZip;
            $this->_acceptaddr->telphone = $this->acceptTelephone;
            $this->_acceptaddr->mobile = $this->acceptMobile;
            $this->_acceptaddr->is_default = $this->acceptIsDefault;

            return $this->_acceptaddr->insert();
        }

        Yii::info("_acceptaddr is false");
        return false;
    }
}
