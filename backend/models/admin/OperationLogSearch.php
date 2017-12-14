<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\OperationLog;

/**
 * OperationLogSearch represents the model behind the search form about `backend\models\admin\OperationLog`.
 */
class OperationLogSearch extends OperationLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'element_id', 'user_id'], 'integer'],
            [['table_name', 'operation_type', 'operation_time'], 'safe'],
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
        $query = OperationLog::find();

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
            'element_id' => $this->element_id,
            'user_id' => $this->user_id,
            'operation_time' => $this->operation_time,
        ]);

        $query->andFilterWhere(['like', 'table_name', $this->table_name])
            ->andFilterWhere(['like', 'operation_type', $this->operation_type]);

        return $dataProvider;
    }
}
