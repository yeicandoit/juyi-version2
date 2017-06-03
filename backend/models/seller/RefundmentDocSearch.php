<?php

namespace backend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\RefundmentDoc;

/**
 * RefundmentDocSearch represents the model behind the search form about `backend\models\seller\RefundmentDoc`.
 */
class RefundmentDocSearch extends RefundmentDoc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'user_id', 'admin_id', 'pay_status', 'if_del', 'seller_id', 'reason'], 'integer'],
            [['order_no', 'time', 'content', 'dispose_time', 'dispose_idea', 'order_goods_id', 'way'], 'safe'],
            [['amount'], 'number'],
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
        $query = RefundmentDoc::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder' => [
                    'time' => SORT_DESC,
                ]
            ],
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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'time' => $this->time,
            'admin_id' => $this->admin_id,
            'pay_status' => $this->pay_status,
            'dispose_time' => $this->dispose_time,
            'if_del' => $this->if_del,
            'seller_id' => $this->seller_id,
            'reason' => $this->reason,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'dispose_idea', $this->dispose_idea])
            ->andFilterWhere(['like', 'order_goods_id', $this->order_goods_id])
            ->andFilterWhere(['like', 'way', $this->way]);

        return $dataProvider;
    }
}
