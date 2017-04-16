<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShopFavorite;

/**
 * ShopFavoriteSearch represents the model behind the search form about `app\models\ShopFavorite`.
 */
class ShopFavoriteSearch extends ShopFavorite
{
    //public $prodName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'rid', 'cat_id'], 'integer'],
            [['time', 'summary'], 'safe'],
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
        $query = ShopFavorite::find();

        // add conditions that should always apply here

        $this->user_id = Yii::$app->user->id;
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
            'rid' => $this->rid,
            'time' => $this->time,
            'cat_id' => $this->cat_id,
        ]);

        $query->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
