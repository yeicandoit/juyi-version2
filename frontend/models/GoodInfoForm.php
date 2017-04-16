<?php
namespace frontend\models;

use yii\base\Model;


//use frontend\models\User;


/**
 * Signup form
 */
class GoodInfoForm extends Model
{
    public $number;

    
    //for test



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            

            ['number', 'trim'],
            ['number', 'required'],
            ['number', 'string', 'min' => 0],
          
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    /*
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password=$this->password;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    */
}
