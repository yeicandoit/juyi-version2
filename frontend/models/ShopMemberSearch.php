<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopMember;

/**
 * ShopMemberSearch represents the model behind the search form about `app\models\ShopMember`.
 */
class ShopMemberSearch extends ShopMember
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sex', 'group_id', 'exp', 'point', 'status'], 'integer'],
            [['true_name', 'telephone', 'mobile', 'area', 'contact_addr', 'qq', 'birthday', 'message_ids', 'time', 'zip', 'prop', 'last_login', 'custom', 'email'], 'safe'],
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
        $query = ShopMember::find();

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
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'group_id' => $this->group_id,
            'exp' => $this->exp,
            'point' => $this->point,
            'time' => $this->time,
            'status' => $this->status,
            'balance' => $this->balance,
            'last_login' => $this->last_login,
        ]);

        $query->andFilterWhere(['like', 'true_name', $this->true_name])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'contact_addr', $this->contact_addr])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'message_ids', $this->message_ids])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'prop', $this->prop])
            ->andFilterWhere(['like', 'custom', $this->custom])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
