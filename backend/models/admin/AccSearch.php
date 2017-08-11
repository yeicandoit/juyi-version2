<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\admin\Acc;

/**
 * AccSearch represents the model behind the search form about `backend\models\admin\Acc`.
 */
class AccSearch extends Acc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'lastorderno', 'state', 'type', 'operatorid'], 'integer'],
            [['username', 'paypasswd', 'lasttime'], 'safe'],
            [['balance', 'lastnum'], 'number'],
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
        $query = Acc::find();

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
            'userid' => $this->userid,
            'balance' => $this->balance,
            'lasttime' => $this->lasttime,
            'lastnum' => $this->lastnum,
            'lastorderno' => $this->lastorderno,
            'state' => $this->state,
            'type' => $this->type,
            'operatorid' => $this->operatorid,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'paypasswd', $this->paypasswd]);

        return $dataProvider;
    }
}
