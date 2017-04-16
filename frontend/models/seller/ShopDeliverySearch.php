<?php

namespace frontend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\seller\ShopDelivery;

/**
 * ShopDeliverySearch represents the model behind the search form about `app\models\seller\ShopDelivery`.
 */
class ShopDeliverySearch extends ShopDelivery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'first_weight', 'second_weight', 'status', 'sort', 'is_save_price', 'price_type', 'open_default', 'is_delete'], 'integer'],
            [['name', 'description', 'area_groupid', 'firstprice', 'secondprice'], 'safe'],
            [['first_price', 'second_price', 'save_rate', 'low_price'], 'number'],
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
        $query = ShopDelivery::find();

        // add conditions that should always apply here
        $this->status = 1;
        $this->is_delete = 0;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'type' => $this->type,
            'first_weight' => $this->first_weight,
            'second_weight' => $this->second_weight,
            'first_price' => $this->first_price,
            'second_price' => $this->second_price,
            'status' => $this->status,
            'sort' => $this->sort,
            'is_save_price' => $this->is_save_price,
            'save_rate' => $this->save_rate,
            'low_price' => $this->low_price,
            'price_type' => $this->price_type,
            'open_default' => $this->open_default,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'area_groupid', $this->area_groupid])
            ->andFilterWhere(['like', 'firstprice', $this->firstprice])
            ->andFilterWhere(['like', 'secondprice', $this->secondprice]);

        return $dataProvider;
    }
}
