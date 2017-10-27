<?php
namespace backend\models\admin;

use yii\base\Model;
use common\models\User;
use Yii;


/**
 * Signup form
 */
class SetInformationForm extends Model
{
    public $title;
    public $content;
    public $keywords;
    public $description;
    public $seotitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required'],
            ['content', 'required'],
            [['keywords', 'description', 'seotitle'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'keywords'=>Yii::t('app', 'SEO关键词'),
            'description'=>Yii::t('app', 'SEO描述'),
            'seotitle'=>Yii::t('app', 'SEO标题'),
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
        
        $news = new JyInformation();
        $news->title = $this->title;
        $news->content = $this->content;
        $news->keywords = $this->keywords;
        $news->description = $this->description;
        $news->seotitle = $this->seotitle;
        $news->time=date("Y-m-d H:i:s");
        
        return $news->save() ? $news : null;
    }
    
    public function changenews()
    {
    	
    
    	$title = $this->title;
    	$content = $this->content;
        $keywords = $this->keywords;
        $description = $this->description;
        $seotitle = $this->seotitle;
    	$newsid= Yii::$app->request->post("newsid");
    	$update=Yii::$app->db->createCommand("UPDATE jy_information SET title='{$title}',content='{$content}',
            keywords='{$keywords}',description='{$description}',seotitle='{$seotitle}'
            WHERE id='{$newsid}'")->execute();
    	return $update ? 1 : null;
    }
    
    
}
