<?php

namespace backend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\seller\Order`.
 */
class OrderSearch extends Order
{
    public $user_name;
    public $order_type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'seller_id', 'appointid', 'pay_type', 'invoice', 'status', 'pay_status',
                'distribution_status', 'sendbackornot', 'country', 'province', 'city', 'area', 'distribution',
                'if_del', 'exp', 'point', 'type', 'takeself', 'active_id', 'is_checkout'], 'integer'],
            [['order_no', 'invoice_title', 'create_time', 'postscript', 'accept_name', 'telphone', 'postcode',
                'address', 'completion_time', 'mobile', 'pay_time', 'send_time', 'note', 'prop', 'accept_time',
                'trade_no', 'checkcode', 'user_name', 'order_type'], 'safe'],
            [['payable_amount', 'payable_freight', 'real_amount', 'real_freight', 'insured', 'pay_fee', 'taxes',
                'promotions', 'discount', 'order_amount'], 'number'],
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
        $query = Order::find();
        $query->joinWith(['user']);
        $query->joinWith(['shopMember']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ]
            ],
            'pagination' => ['pagesize' => '10'],
        ]);
        $sort = $dataProvider->getSort();
        $sort->attributes['user_name'] = [
            'asc' => ['{{%user}}.username'=>SORT_ASC],
            'desc' => ['{{%user}}.username'=>SORT_DESC],
        ];
        $sort->attributes['order_type'] = [
            'asc' => ['{{%shop_member}}.regtype'=>SORT_ASC],
            'desc' => ['{{%shop_member}}.regtype'=>SORT_DESC],
        ];
        $dataProvider->setSort($sort);

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
            'seller_id' => $this->seller_id,
            'appointid' => $this->appointid,
            'pay_type' => $this->pay_type,
            'invoice' => $this->invoice,
            '{{%order}}.status' => $this->status,
            'pay_status' => $this->pay_status,
            'distribution_status' => $this->distribution_status,
            'create_time' => $this->create_time,
            'payable_amount' => $this->payable_amount,
            'sendbackornot' => $this->sendbackornot,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'completion_time' => $this->completion_time,
            'payable_freight' => $this->payable_freight,
            'real_amount' => $this->real_amount,
            'distribution' => $this->distribution,
            'real_freight' => $this->real_freight,
            'pay_time' => $this->pay_time,
            'send_time' => $this->send_time,
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
            'is_checkout' => $this->is_checkout,
            '{{%shop_member}}.regtype'=>$this->order_type,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'invoice_title', $this->invoice_title])
            ->andFilterWhere(['like', 'postscript', $this->postscript])
            ->andFilterWhere(['like', 'accept_name', $this->accept_name])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'prop', $this->prop])
            ->andFilterWhere(['like', 'accept_time', $this->accept_time])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'checkcode', $this->checkcode])
            ->andFilterWhere(['like', '{{%user}}.username', $this->user_name]);

        return $dataProvider;
    }
}
