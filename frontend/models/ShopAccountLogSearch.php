<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopAccountLog;

/**
 * ShopAccountLogSearch represents the model behind the search form about `app\models\ShopAccountLog`.
 */
class ShopAccountLogSearch extends ShopAccountLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'admin_id', 'user_id', 'type', 'event'], 'integer'],
            [['time', 'note'], 'safe'],
            [['amount', 'amount_log'], 'number'],
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
        $query = ShopAccountLog::find();

        // add conditions that should always apply here

        $this->user_id = Yii::$app->user->id;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '5'],
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
            'admin_id' => $this->admin_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'event' => $this->event,
            'time' => $this->time,
            'amount' => $this->amount,
            'amount_log' => $this->amount_log,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
