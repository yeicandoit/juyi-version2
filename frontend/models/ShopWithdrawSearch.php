<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopWithdraw;

/**
 * ShopWithdrawSearch represents the model behind the search form about `app\models\ShopWithdraw`.
 */
class ShopWithdrawSearch extends ShopWithdraw
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'is_del'], 'integer'],
            [['time', 'name', 'note', 're_note'], 'safe'],
            [['amount'], 'number'],
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
        $query = ShopWithdraw::find();

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
            'user_id' => $this->user_id,
            'time' => $this->time,
            'amount' => $this->amount,
            'status' => $this->status,
            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 're_note', $this->re_note]);

        return $dataProvider;
    }
}
