<?php

namespace frontend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\seller\Goods;

/**
 * GoodsSearch represents the model behind the search form about `frontend\models\seller\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'brandid', 'is_del', 'point', 'visit', 'favorite', 'comments', 'exp', 'is_share', 'sale', 'grade', 'store_nums', 'model_id', 'sort'], 'integer'],
            [['name', 'goods_no', 'brandversion', 'up_time', 'down_time', 'create_time', 'img', 'keywords', 'description', 'search_words', 'unit', 'spec_array', 'ad_img', 'content'], 'safe'],
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
        $query = Goods::find();

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
            'seller_id' => $this->seller_id,
            'brandid' => $this->brandid,
            'sell_price' => $this->sell_price,
            'market_price' => $this->market_price,
            'up_time' => $this->up_time,
            'down_time' => $this->down_time,
            'create_time' => $this->create_time,
            'is_del' => $this->is_del,
            'point' => $this->point,
            'visit' => $this->visit,
            'favorite' => $this->favorite,
            'comments' => $this->comments,
            'exp' => $this->exp,
            'is_share' => $this->is_share,
            'sale' => $this->sale,
            'grade' => $this->grade,
            'store_nums' => $this->store_nums,
            'cost_price' => $this->cost_price,
            'model_id' => $this->model_id,
            'weight' => $this->weight,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'goods_no', $this->goods_no])
            ->andFilterWhere(['like', 'brandversion', $this->brandversion])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'search_words', $this->search_words])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'spec_array', $this->spec_array])
            ->andFilterWhere(['like', 'ad_img', $this->ad_img])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
