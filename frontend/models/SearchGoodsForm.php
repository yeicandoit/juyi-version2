<?php
namespace frontend\models;

use yii\base\Model;
use frontend\models\JyGoods;


/**
 * Signup form
 */
class SearchGoodsForm extends Model
{
    public $searchwords;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['searchwords', 'trim'],
            ['searchwords', 'required'],
            ['searchwords', 'string', 'min' => 2, 'max' => 255],
         
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $goods = new JyGoods();
       
        
       // return $user->save() ? $user : null;
    }
}
