<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%lab_info}}".
 *
 * @property integer $id
 * @property integer $seller_id
 * @property string $description
 * @property string $team
 * @property string $outwork
 * @property string $reserve1
 * @property string $reserve2
 */
class LabInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lab_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_id'], 'required'],
            [['seller_id'], 'integer'],
            [['description', 'team', 'outwork', 'reserve1', 'reserve2'], 'string', 'max' => 512],
            [['seller_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'seller_id' => Yii::t('app', '实验室id'),
            'description' => Yii::t('app', '实验室概况'),
            'team' => Yii::t('app', '科研队伍'),
            'outwork' => Yii::t('app', '科研成果'),
            'reserve1' => Yii::t('app', 'Reserve1'),
            'reserve2' => Yii::t('app', 'Reserve2'),
        ];
    }
}
