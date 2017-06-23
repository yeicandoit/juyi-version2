<?php
namespace backend\models\admin;

use yii\base\Model;
use common\models\User;
use Yii;


/**
 * Signup form
 */
class AnnounceNewsForm extends Model
{
    public $title;
    public $content;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required'],
            ['content', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    
    public function savenews()
    {
    	if (!$this->validate()) {
    	
    		return null;
    	}
        
        $news = new JyAnnouncement();
        $news->title = $this->title;
        $news->content = $this->content;
        $news->time=date("Y-m-d H:i:s");
        
        return $news->save() ? $news : null;
    }
    
    public function changenews()
    {
    	$title = $this->title;
    	$content = $this->content;
    	$newsid= Yii::$app->request->post("postnewsid");
    	$update=Yii::$app->db->createCommand("UPDATE jy_announcement SET title='{$title}',content='{$content}' WHERE id='{$newsid}'")->execute();
    	return $update ? 1 : null;
    }
}
