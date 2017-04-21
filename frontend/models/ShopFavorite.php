<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_favorite".
 *
 * @property string $id
 * @property string $user_id
 * @property string $rid
 * @property string $time
 * @property string $summary
 * @property string $cat_id
 *
 * @property ShopUser $user
 * @property ShopGoods $r
 */
class ShopFavorite extends \yii\db\ActiveRecord
{
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
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['rid'], 'exist', 'skipOnError' => true, 'targetClass' => ShopGoods::className(), 'targetAttribute' => ['rid' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopGoods()
    {
        return $this->hasOne(ShopGoods::className(), ['id' => 'rid']);
    }
}
