<?php

namespace backend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AppointinfoSearch represents the model behind the search form about `backend\models\seller\Appointinfo`.
 */
class AppointinfoSearch extends Appointinfo
{
    public $good_name;
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appointid', 'goodid', 'userid', 'appointnum', 'orderstate', 'specid'], 'integer'],
            [['appointdate', 'appointslot', 'appointtime', 'good_name', 'user_name'], 'safe'],
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
        $query->joinWith(["good", 'user']);

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
        $sort = $dataProvider->getSort();
        $sort->attributes['good_name'] = [
            'asc' => ['{{%goods}}.name'=>SORT_ASC],
            'desc' => ['{{%goods}}.name'=>SORT_DESC],
        ];
        $sort->attributes['user_name'] = [
            'asc' => ['{{%user}}.username'=>SORT_ASC],
            'desc' => ['{{%user}}.username'=>SORT_DESC],
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
            'appointid' => $this->appointid,
            'goodid' => $this->goodid,
            'userid' => $this->userid,
            'appointdate' => $this->appointdate,
            'appointnum' => $this->appointnum,
            'orderstate' => $this->orderstate,
            'specid' => $this->specid,
            '{{%goods}}.seller_id' => Yii::$app->user->id,
        ]);

        $query->andFilterWhere(['like', 'appointslot', $this->appointslot])
            ->andFilterWhere(['like', 'appointtime', $this->appointtime])
            ->andFilterWhere(['like', '{{%goods}}.name', $this->good_name])
            ->andFilterWhere(['like', '{{%user}}.username', $this->user_name]);

        return $dataProvider;
    }
}
