<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%yangpininfo}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $num
 * @property string $component
 * @property string $shape
 * @property string $property
 * @property string $savecon
 * @property string $process
 * @property string $testname
 * @property string $testaim
 * @property integer $testbase
 * @property string $testdetail
 * @property string $special
 * @property integer $testtime
 * @property string $uploadfilename
 */
class Yangpininfo extends \yii\db\ActiveRecord
{
    // shape
    const SHAPE_THIN_FILM = "1";
    const SHAPE_POWDER = "2";
    const SHAPE_BULK = "3";
    const SHAPE_FLUID = "4";
    const SHAPE_GRAIN = "5";
    const SHAPE_ELSE = "其它";

    // property
    const PROPERTY_SAFE = '1';
    const PROPERTY_UNKNOWN = '2';
    const PROPERTY_OXIDATION = '3';
    const PROPERTY_RADIOACTION = '4';
    const PROPERTY_CORROSIVITY = '5';
    const PROPERTY_MAGNETISM = '6';
    const PROPERTY_TOXICITY = '7';
    const PROPERTY_EXPLOSION = '8';
    const PROPERTY_IGNITABILITY = '9';

    // save condition
    const SAVECON_ROOM_TEMP = '1';
    const SAVECON_COLD_STORAGE = '2';
    const SAVECON_OUT_SUN = '3';
    const SAVECON_ELSE = '4';

    // process
    const PROCESS_RETAIN_3DAYS = '1';
    const PROCESS_YANGPIN_RECOVER = '2';
    const PROCESS_PRECIOUS_RECOVER = '3';

    // test base
    const TESTBASE_TESTER = 1;
    const TESTBASE_AGENT = 2;

    // test time
    const TESTTIME_5DAYS = 1;
    const TESTTIME_2T3DAYS = 2;
    const TESTTIME_ELSE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%yangpininfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'num', 'testbase', 'testtime'], 'integer'],
            [['testdetail'], 'string'],
            [['name', 'shape', 'savecon', 'testname', 'testaim', 'special', 'uploadfilename'], 'string', 'max' => 255],
            [['component'], 'string', 'max' => 1024],
            [['property', 'process'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'num' => Yii::t('app', 'Num'),
            'component' => Yii::t('app', 'Component'),
            'shape' => Yii::t('app', 'Shape'),
            'property' => Yii::t('app', 'Property'),
            'savecon' => Yii::t('app', 'Savecon'),
            'process' => Yii::t('app', 'Process'),
            'testname' => Yii::t('app', 'Testname'),
            'testaim' => Yii::t('app', 'Testaim'),
            'testbase' => Yii::t('app', '1 '),
            'testdetail' => Yii::t('app', 'Testdetail'),
            'special' => Yii::t('app', 'Special'),
            'testtime' => Yii::t('app', 'Testtime'),
            'uploadfilename' => Yii::t('app', 'Uploadfilename'),
        ];
    }

    public function getShape()
    {
        $arrShape =  array(
            Yangpininfo::SHAPE_THIN_FILM =>'薄膜',
            Yangpininfo::SHAPE_POWDER => '粉末',
            Yangpininfo::SHAPE_BULK =>'块状',
            Yangpininfo::SHAPE_FLUID =>'液体',
            Yangpininfo::SHAPE_GRAIN=>'颗粒',
            Yangpininfo::SHAPE_ELSE=>'其它'
        );

        return isset($arrShape[$this->shape])?$arrShape[$this->shape]:"";
    }

    public function getProperty()
    {
        $arrProperty =  array(
            Yangpininfo::PROPERTY_SAFE =>'无危险性',
            Yangpininfo::PROPERTY_UNKNOWN => '危险性未知',
            Yangpininfo::PROPERTY_OXIDATION =>'氧化性',
            Yangpininfo::PROPERTY_RADIOACTION =>'放射性',
            Yangpininfo::PROPERTY_CORROSIVITY=>'腐蚀性',
            Yangpininfo::PROPERTY_MAGNETISM=>'磁性',
            Yangpininfo::PROPERTY_TOXICITY=>'毒性',
            Yangpininfo::PROPERTY_EXPLOSION=>'易爆性',
            Yangpininfo::PROPERTY_IGNITABILITY=>'易燃性',

        );

        $arrP = explode(',', $this->property);
        $arrPt = array();
        foreach ($arrP as $v) {
            array_push($arrPt, isset($arrProperty[$v])?$arrProperty[$v]:"");
        }
        return implode(',', $arrPt);
    }

    public function getSaveCondition()
    {
        $arrSavecon =  array(
            Yangpininfo::SAVECON_ROOM_TEMP =>'室温(默认)',
            Yangpininfo::SAVECON_COLD_STORAGE =>'冷藏( °C)',
            Yangpininfo::SAVECON_OUT_SUN =>'避光',
            Yangpininfo::SAVECON_ELSE =>'其它',
        );

        return isset($arrSavecon[$this->savecon])?$arrSavecon[$this->savecon]:"";
    }

    public function getProcess()
    {
        $arrProcess = array(
            Yangpininfo::PROCESS_RETAIN_3DAYS => '保留3个工作日后销毁（默认）',
            Yangpininfo::PROCESS_YANGPIN_RECOVER => '普通样品回收不承担丢失风险（测试方顺丰到付）',
            Yangpininfo::PROCESS_PRECIOUS_RECOVER => '珍贵样品回收服务费100元',
        );

        return isset($arrProcess[$this->process])?$arrProcess[$this->process]:"";
    }

    public function getTestbase()
    {
        $arrTestbase = array(
            Yangpininfo::TESTBASE_TESTER => '承检方选定检测标准及方法',
            Yangpininfo::TESTBASE_AGENT => '委托方指定检测标准及方法'
        );

        return isset($arrTestbase[$this->testbase])?$arrTestbase[$this->testbase]:"";
    }

    public function getTesttime()
    {
        $arrTesttime = array(
            Yangpininfo::TESTTIME_5DAYS => '5个工作日（默认）',
            Yangpininfo::TESTTIME_2T3DAYS => '2-3个工作日（加急服务加收50%）',
            Yangpininfo::TESTTIME_ELSE => '其他（特殊测试）'
        );

        return isset($arrTesttime[$this->testtime])?$arrTesttime[$this->testtime]:"";
    }
}
