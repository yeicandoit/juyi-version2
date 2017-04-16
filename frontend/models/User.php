<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $head_ico
 *
 * @property ShopAccountLog[] $shopAccountLogs
 * @property ShopAddress[] $shopAddresses
 * @property ShopFavorite[] $shopFavorites
 * @property ShopFindPassword[] $shopFindPasswords
 * @property ShopGoodsCar[] $shopGoodsCars
 * @property ShopMember $shopMember
 * @property ShopOauthUser[] $shopOauthUsers
 * @property ShopOnlineRecharge[] $shopOnlineRecharges
 * @property ShopPointLog[] $shopPointLogs
 * @property ShopSuggestion[] $shopSuggestions
 * @property ShopWithdraw[] $shopWithdraws
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['head_ico'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', '用户名'),
            'password' => Yii::t('app', '密码'),
            'head_ico' => Yii::t('app', '头像'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->authKey;
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopAccountLogs()
    {
        return $this->hasMany(ShopAccountLog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopAddresses()
    {
        return $this->hasMany(ShopAddress::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopFavorites()
    {
        return $this->hasMany(ShopFavorite::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopFindPasswords()
    {
        return $this->hasMany(ShopFindPassword::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopGoodsCars()
    {
        return $this->hasMany(ShopGoodsCar::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopMember()
    {
        return $this->hasOne(ShopMember::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOauthUsers()
    {
        return $this->hasMany(ShopOauthUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOnlineRecharges()
    {
        return $this->hasMany(ShopOnlineRecharge::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopPointLogs()
    {
        return $this->hasMany(ShopPointLog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopSuggestions()
    {
        return $this->hasMany(ShopSuggestion::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopWithdraws()
    {
        return $this->hasMany(ShopWithdraw::className(), ['user_id' => 'id']);
    }
}
