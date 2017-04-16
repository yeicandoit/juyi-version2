<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopOrderLog;

/**
 * ShopOrderLogSearch represents the model behind the search form about `app\models\ShopOrderLog`.
 */
class ShopOrderLogSearch extends ShopOrderLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id'], 'integer'],
            [['user', 'action', 'addtime', 'result', 'note'], 'safe'],
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
        $query = ShopOrderLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'addtime' => $this->addtime,
        ]);

        $query->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
