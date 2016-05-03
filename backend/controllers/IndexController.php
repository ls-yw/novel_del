<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Keywords;
use yii\data\Pagination;
use common\widgets\Helper;

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
	    
	    return $this->render('index');
	}
	
	public function actionKeywords(){
	    $query = Keywords::find();
	    $countQuery = clone $query;
	    $count = $countQuery->count();
	    $pages = new Pagination([
	        'totalCount' => $count
	    ]);
	    
	    $model = $query->orderBy('is_hot desc,count desc')
	    ->offset($pages->offset)
	    ->limit($pages->limit)
	    ->all();
	    
	    $data = array();
	    $data['model'] = $model;
	    $data['pages'] = $pages;
	    
	    return $this->render('keywords', $data);
	}
	
	/**
	 * 设置热门关键字
	 */
	public function actionKeywordhot(){
	    if(\Yii::$app->request->isAjax){
	        $keyword = \Yii::$app->request->post('keyword');
	        $model = Keywords::find()->where(['keyword'=>$keyword])->one();
	        
	        if(!$model){
	            $result['code'] = -1;
	            $result['msg']  = '记录不存在';
	            die(json_encode($result));
	        }
	        
	        $model->is_hot = ($model->is_hot == 1) ? 0 : 1;
	        if($model->save()){
	            $result['code'] = 0;
	            $result['msg']  = '更改成功';
	            $result['hot']  = $model->is_hot;
	            die(json_encode($result));
	        }else{
	            $result['code'] = -2;
	            $result['msg']  = '更改失败';
	        }
	    }else{
	        $result['code'] = -3;
	        $result['msg']  = '非法访问';
	    }
	    die(json_encode($result));
	}
	
	/**
	 * 删除搜索关键字
	 * @param unknown $wd
	 */
	public function actionDelKeyword($wd){
	    $model = Keywords::find()->where(['keyword'=>$wd])->one();
	    
	    if(!$model){
	        Helper::showError('数据不存在');
	        return $this->redirect(['keywords']);
	    }
	    
	    if($model->delete()){
	        Helper::showSuccess('删除成功');
	    }else{
	        Helper::showError('删除失败');
	    }
	    return $this->redirect(['keywords']);
	}
    
}