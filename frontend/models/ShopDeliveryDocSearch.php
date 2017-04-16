<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopDeliveryDoc;

/**
 * ShopDeliveryDocSearch represents the model behind the search form about `app\models\ShopDeliveryDoc`.
 */
class ShopDeliveryDocSearch extends ShopDeliveryDoc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'user_id', 'admin_id', 'seller_id', 'country', 'province', 'city', 'area', 'if_del', 'freight_id'], 'integer'],
            [['name', 'postcode', 'telphone', 'address', 'mobile', 'time', 'delivery_code', 'delivery_type', 'note'], 'safe'],
            [['freight'], 'number'],
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
        $query = ShopDeliveryDoc::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '5'],
            'sort' => false,
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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'admin_id' => $this->admin_id,
            'seller_id' => $this->seller_id,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'time' => $this->time,
            'freight' => $this->freight,
            'if_del' => $this->if_del,
            'freight_id' => $this->freight_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'delivery_code', $this->delivery_code])
            ->andFilterWhere(['like', 'delivery_type', $this->delivery_type])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
