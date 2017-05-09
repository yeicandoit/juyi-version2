<?php
namespace frontend\models\seller;
use Yii;
use yii\base\Model;


/**
 * Signup form
 */
class SetappointmentForm extends Model
{
    
    public $goodid;
    public $numoftime1;
    public $appointdate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['goodid', 'trim'],
           	['goodid', 'required'],
            ['appointdate', 'trim'],
            ['appointdate', 'required'],
            ['numoftime1', 'trim'],
            ['numoftime1', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function appoint()
    {
    	if (!$this->validate()) {
    		return null;
    	}
       	$appointment = new Setappointment();
    	$goodid = $this->goodid;
    	$appointdate0 = $this->appointdate;
    	
    	$num1=$this->numoftime1;
    	$num2=0;
    	$num3=0;
    	$newdate=explode("/", $appointdate0);
    	//$appointdate=$newdate[2]."-".$newdate[0]."-".$newdate[1];
		$appointdate = $appointdate0;
    	$query=$appointment->find()->where(["goodid"=>$goodid])->andWhere(["appointdate"=>$appointdate])->one();
    	if($query)
    	{
    		if( Yii::$app->db->createCommand("UPDATE jy_setappointment SET numoftime1={$num1},numoftime2={$num2},numoftime3={$num3} WHERE goodid={$goodid} AND appointdate='{$appointdate}'")
    		->execute()) {
    		return  $goodid;
    		} else{
    		   return $goodid; 
    		}
       } else {
       		$appointment->goodid = $goodid;
       		$appointment->appointdate = $appointdate;
       		$appointment->numoftime1=$num1;
       		$appointment->numoftime2=0;
       		$appointment->numoftime3=0;
       		$appointment->num1=0;
       		$appointment->num2=0;
       		$appointment->num3=0;
          	return $appointment->save() ? $goodid : null;
      }
 }
}
