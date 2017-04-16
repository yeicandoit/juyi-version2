<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
//use common\models\User;

use frontend\models\JySetappointment;


/**
 * Signup form
 */
class SetappointmentForm extends Model
{
    
    public $goodid;
   // public $goods_no;
    public $numoftime1;
 //   public $numoftime2;
  //  public $numoftime3;
    public $appointdate;
    
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['goodid', 'trim'],
           ['goodid', 'required'],
            
          //  ['goods_no', 'trim'],
           // ['goods_no', 'required'],
            
            ['appointdate', 'trim'],
            ['appointdate', 'required'],
       
            
            ['numoftime1', 'trim'],
            ['numoftime1', 'required'],
            
            /*
            ['numoftime2', 'trim'],
            ['numoftime2', 'required'], 
            
            ['numoftime3', 'trim'],
            ['numoftime3', 'required'],
           */
            
       
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
    		//echo "validate failuer";
    		return null;
    		//echo $this->getErrors().'<br>';
    		//return "validat is failure".'<br>';
    	}

    //	echo "<br><br><br>";
       	$appointment = new JySetappointment();
    	
    	$goodid = $this->goodid;
    	$appointdate0 = $this->appointdate;
    	
    	$num1=$this->numoftime1;
    	//$num2=$this->numoftime2;
    //	$num3=$this->numoftime3;
    	$num2=0;
    	$num3=0;
    
    	
    	$newdate=explode("/", $appointdate0);
    	$appointdate=$newdate[2]."-".$newdate[0]."-".$newdate[1];
    	
    	
    //	echo $num2."<br>";
    	
    	$query=$appointment->find()->where(["goodid"=>$goodid])->andWhere(["appointdate"=>$appointdate])->one();
    	
    
    	
    	
    	if($query)
    	{
    		//var_dump($query);
    		
    	//	echo "有重复"."<br>";
        		//var_dump($query);
    		
    		if( Yii::$app->db->createCommand("UPDATE jy_setappointment SET numoftime1={$num1},numoftime2={$num2},numoftime3={$num3} WHERE goodid={$goodid} AND appointdate='{$appointdate}'")
    		->execute()) {
    			
    	//		echo "update";
    		 //   return $appointment->find()->all();
    		return  $goodid;
    		
    		}
    		else{
    		   return $goodid; 
    		}
    	//echo "value is".$this->goodid;
    		//return $query->up ? $appointment : null;
           //if($query->updateAll('numoftime1=3'))
          // 	 echo "update success";
         // else 
         //  	echo "update failure";
   
    		
       }
       else 
       {
       	$appointment->goodid = $goodid;
       	$appointment->appointdate = $appointdate;
       	$appointment->numoftime1=$num1;
       	$appointment->numoftime2=0;
       	$appointment->numoftime3=0;
       	$appointment->num1=0;
       	$appointment->num2=0;
       	$appointment->num3=0;
  
       	
       // echo $this->numoftime2;
          return $appointment->save() ? $goodid : null;
      }
 } 

}
