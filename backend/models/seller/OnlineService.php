<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%shop_service}}".
 *
 * @property string $id
 * @property string $qq
 * @property integer $seller_id
 */
class OnlineService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%online_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qq', 'seller_id'], 'required'],
            ['seller_id', 'integer'],
            ['qq', 'string', 'max' => 256],
            ['name', 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'qq' => Yii::t('app', 'QQ'),
            'seller_id' => Yii::t('app', '商家ID'),
            'name' => Yii::t('app', '客服名称'),
        ];
    }

    public static function addQQ($seller_id, $names, $qqs)
    {
        foreach($names as $key => $name){
            $serv = OnlineService::find()->where(['seller_id'=>$seller_id, 'name'=>trim($name), 'qq'=>trim($qqs[$key])])->one();
            if(!isset($serv)){
                $serv = new OnlineService();
                $serv->qq = $qqs[$key];
                $serv->seller_id = $seller_id;
                $serv->name = $name;
                if(!$serv->save()){
                    return false;
                }
            }
        }
        return true;
    }
}
