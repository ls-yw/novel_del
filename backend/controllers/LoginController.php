<?php
namespace backend\controllers;

use yii\web\Controller;

class LoginController extends Controller
{
    
    public function actionLogin(){
        
        return $this->renderPartial('login');
    }
    
}