<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopPointLog;

/**
 * ShopPointLogSearch represents the model behind the search form about `app\models\ShopPointLog`.
 */
class ShopPointLogSearch extends ShopPointLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'value'], 'integer'],
            [['datetime', 'intro'], 'safe'],
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
        //TODO set user_id by $app->user->id
        //$this->user_id = Yii::$app->user->id;
        $this->user_id = 2;

        $query = ShopPointLog::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'datetime' => $this->datetime,
            'value' => $this->value,
        ]);

        $query->andFilterWhere(['like', 'intro', $this->intro]);

        return $dataProvider;
    }
}
