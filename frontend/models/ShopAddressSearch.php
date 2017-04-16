<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopAddress;

/**
 * ShopAddressSearch represents the model behind the search form about `app\models\ShopAddress`.
 */
class ShopAddressSearch extends ShopAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'country', 'province', 'city', 'area', 'is_default'], 'integer'],
            [['accept_name', 'zip', 'telphone', 'address', 'mobile'], 'safe'],
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
        $query = ShopAddress::find();
        $this->user_id = Yii::$app->user->id;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '10']
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
            'user_id' => $this->user_id,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'is_default' => $this->is_default,
        ]);

        $query->andFilterWhere(['like', 'accept_name', $this->accept_name])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
