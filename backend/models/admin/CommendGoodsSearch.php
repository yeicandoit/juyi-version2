<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\CommendGoods;

/**
 * CommendGoodsSearch represents the model behind the search form about `backend\models\admin\CommendGoods`.
 */
class CommendGoodsSearch extends CommendGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'commend_id', 'type'], 'integer'],
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
        $query = CommendGoods::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'commend_id' => $this->commend_id,
            'type' => $this->type,
        ]);

        return $dataProvider;
    }
}