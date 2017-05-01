<?php

namespace frontend\models\seller;

use Yii;
use frontend\models\ShopCategoryExtend;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property string $name
 * @property string $goods_no
 * @property string $seller_id
 * @property integer $brandid
 * @property string $brandversion
 * @property string $sell_price
 * @property string $market_price
 * @property string $up_time
 * @property string $down_time
 * @property string $create_time
 * @property string $img
 * @property integer $is_del
 * @property string $keywords
 * @property string $description
 * @property string $search_words
 * @property integer $point
 * @property string $unit
 * @property integer $visit
 * @property integer $favorite
 * @property integer $comments
 * @property string $spec_array
 * @property integer $exp
 * @property integer $is_share
 * @property integer $sale
 * @property integer $grade
 * @property integer $store_nums
 * @property string $cost_price
 * @property string $model_id
 * @property string $ad_img
 * @property string $content
 * @property string $weight
 * @property integer $sort
 */
class Goods extends \yii\db\ActiveRecord
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
            [['name', 'goods_no', 'sell_price', 'market_price', 'cost_price',], 'required'],
            [['seller_id', 'brandid', 'is_del', 'point', 'visit', 'favorite', 'comments', 'exp', 'is_share', 'sale', 'grade', 'store_nums', 'model_id', 'sort'], 'integer'],
            [['sell_price', 'market_price', 'cost_price', 'weight'], 'number'],
            [['up_time', 'down_time', 'create_time'], 'safe'],
            [['spec_array', 'content'], 'string'],
            [['name', 'search_words'], 'string', 'max' => 50],
            [['goods_no'], 'string', 'max' => 20],
            [['brandversion'], 'string', 'max' => 60],
            [['img', 'keywords', 'description', 'ad_img'], 'string', 'max' => 255],
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
            'seller_id' => Yii::t('app', '卖家ID'),
            'brandid' => Yii::t('app', '品牌'),
            'brandversion' => Yii::t('app', '品牌品号'),
            'sell_price' => Yii::t('app', '销售价格'),
            'market_price' => Yii::t('app', '市场价格'),
            'up_time' => Yii::t('app', '上架时间'),
            'down_time' => Yii::t('app', '下架时间'),
            'create_time' => Yii::t('app', '创建时间'),
            'img' => Yii::t('app', '原图'),
            'is_del' => Yii::t('app', '商品状态 0正常 1已删除 2下架 3申请上架'),
            'keywords' => Yii::t('app', 'SEO关键词'),
            'description' => Yii::t('app', 'SEO描述'),
            'search_words' => Yii::t('app', '产品搜索词库,逗号分隔'),
            'point' => Yii::t('app', '积分'),
            'unit' => Yii::t('app', '计量单位'),
            'visit' => Yii::t('app', '浏览次数'),
            'favorite' => Yii::t('app', '收藏次数'),
            'comments' => Yii::t('app', '评论次数'),
            'spec_array' => Yii::t('app', '序列化存储规格,key值为规则ID，value为此商品具有的规格值'),
            'exp' => Yii::t('app', '经验值'),
            'is_share' => Yii::t('app', '共享商品 0不共享 1共享'),
            'sale' => Yii::t('app', '销量'),
            'grade' => Yii::t('app', '评分'),
            'store_nums' => Yii::t('app', '库存'),
            'cost_price' => Yii::t('app', '成本价格'),
            'model_id' => Yii::t('app', '模型ID'),
            'ad_img' => Yii::t('app', '宣传图'),
            'content' => Yii::t('app', '商品描述,已新建表'),
            'weight' => Yii::t('app', '重量'),
            'sort' => Yii::t('app', '排序'),
        ];
    }

    public function getShopCategoryExtends()
    {
        return $this->hasMany(ShopCategoryExtend::className(), ['goods_id' => 'id']);
    }

    public function saveSpec($specName, $specMktPrice, $specSellPrice)
    {
        foreach($specName as $k => $v){
            $spec = new Goodsspec();
            $spec->goodsid = $this->id;
            $spec->specname = $v;
            $spec->market_price = $specMktPrice[$k];
            $spec->sell_price = $specSellPrice[$k];
            $spec->save();
        }
    }

    public function statusText()
    {
        $data = array('0' => '上架','1' => '删除','2' => '下架','3' => '等审');
        return isset($data[$this->is_del]) ? $data[$this->is_del] : '';
    }
}
