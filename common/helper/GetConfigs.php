<?php
namespace common\helper;

use yii\db\ActiveRecord;
use common\models\Configs;

class GetConfigs extends ActiveRecord
{
    
    public $get;
    
    public function __construct(){
        $common = $this->getConfigs('common');
        $this->set($common);
    }
    
    public static function tableName()
    {
        return Configs::tableName();
    }
    
    public function getConfigs($type) {
        
        $model = Configs::find()->where(['type'=>$type])->all();
        return $model;
    }
    
    private function set($obj){
        foreach($obj as $k => $v){
            $this->get[$v->name] = $v->value;
        }
    }
    
}