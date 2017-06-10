<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\Appointinfo;

/**
 * AppointinfoSearch represents the model behind the search form about `backend\models\seller\Appointinfo`.
 */
class AppointinfoSearch extends Appointinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appointid', 'goodid', 'userid', 'appointnum', 'orderstate', 'specid'], 'integer'],
            [['appointdate', 'appointslot', 'appointtime'], 'safe'],
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
        $query = Appointinfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder' => [
                    'appointdate' => SORT_DESC,
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
            'appointid' => $this->appointid,
            'goodid' => $this->goodid,
            'userid' => $this->userid,
            'appointdate' => $this->appointdate,
            'appointnum' => $this->appointnum,
            'orderstate' => $this->orderstate,
            'specid' => $this->specid,
        ]);

        $query->andFilterWhere(['like', 'appointslot', $this->appointslot])
            ->andFilterWhere(['like', 'appointtime', $this->appointtime]);

        return $dataProvider;
    }
}
