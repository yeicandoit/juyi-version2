<?php

namespace backend\models\seller;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShopComment;

/**
 * ShopCommentSearch represents the model behind the search form about `app\models\ShopComment`.
 */
class CommentSearch extends Comment
{
    public $user_name;
    public $goods_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goods_id', 'user_id', 'point', 'status', 'seller_id'], 'integer'],
            [['order_no', 'time', 'comment_time', 'contents', 'recontents', 'recomment_time', 'user_name', 'goods_name'], 'safe'],
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
        $query = Comment::find();
        $query->joinWith(['user', 'goods']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder' => [
                    'comment_time' => SORT_DESC,
                ]
            ],
            'pagination' => ['pagesize' => '10'],
        ]);
        $sort = $dataProvider->getSort();
        $sort->attributes['user_name'] = [
            'asc' => ['{{%user}}.username'=>SORT_ASC],
            'desc' => ['{{%user}}.username'=>SORT_DESC],
        ];
        $sort->attributes['goods_name'] = [
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
            'goods_id' => $this->goods_id,
            'user_id' => $this->user_id,
            'time' => $this->time,
            'comment_time' => $this->comment_time,
            'recomment_time' => $this->recomment_time,
            'point' => $this->point,
            'status' => $this->status,
            '{{%comment}}.seller_id' => $this->seller_id,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'contents', $this->contents])
            ->andFilterWhere(['like', 'recontents', $this->recontents])
            ->andFilterWhere(['like', '{{%user}}.username', $this->user_name])
            ->andFilterWhere(['like', '{{%goods}}.name', $this->goods_name]);

        return $dataProvider;
    }
}
