<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $order_no
 * @property string $user_id
 * @property string $time
 * @property string $comment_time
 * @property string $contents
 * @property string $recontents
 * @property string $recomment_time
 * @property integer $point
 * @property integer $status
 * @property string $seller_id
 *
 * @property Goods $goods
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'order_no', 'user_id', 'time', 'comment_time', 'recomment_time'], 'required'],
            [['goods_id', 'user_id', 'point', 'status', 'seller_id', 'user_grade'], 'integer'],
            [['time', 'comment_time', 'recomment_time'], 'safe'],
            [['contents', 'recontents'], 'string'],
            [['order_no'], 'string', 'max' => 20],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goods_id' => Yii::t('app', '商品ID'),
            'order_no' => Yii::t('app', '订单编号'),
            'user_id' => Yii::t('app', '用户ID'),
            'time' => Yii::t('app', '购买时间'),
            'comment_time' => Yii::t('app', '评论时间'),
            'contents' => Yii::t('app', '评论内容'),
            'recontents' => Yii::t('app', '回复评论内容'),
            'recomment_time' => Yii::t('app', '回复评论时间'),
            'point' => Yii::t('app', '评论的分数'),
            'status' => Yii::t('app', '评论状态：0：未评论 1:已评论'),
            'seller_id' => Yii::t('app', '商家ID'),
            'user_grade' => Yii::t('app', '商家对用户评分'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::classname(), ['id'=>'user_id']);
    }

    public function saveRecontents()
    {
        $this->recomment_time = date('Y-m-d H:i:s',time());
        if($this->save()){
            $member = Member::findOne($this->user_id);
            if(isset($member->grade)){
                $member->grade += $this->user_grade;
            } else {
                $member->grade = $this->user_grade;
            }
            return $member->save();
        }

        return false;
    }
}
