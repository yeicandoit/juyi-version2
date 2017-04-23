<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%expert_info}}".
 *
 * @property integer $id
 * @property integer $seller_id
 * @property string $institute
 * @property string $lab
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
class ExpertInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expert_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_id'], 'required'],
            [['seller_id'], 'integer'],
            [['institute', 'lab'], 'string', 'max' => 128],
            [['description', 'direction', 'education', 'work', 'research', 'project', 'award', 'reserve1', 'reserve2'], 'string', 'max' => 512],
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
            'seller_id' => Yii::t('app', '专家id'),
            'institute' => Yii::t('app', '学院'),
            'lab' => Yii::t('app', '研究所'),
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
