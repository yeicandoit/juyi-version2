<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\Seller;

/**
 * SellerSearch represents the model behind the search form about `backend\models\seller\Seller`.
 */
class SellerSearch extends Seller
{
    public $type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country', 'province', 'city', 'area', 'grade', 'comments', 'sale', 'sort', 'is_lock', 'is_del', 'is_vip'], 'integer'],
            [['seller_name', 'true_name', 'affliation', 'affliationtype', 'login_time', 'phone', 'email', 'mobile',
                'server_num', 'password', 'paper_img', 'create_time', 'address', 'account', 'qualification', 'logo',
                'seller_message_ids', 'home_url', 'type'], 'safe'],
            [['cash', 'tax'], 'number'],
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
        $query = Seller::find();
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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'login_time' => $this->login_time,
            'country' => $this->country,
            'cash' => $this->cash,
            'create_time' => $this->create_time,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'grade' => $this->grade,
            'comments' => $this->comments,
            'sale' => $this->sale,
            'sort' => $this->sort,
            'is_lock' => $this->is_lock,
            'tax' => $this->tax,
            'is_del' => $this->is_del,
            'is_vip' => $this->is_vip,
        ]);

        $query->andFilterWhere(['like', 'seller_name', $this->seller_name])
            ->andFilterWhere(['like', 'true_name', $this->true_name])
            ->andFilterWhere(['like', 'affliation', $this->affliation])
            ->andFilterWhere(['like', 'affliationtype', $this->affliationtype])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'server_num', $this->server_num])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'paper_img', $this->paper_img])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'seller_message_ids', $this->seller_message_ids])
            ->andFilterWhere(['like', 'home_url', $this->home_url])
            ->andFilterWhere(['like', '{{%shop_member}}.regtype', $this->type]);

        return $dataProvider;
    }
}
