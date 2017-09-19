<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property string $user_id
 * @property string $true_name
 * @property string $telephone
 * @property string $mobile
 * @property string $contact_addr
 * @property string $qq
 * @property integer $sex
 * @property string $birthday
 * @property integer $group_id
 * @property integer $exp
 * @property integer $point
 * @property integer $grade
 * @property string $message_ids
 * @property string $time
 * @property string $zip
 * @property integer $status
 * @property string $prop
 * @property string $balance
 * @property string $last_login
 * @property string $custom
 * @property string $email
 * @property string $affliation
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $department
 * @property string $studentid
 * @property string $cardid
 * @property integer $type
 * @property string $intime
 * @property string $outtime
 * @property integer $studenttype
 * @property integer $docid
 * @property integer $ischeck
 * @property string $cardphoto1
 * @property string $cardphpto2
 * @property string $photo3
 * @property string $photo4
 * @property string $title
 * @property string $job
 */
class Member extends \yii\db\ActiveRecord
{

    //1 高校学生 2 高校教职工 3 科研机构员工 4 企业员工'
    const TYPE_STUDENT = 1;
    const TYPE_TEACHER = 2;
    const TYPE_RESEARCHER = 3;
    const TYPE_WORKER = 4;

    //0 不是学生 1 在读本专科生 2 在读硕士 3 在读博士
    const STUDENT_NO = 0;
    const STUDENT_BACHELOR = 1;
    const STUDENT_MASTER = 2;
    const STUDENT_DOCTOR = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'sex', 'group_id', 'exp', 'point', 'grade', 'status', 'country', 'province', 'city', 'area', 'type', 'studenttype', 'docid', 'ischeck'], 'integer'],
            [['birthday', 'time', 'last_login', 'intime', 'outtime'], 'safe'],
            [['message_ids', 'prop'], 'string'],
            [['balance'], 'number'],
            [['true_name', 'telephone'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['contact_addr'], 'string', 'max' => 250],
            [['qq'], 'string', 'max' => 15],
            [['zip'], 'string', 'max' => 10],
            [['custom', 'email', 'department', 'studentid', 'cardid', 'cardphoto1', 'cardphpto2', 'photo3', 'photo4', 'title', 'job'], 'string', 'max' => 255],
            [['affliation'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', '用户ID'),
            'true_name' => Yii::t('app', '真实姓名'),
            'telephone' => Yii::t('app', '联系电话'),
            'mobile' => Yii::t('app', '手机'),
            'contact_addr' => Yii::t('app', '联系地址'),
            'qq' => Yii::t('app', 'QQ'),
            'sex' => Yii::t('app', '性别1男2女'),
            'birthday' => Yii::t('app', '生日'),
            'group_id' => Yii::t('app', '分组'),
            'exp' => Yii::t('app', '经验值'),
            'point' => Yii::t('app', '积分'),
            'grade' => Yii::t('app', '用户评分'),
            'message_ids' => Yii::t('app', '消息ID'),
            'time' => Yii::t('app', '注册日期时间'),
            'zip' => Yii::t('app', '邮政编码'),
            'status' => Yii::t('app', '用户状态 1正常状态 2 删除至回收站 3锁定'),
            'prop' => Yii::t('app', '用户拥有的工具'),
            'balance' => Yii::t('app', '用户余额'),
            'last_login' => Yii::t('app', '最后一次登录时间'),
            'custom' => Yii::t('app', '用户习惯方式,配送和支付方式等信息'),
            'email' => Yii::t('app', 'Email'),
            'affliation' => Yii::t('app', '单位'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'department' => Yii::t('app', '部门、院系'),
            'studentid' => Yii::t('app', '学生证号'),
            'cardid' => Yii::t('app', '身份证号'),
            'type' => Yii::t('app', '用户类型 1 高校学生 2 高校教职工 3 科研机构员工 4 企业员工'),
            'intime' => Yii::t('app', '入学时间'),
            'outtime' => Yii::t('app', '预计毕业时间'),
            'studenttype' => Yii::t('app', '学生类型 0 不是学生 1 在读本专科生 2 在读硕士 3 在读博士'),
            'docid' => Yii::t('app', '导师id，没有导师为0'),
            'ischeck' => Yii::t('app', '是否已经审核
'),
            'cardphoto1' => Yii::t('app', '身份证件正面'),
            'cardphpto2' => Yii::t('app', '身份证证件反面'),
            'photo3' => Yii::t('app', '学生证'),
            'photo4' => Yii::t('app', '学生证补充'),
            'title' => Yii::t('app', '职称'),
            'job' => Yii::t('app', '职位'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function getDoc()
    {
        return $this->hasOne(MemberDoctor::className(), ['id'=>'docid']);
    }

    public static function getUserTypeArr()
    {
        return array(
            null=>'未知',
            self::TYPE_STUDENT=>'高校学生',
            self::TYPE_TEACHER=>'高校教职工',
            self::TYPE_RESEARCHER=>'科研机构员工',
            self::TYPE_WORKER=>'企业员工',
        );
    }

    public static function getStudentTypeArr()
    {
        return array(
            self::STUDENT_BACHELOR=>'在读本科生',
            self::STUDENT_MASTER=>'在读硕士生',
            self::STUDENT_DOCTOR=>'在读博士生',
        );
    }
}
