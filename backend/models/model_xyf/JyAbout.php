<?php

namespace backend\models\model_xyf;

use Yii;

/**
 * This is the model class for table "jy_about".
 *
 * @property integer $id
 * @property string $jyjj
 * @property string $tsfw
 * @property string $hzgy
 * @property string $cpyc
 * @property string $hyzc
 * @property string $cslc
 * @property string $zffs
 * @property string $lxkf
 * @property string $sjzc
 * @property string $rzlc
 * @property string $fggf
 * @property string $shtk
 * @property string $tklc
 * @property string $qxdd
 * @property string $shkf
 * @property string $lxjy
 * @property string $yjjy
 */
class JyAbout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jy_about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jyjj', 'tsfw', 'hzgy', 'cpyc', 'hyzc', 'cslc', 'zffs', 'lxkf', 'sjzc', 'rzlc', 'fggf', 'shtk', 'tklc', 'qxdd', 'shkf', 'lxjy', 'yjjy'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jyjj' => '聚仪简介',
            'tsfw' => '特色服务',
            'hzgy' => '合作共赢',
            'cpyc' => '诚聘英才',
            'hyzc' => '会员注册',
            'cslc' => '测试流程',
            'zffs' => '支付方式',
            'lxkf' => '联系客服',
            'sjzc' => '商家注册',
            'rzlc' => '入驻流程',
            'fggf' => '法规规范',
            'shtk' => '售后条款',
            'tklc' => '退款流程',
            'qxdd' => '取消订单',
            'shkf' => '售后客服',
            'lxjy' => '联系聚仪',
            'yjjy' => '意见建议',
        ];
    }

    public function getItem()
    {
        return array(
            'jyjj' => '聚仪简介',
            'tsfw' => '特色服务',
            'hzgy' => '合作共赢',
            'cpyc' => '诚聘英才',
            'hyzc' => '会员注册',
            'cslc' => '测试流程',
            'zffs' => '支付方式',
            'lxkf' => '联系客服',
            'sjzc' => '商家注册',
            'rzlc' => '入驻流程',
            'fggf' => '法规规范',
            'shtk' => '售后条款',
            'tklc' => '退款流程',
            'qxdd' => '取消订单',
            'shkf' => '售后客服',
            'lxjy' => '联系聚仪',
            'yjjy' => '意见建议',
        );
    }
}
