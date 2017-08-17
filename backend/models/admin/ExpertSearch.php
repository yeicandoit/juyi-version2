<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\Expert;

/**
 * ExpertSearch represents the model behind the search form about `backend\models\seller\Expert`.
 */
class ExpertSearch extends Expert
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age', 'sex', 'country', 'province', 'city', 'area', 'grade', 'comments'], 'integer'],
            [['name', 'true_name', 'password', 'regedittime', 'logintime', 'degree', 'title', 'mobile', 'server_num', 'email', 'address', 'account', 'home_url', 'img', 'affliation', 'affliationtype'], 'safe'],
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
        $query = Expert::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder' => [
                    'id' => SORT_DESC,
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
            'regedittime' => $this->regedittime,
            'logintime' => $this->logintime,
            'age' => $this->age,
            'sex' => $this->sex,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
            'grade' => $this->grade,
            'comments' => $this->comments,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'true_name', $this->true_name])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'degree', $this->degree])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'server_num', $this->server_num])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'home_url', $this->home_url])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'affliation', $this->affliation])
            ->andFilterWhere(['like', 'affliationtype', $this->affliationtype]);

        return $dataProvider;
    }
}
