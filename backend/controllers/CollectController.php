<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models\Domain;
use yii\data\Pagination;
use common\widgets\Helper;
use common\models\Books;

class CollectController extends Controller
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

    public function actionIndex()
    {
        $query = Domain::find();
        $countQuery = clone $query;
        $count = $countQuery->count();
        $pages = new Pagination([
            'totalCount' => $count
        ]);
        
        $model = $query->orderBy('id desc')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        //获取站点小说数
        $books = Books::find()->select('domain_id,COUNT(id) as count')->groupBy('domain_id')->asArray()->all();
        $bookArr = array();
        foreach ($books as $v){
        	$bookArr[$v['domain_id']] = $v['count'];
        }
        
        $data = array();
        $data['model'] = $model;
        $data['pages'] = $pages;
        $data['books'] = $bookArr;
        
        return $this->render('index', $data);
    }
    
    /**
     * 设置站点
     */
    public function actionSetDomain($id=0){
        
        if(empty($id)){
            $model = new Domain();
        }else{
            $model = Domain::findOne($id);
        }
        
        if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->update_time = date('Y-m-d H:i:s',time());
            if(empty($id))$model->create_time = $model->update_time;
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                Helper::showError($model->errors);
            }
        }else{
            if($model->errors)Helper::showError($model->errors);
        }
        
        $data = array();
        $data['model'] = $model;
        
        return $this->render('set-domain', $data);
    }
}