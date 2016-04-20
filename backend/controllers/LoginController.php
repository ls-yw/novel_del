<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Admin;
use common\widgets\Helper;
use yii\filters\AccessControl;

class LoginController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }
    
    public function actionLogin(){
        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new Admin();
        $model->scenario = 'login';
        
        if(\Yii::$app->request->isPost){
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->login()) {
                    $model->successLogin();
                    return $this->goHome();
                } else {
                    $model->loginLogs();
                    Helper::showError('帐号或密码不正确');
                }
            } else {
                $model->loginLogs();
                if ($model->errors) {
                    Helper::showError($model->errors);
                } else {
                    Helper::showError('登录失败');
                }
            }
            return $this->redirect('login');
        }else{
            return $this->renderPartial('login');
        }
    }
    
    /**
     * 退出
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
    
        return $this->redirect(['login']);
    }
    
}