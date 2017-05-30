<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%goods_consult}}".
 *
 * @property string $id
 * @property integer $goodid
 * @property string $question
 * @property string $answer
 * @property integer $sell_id
 * @property integer $del
 */
class GoodsConsult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_consult}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'goodid', 'sell_id', 'del'], 'integer'],
            [['question', 'answer'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goodid' => Yii::t('app', '商品id'),
            'question' => Yii::t('app', '问题'),
            'answer' => Yii::t('app', '答案'),
            'sell_id' => Yii::t('app', '商家id'),
            'del' => Yii::t('app', '是否已经删除'),
        ];
    }

    public function getGood()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goodid']);
    }
}
