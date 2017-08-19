<?php

namespace backend\models\admin;

use backend\models\seller\Expert;
use backend\models\seller\Goods;
use backend\models\seller\Seller;
use Yii;

/**
 * This is the model class for table "{{%commend_goods}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $commend_id
 *
 */
class CommendGoods extends \yii\db\ActiveRecord
{
    const HotDevice = 1;
    const HotOrganization = 2;
    const HotExpert = 3;
    const HotHelp = 4;
    const HotSimulate = 5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%commend_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'commend_id'], 'required'],
            [['type', 'commend_id'], 'integer'],
            ['add_time', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', '1. 热门仪器 2. 热门机构 3. 聚仪专家 4. 热门辅助 5. 热门模拟'),
            'commend_id' => Yii::t('app', '推荐ID'),
            'add_time' => Yii::t('app', '添加时间'),
        ];
    }

    public function getCommend()
    {
        if(CommendGoods::HotDevice == $this->type || CommendGoods::HotHelp == $this->type || CommendGoods::HotSimulate == $this->type){
            return Goods::findOne($this->commend_id);
        } else if (CommendGoods::HotOrganization == $this->type) {
            return Seller::findOne($this->commend_id);
        } else if (CommendGoods::HotExpert == $this->type) {
            return Expert::findOne($this->commend_id);
        }

        return null;
    }
}
