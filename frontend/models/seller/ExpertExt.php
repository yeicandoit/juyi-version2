<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%expert_ext}}".
 *
 * @property integer $id
 * @property integer $expert_id
 * @property string $description
 * @property string $direction
 * @property string $education
 * @property string $work
 * @property string $research
 * @property string $project
 * @property string $award
 * @property string $reserve1
 * @property string $reserve2
 */
class ExpertExt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expert_ext}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expert_id'], 'required'],
            [['expert_id'], 'integer'],
            [['description', 'direction', 'education', 'work', 'research', 'project', 'award', 'reserve1', 'reserve2'], 'string', 'max' => 512],
            [['expert_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'expert_id' => Yii::t('app', '专家id'),
            'description' => Yii::t('app', '专家介绍'),
            'direction' => Yii::t('app', '研究方向'),
            'education' => Yii::t('app', '教育背景'),
            'work' => Yii::t('app', '工作经历'),
            'research' => Yii::t('app', '科研成果'),
            'project' => Yii::t('app', '科研项目'),
            'award' => Yii::t('app', '荣誉奖励'),
            'reserve1' => Yii::t('app', 'Reserve1'),
            'reserve2' => Yii::t('app', 'Reserve2'),
        ];
    }
}
