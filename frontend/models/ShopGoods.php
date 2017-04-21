<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_goods".
 *
 * @property string $id
 * @property string $name
 * @property string $goods_no
 * @property string $model_id
 * @property string $sell_price
 * @property string $market_price
 * @property string $cost_price
 * @property string $up_time
 * @property string $down_time
 * @property string $create_time
 * @property integer $store_nums
 * @property string $img
 * @property string $ad_img
 * @property integer $is_del
 * @property string $content
 * @property string $keywords
 * @property string $description
 * @property string $search_words
 * @property string $weight
 * @property integer $point
 * @property string $unit
 * @property integer $brand_id
 * @property integer $visit
 * @property integer $favorite
 * @property integer $sort
 * @property string $spec_array
 * @property integer $exp
 * @property integer $comments
 * @property integer $sale
 * @property integer $grade
 * @property string $seller_id
 * @property integer $is_share
 *
 * @property ShopCategoryExtend[] $shopCategoryExtends
 * @property ShopCommendGoods[] $shopCommendGoods
 * @property ShopComment[] $shopComments
 * @property ShopDiscussion[] $shopDiscussions
 * @property ShopFavorite[] $shopFavorites
 * @property ShopGoodsAttribute[] $shopGoodsAttributes
 * @property ShopGoodsPhotoRelation[] $shopGoodsPhotoRelations
 * @property ShopGroupPrice[] $shopGroupPrices
 * @property ShopNotifyRegistry[] $shopNotifyRegistries
 * @property ShopProducts[] $shopProducts
 * @property ShopRefer[] $shopRefers
 * @property ShopRegiment[] $shopRegiments
 * @property ShopRelation[] $shopRelations
 */
class ShopGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'goods_no', 'model_id', 'sell_price', 'create_time', 'sort', 'store_nums', 'weight'], 'required'],
            [['model_id', 'store_nums', 'is_del', 'point', 'brand_id', 'visit', 'favorite', 'sort', 'exp', 'comments', 'sale', 'grade', 'seller_id', 'is_share'], 'integer'],
            [['sell_price', 'market_price', 'cost_price', 'weight'], 'number'],
            [['up_time', 'down_time', 'create_time'], 'safe'],
            [['content', 'spec_array'], 'string'],
            [['name', 'search_words'], 'string', 'max' => 50],
            [['goods_no'], 'string', 'max' => 20],
            [['img', 'ad_img', 'keywords', 'description'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '商品ID'),
            'name' => Yii::t('app', '商品名称'),
            'goods_no' => Yii::t('app', '商品的货号'),
            'model_id' => Yii::t('app', '模型ID'),
            'sell_price' => Yii::t('app', '销售价格'),
            'market_price' => Yii::t('app', '市场价格'),
            'cost_price' => Yii::t('app', '成本价格'),
            'up_time' => Yii::t('app', '上架时间'),
            'down_time' => Yii::t('app', '下架时间'),
            'create_time' => Yii::t('app', '创建时间'),
            'store_nums' => Yii::t('app', '库存'),
            'img' => Yii::t('app', '原图'),
            'ad_img' => Yii::t('app', '宣传图'),
            'is_del' => Yii::t('app', '商品状态 0正常 1已删除 2下架 3申请上架'),
            'content' => Yii::t('app', '商品描述'),
            'keywords' => Yii::t('app', 'SEO关键词'),
            'description' => Yii::t('app', 'SEO描述'),
            'search_words' => Yii::t('app', '产品搜索词库,逗号分隔'),
            'weight' => Yii::t('app', '重量'),
            'point' => Yii::t('app', '积分'),
            'unit' => Yii::t('app', '计量单位'),
            'brand_id' => Yii::t('app', '品牌ID'),
            'visit' => Yii::t('app', '浏览次数'),
            'favorite' => Yii::t('app', '收藏次数'),
            'sort' => Yii::t('app', '排序'),
            'spec_array' => Yii::t('app', '序列化存储规格,key值为规则ID，value为此商品具有的规格值'),
            'exp' => Yii::t('app', '经验值'),
            'comments' => Yii::t('app', '评论次数'),
            'sale' => Yii::t('app', '销量'),
            'grade' => Yii::t('app', '评分总数'),
            'seller_id' => Yii::t('app', '卖家ID'),
            'is_share' => Yii::t('app', '共享商品 0不共享 1共享'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopCategoryExtends()
    {
        return $this->hasMany(ShopCategoryExtend::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopCommendGoods()
    {
        return $this->hasMany(ShopCommendGoods::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopComments()
    {
        return $this->hasMany(ShopComment::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDiscussions()
    {
        return $this->hasMany(ShopDiscussion::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopFavorites()
    {
        return $this->hasMany(ShopFavorite::className(), ['rid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopGoodsAttributes()
    {
        return $this->hasMany(ShopGoodsAttribute::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopGoodsPhotoRelations()
    {
        return $this->hasMany(ShopGoodsPhotoRelation::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopGroupPrices()
    {
        return $this->hasMany(ShopGroupPrice::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopNotifyRegistries()
    {
        return $this->hasMany(ShopNotifyRegistry::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopProducts()
    {
        return $this->hasMany(ShopProducts::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopRefers()
    {
        return $this->hasMany(ShopRefer::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopRegiments()
    {
        return $this->hasMany(ShopRegiment::className(), ['goods_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopRelations()
    {
        return $this->hasMany(ShopRelation::className(), ['goods_id' => 'id']);
    }

    public function statusText()
    {
        $data = array('0' => '上架','1' => '删除','2' => '下架','3' => '等审');
        return isset($data[$this->is_del]) ? $data[$this->is_del] : '';
    }

    public function saveCat($cats)
    {
        //First delete old categories;
        foreach($this->shopCategoryExtends as $key=> $catExt){
            $catExt->delete();
        }
        //Then save new categories;
        foreach($cats as $key=>$val){
            $catExt = new ShopCategoryExtend();
            $catExt->goods_id = $this->id;
            $catExt->category_id = $val;
            $catExt->save();
        }

        return true;
    }
}
