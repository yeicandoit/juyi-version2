<?php

namespace frontend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\seller\ShopSpec;

/**
 * ShopSpecSearch represents the model behind the search form about `app\models\seller\ShopSpec`.
 */
class ShopSpecSearch extends ShopSpec
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'is_del', 'seller_id'], 'integer'],
            [['name', 'value', 'note'], 'safe'],
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
        $query = ShopSpec::find();

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
            'type' => $this->type,
            'is_del' => $this->is_del,
            'seller_id' => $this->seller_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
