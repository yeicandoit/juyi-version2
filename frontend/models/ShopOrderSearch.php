<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopOrder;

/**
 * ShopOrderSearch represents the model behind the search form about `app\models\ShopOrder`.
 */
class ShopOrderSearch extends ShopOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'pay_type', 'distribution', 'status', 'pay_status', 'distribution_status', 'country', 'province', 'city', 'area', 'invoice', 'if_del', 'exp', 'point', 'type', 'takeself', 'active_id', 'seller_id', 'is_checkout'], 'integer'],
            [['order_no', 'accept_name', 'postcode', 'telphone', 'address', 'mobile', 'pay_time', 'send_time', 'create_time', 'completion_time', 'postscript', 'note', 'invoice_title', 'prop', 'accept_time', 'trade_no', 'checkcode'], 'safe'],
            [['payable_amount', 'real_amount', 'payable_freight', 'real_freight', 'insured', 'pay_fee', 'taxes', 'promotions', 'discount', 'order_amount'], 'number'],
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
        $query = ShopOrder::find()->orderBy(['create_time'=>SORT_DESC]);

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
            'user_id' => $this->user_id,
            'pay_type' => $this->pay_type,
            'distribution' => $this->distribution,
            'status' => $this->status,
            'pay_status' => $this->pay_status,
            'distribution_status' => $this->distribution_status,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'payable_amount' => $this->payable_amount,
            'real_amount' => $this->real_amount,
            'payable_freight' => $this->payable_freight,
            'real_freight' => $this->real_freight,
            'pay_time' => $this->pay_time,
            'send_time' => $this->send_time,
            'create_time' => $this->create_time,
            'completion_time' => $this->completion_time,
            'invoice' => $this->invoice,
            'if_del' => $this->if_del,
            'insured' => $this->insured,
            'pay_fee' => $this->pay_fee,
            'taxes' => $this->taxes,
            'promotions' => $this->promotions,
            'discount' => $this->discount,
            'order_amount' => $this->order_amount,
            'exp' => $this->exp,
            'point' => $this->point,
            'type' => $this->type,
            'takeself' => $this->takeself,
            'active_id' => $this->active_id,
            'seller_id' => $this->seller_id,
            'is_checkout' => $this->is_checkout,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'accept_name', $this->accept_name])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'postscript', $this->postscript])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'invoice_title', $this->invoice_title])
            ->andFilterWhere(['like', 'prop', $this->prop])
            ->andFilterWhere(['like', 'accept_time', $this->accept_time])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'checkcode', $this->checkcode]);
        return $dataProvider;
    }
}
