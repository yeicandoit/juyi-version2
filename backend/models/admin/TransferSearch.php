<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\Transfer;

/**
 * TransferSearch represents the model behind the search form about `backend\models\admin\Transfer`.
 */
class TransferSearch extends Transfer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopid', 'state'], 'integer'],
            [['shopname', 'start_day', 'end_day', 'reserve1', 'reserve2', 'reserve3'], 'safe'],
            [['balance'], 'number'],
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
        $query = Transfer::find();

        // add conditions that should always apply here

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
            'shopid' => $this->shopid,
            'start_day' => $this->start_day,
            'end_day' => $this->end_day,
            'balance' => $this->balance,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'shopname', $this->shopname])
            ->andFilterWhere(['like', 'reserve1', $this->reserve1])
            ->andFilterWhere(['like', 'reserve2', $this->reserve2])
            ->andFilterWhere(['like', 'reserve3', $this->reserve3]);

        return $dataProvider;
    }
}
