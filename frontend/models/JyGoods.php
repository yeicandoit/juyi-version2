<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jy_goods".
 *
 * @property string $id
 * @property string $name
 * @property string $affiliation
 * @property string $affiliationtype
 * @property string $goodtype
 * @property string $goods_no
 * @property string $qualification
 * @property string $area
 * @property string $brand
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
 */
class JyGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'goods_no', 'model_id', 'sell_price', 'create_time'], 'required'],
            [['model_id', 'store_nums', 'is_del', 'point', 'brand_id', 'visit', 'favorite', 'sort', 'exp', 'comments', 'sale', 'grade', 'seller_id', 'is_share'], 'integer'],
            [['sell_price', 'market_price', 'cost_price', 'weight'], 'number'],
            [['up_time', 'down_time', 'create_time'], 'safe'],
            [['content', 'spec_array'], 'string'],
            [['name', 'search_words'], 'string', 'max' => 50],
            [['affiliation', 'goods_no'], 'string', 'max' => 20],
            [['affiliationtype', 'area'], 'string', 'max' => 8],
            [['goodtype', 'unit'], 'string', 'max' => 10],
            [['qualification'], 'string', 'max' => 16],
            [['brand'], 'string', 'max' => 30],
            [['img', 'ad_img', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'affiliation' => 'Affiliation',
            'affiliationtype' => 'Affiliationtype',
            'goodtype' => 'Goodtype',
            'goods_no' => 'Goods No',
            'qualification' => 'Qualification',
            'area' => 'Area',
            'brand' => 'Brand',
            'model_id' => 'Model ID',
            'sell_price' => 'Sell Price',
            'market_price' => 'Market Price',
            'cost_price' => 'Cost Price',
            'up_time' => 'Up Time',
            'down_time' => 'Down Time',
            'create_time' => 'Create Time',
            'store_nums' => 'Store Nums',
            'img' => 'Img',
            'ad_img' => 'Ad Img',
            'is_del' => 'Is Del',
            'content' => 'Content',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'search_words' => 'Search Words',
            'weight' => 'Weight',
            'point' => 'Point',
            'unit' => 'Unit',
            'brand_id' => 'Brand ID',
            'visit' => 'Visit',
            'favorite' => 'Favorite',
            'sort' => 'Sort',
            'spec_array' => 'Spec Array',
            'exp' => 'Exp',
            'comments' => 'Comments',
            'sale' => 'Sale',
            'grade' => 'Grade',
            'seller_id' => 'Seller ID',
            'is_share' => 'Is Share',
        ];
    }
}
