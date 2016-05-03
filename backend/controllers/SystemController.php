<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models\Configs;

class SystemController extends Controller
{
    
    /**
     * (non-PHPdoc)
     *
     * @see \yii\web\Controller::beforeAction()
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            $this->redirect([
                'login/login'
            ]);
            return false;
        } else {
            return parent::beforeAction($action);
        }
    }
    
    public function actionIndex(){
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $type = \Yii::$app->request->post('type');
            unset($post['type'],$post['_csrf']);
            
            foreach ($post as $k => $v){
                $model = '';
                $model = Configs::find()->where(['name'=>$k,'type'=>$type])->one();
                if(!$model)$model = new Configs();
                $model->name  = $k;
                $model->value = $v;
                $model->type  = $type;
                $model->save();
            }
        }
        
        return $this->render('index');
    }
    
}