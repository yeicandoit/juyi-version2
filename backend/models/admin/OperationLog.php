<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%operation_log}}".
 *
 * @property integer $id
 * @property string $table_name
 * @property integer $element_id
 * @property integer $user_id
 * @property string $operation_type
 * @property string $operation_time
 */
class OperationLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%operation_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name', 'element_id', 'user_id', 'operation_type', 'operation_time'], 'required'],
            [['element_id', 'user_id'], 'integer'],
            [['operation_time'], 'safe'],
            [['table_name'], 'string', 'max' => 60],
            [['operation_type'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'table_name' => Yii::t('app', 'name of table'),
            'element_id' => Yii::t('app', 'element id in table'),
            'user_id' => Yii::t('app', '操作人'),
            'operation_type' => Yii::t('app', '操作类型'),
            'operation_time' => Yii::t('app', '操作时间'),
        ];
    }

    public static function addLog($table_name, $element_id, $user_id, $operation_type)
    {
        $operationLog = new OperationLog();
        $operationLog->table_name = $table_name;
        $operationLog->element_id = $element_id;
        $operationLog->user_id = $user_id;
        $operationLog->operation_type = $operation_type;
        $operationLog->operation_time = date('Y-m-d H:i:s');
        $operationLog->save();
    }
}
