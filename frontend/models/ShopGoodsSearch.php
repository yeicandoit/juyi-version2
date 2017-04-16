<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopGoods;

/**
 * ShopGoodsSearch represents the model behind the search form about `app\models\ShopGoods`.
 */
class ShopGoodsSearch extends ShopGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'store_nums', 'is_del', 'point', 'brand_id', 'visit', 'favorite', 'sort', 'exp', 'comments', 'sale', 'grade', 'seller_id', 'is_share'], 'integer'],
            [['name', 'goods_no', 'up_time', 'down_time', 'create_time', 'img', 'ad_img', 'content', 'keywords', 'description', 'search_words', 'unit', 'spec_array'], 'safe'],
            [['sell_price', 'market_price', 'cost_price', 'weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShopGoods::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false,
            'pagination' => ['pagesize' => '10'],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'model_id' => $this->model_id,
            'sell_price' => $this->sell_price,
            'market_price' => $this->market_price,
            'cost_price' => $this->cost_price,
            'up_time' => $this->up_time,
            'down_time' => $this->down_time,
            'create_time' => $this->create_time,
            'store_nums' => $this->store_nums,
            'is_del' => $this->is_del,
            'weight' => $this->weight,
            'point' => $this->point,
            'brand_id' => $this->brand_id,
            'visit' => $this->visit,
            'favorite' => $this->favorite,
            'sort' => $this->sort,
            'exp' => $this->exp,
            'comments' => $this->comments,
            'sale' => $this->sale,
            'grade' => $this->grade,
            'seller_id' => $this->seller_id,
            'is_share' => $this->is_share,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'goods_no', $this->goods_no])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'ad_img', $this->ad_img])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'search_words', $this->search_words])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'spec_array', $this->spec_array]);

        return $dataProvider;
    }
}
