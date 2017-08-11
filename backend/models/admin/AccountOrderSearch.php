<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\AccountOrder;

/**
 * AccountOrderSearch represents the model behind the search form about `backend\models\admin\AccountOrder`.
 */
class AccountOrderSearch extends AccountOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'type', 'inorout', 'state', 'adminid'], 'integer'],
            [['account_no', 'name', 'trade_no', 'order_no', 'time'], 'safe'],
            [['number'], 'number'],
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
        $query = AccountOrder::find();

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
            'id' => $this->id,
            'userid' => $this->userid,
            'number' => $this->number,
            'time' => $this->time,
            'type' => $this->type,
            'inorout' => $this->inorout,
            'state' => $this->state,
            'adminid' => $this->adminid,
        ]);

        $query->andFilterWhere(['like', 'account_no', $this->account_no])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'order_no', $this->order_no]);

        return $dataProvider;
    }
}
