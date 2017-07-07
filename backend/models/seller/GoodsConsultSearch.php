<?php

namespace backend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\GoodsConsult;

/**
 * GoodsConsultSearch represents the model behind the search form about `backend\models\seller\GoodsConsult`.
 */
class GoodsConsultSearch extends GoodsConsult
{
    public $good_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goodid', 'sell_id', 'del'], 'integer'],
            [['question', 'answer', 'good_name'], 'safe'],
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
        $query = GoodsConsult::find();
        $query->joinWith(['good']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '10'],
        ]);
        $sort = $dataProvider->getSort();
        $sort->attributes['good_name'] = [
            'asc' => ['{{%goods}}.name'=>SORT_ASC],
            'desc' => ['{{%goods}}.name'=>SORT_DESC],
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
            'goodid' => $this->goodid,
            'sell_id' => $this->sell_id,
            'del' => $this->del,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', '{{%goods}}.name', $this->good_name]);

        return $dataProvider;
    }
}
