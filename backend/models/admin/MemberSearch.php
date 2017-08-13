<?php

namespace backend\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\seller\Member;

/**
 * MemberSearch represents the model behind the search form about `backend\models\seller\Member`.
 */
class MemberSearch extends Member
{
    public $user_name;
    public $created_at;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sex', 'group_id', 'exp', 'point', 'grade', 'status', 'country', 'province', 'city', 'area'], 'integer'],
            [['true_name', 'telephone', 'mobile', 'contact_addr', 'qq', 'birthday', 'message_ids', 'time', 'zip',
                'prop', 'last_login', 'custom', 'email', 'affliation', 'user_name','created_at'], 'safe'],
            [['balance'], 'number'],
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
        $query = Member::find();
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '10'],
            'sort'=>[
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        $sort = $dataProvider->getSort();
        $sort->attributes['user_name'] = [
            'asc' => ['{{%user}}.username'=>SORT_ASC],
            'desc' => ['{{%user}}.username'=>SORT_DESC],
        ];
        $sort->attributes['created_at'] = [
            'asc' => ['{{%user}}.created_at'=>SORT_ASC],
            'desc' => ['{{%user}}.created_at'=>SORT_DESC],
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
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'group_id' => $this->group_id,
            'exp' => $this->exp,
            'point' => $this->point,
            'grade' => $this->grade,
            'time' => $this->time,
            'status' => $this->status,
            'balance' => $this->balance,
            'last_login' => $this->last_login,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'area' => $this->area,
        ]);

        $query->andFilterWhere(['like', 'true_name', $this->true_name])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'contact_addr', $this->contact_addr])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'message_ids', $this->message_ids])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'prop', $this->prop])
            ->andFilterWhere(['like', 'custom', $this->custom])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'affliation', $this->affliation])
            ->andFilterWhere(['like', '{{%user}}.username', $this->user_name])
            ->andFilterWhere(['like', '{{%user}}.created_at', $this->created_at]);

        return $dataProvider;
    }
}
