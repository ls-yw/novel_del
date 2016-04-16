<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class IndexController extends Controller
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
	    
	}
    
}