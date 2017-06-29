<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%favorite}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $rid
 * @property string $time
 * @property string $summary
 * @property string $cat_id
 *
 */
class Favorite extends \yii\db\ActiveRecord
{
    const CatTestGood = 1;
    const CatExpert = 2;
    const CatResearch = 3;
    const CatSimulate = 4;
    const CatShop = 5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'rid', 'time', 'cat_id'], 'required'],
            [['user_id', 'rid', 'cat_id'], 'integer'],
            [['time'], 'safe'],
            [['summary'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', '用户ID'),
            'rid' => Yii::t('app', '商品ID'),
            'time' => Yii::t('app', '收藏时间'),
            'summary' => Yii::t('app', '备注'),
            'cat_id' => Yii::t('app', '商品分类'),
        ];
    }

    public static function favorite($id, $type, $cat)
    {
        if(1 == $type){
            //If have concerned, return true directly
            if(Favorite::find()->where(['user_id'=>Yii::$app->user->id, 'rid'=>$id, 'cat_id'=>$cat])->one()){
                return true;
            } else {
                $f = new Favorite();
                $f->user_id = Yii::$app->user->id;
                $f->rid = $id;
                $f->time = date('Y-m-d H:i:s', time());
                $f->cat_id = $cat;
                return $f->save();
            }
        } else {
            $f = Favorite::find()->where(['user_id'=>Yii::$app->user->id, 'rid'=>$id, 'cat_id'=>$cat])->one();
            if($f) {
                return $f->delete();
            } else {
                return true;
            }
        }
    }
}
