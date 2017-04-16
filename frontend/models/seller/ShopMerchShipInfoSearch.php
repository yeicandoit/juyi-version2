<?php

namespace frontend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\seller\ShopMerchShipInfo;

/**
 * ShopMerchShipInfoSearch represents the model behind the search form about `app\models\seller\ShopMerchShipInfo`.
 */
class ShopMerchShipInfoSearch extends ShopMerchShipInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'country', 'province', 'city', 'area', 'is_default', 'is_del', 'seller_id'], 'integer'],
            [['ship_name', 'ship_user_name', 'postcode', 'address', 'mobile', 'telphone', 'note', 'addtime'], 'safe'],
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
        $query = ShopMerchShipInfo::find();

        // add conditions that should always apply here
        $this->seller_id = Yii::$app->user->id;

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
            'sex' => $this->sex,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'is_default' => $this->is_default,
            'addtime' => $this->addtime,
            'is_del' => $this->is_del,
            'seller_id' => $this->seller_id,
        ]);

        $query->andFilterWhere(['like', 'ship_name', $this->ship_name])
            ->andFilterWhere(['like', 'ship_user_name', $this->ship_user_name])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
