<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\TransferLog;

/**
 * TransferLogSearch represents the model behind the search form about `backend\models\admin\TransferLog`.
 */
class TransferLogSearch extends TransferLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shopid', 'account_type'], 'integer'],
            [['shopname', 'start_day', 'end_day', 'account_no', 'jy_trade_no', 'trade_no', 'time', 'reserve1', 'reserve2', 'reserve3'], 'safe'],
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
        $query = TransferLog::find();

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
            'shopid' => $this->shopid,
            'start_day' => $this->start_day,
            'end_day' => $this->end_day,
            'balance' => $this->balance,
            'account_type' => $this->account_type,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'shopname', $this->shopname])
            ->andFilterWhere(['like', 'account_no', $this->account_no])
            ->andFilterWhere(['like', 'jy_trade_no', $this->jy_trade_no])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'reserve1', $this->reserve1])
            ->andFilterWhere(['like', 'reserve2', $this->reserve2])
            ->andFilterWhere(['like', 'reserve3', $this->reserve3]);

        return $dataProvider;
    }
}
