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
    
    /**
     * 更改站点采集状态
     * @param unknown $id
     */
    public function actionSetStatus($id) {
        if(\Yii::$app->request->isAjax){
            $status = \Yii::$app->request->post('status');
            $model = Domain::findOne($id);
            
            if(!$model){
                $result['code'] = -1;
                $result['msg']  = '记录不存在';
                die(json_encode($result));
            }
            
            $model->is_open = $status;
            $model->update_time = date('Y-m-d H:i:s',time());
            if($model->save()){
                $result['code'] = 0;
                $result['msg']  = '更改成功';
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
     * 删除站点
     * @param unknown $wd
     */
    public function actionDelDomain($id){
        $model = Domain::findOne($id);
         
        if(!$model){
            Helper::showError('数据不存在');
            return $this->redirect(['index']);
        }
        
        //该站点下面有小说数据不允许删除
        $books = Books::find()->where(['domain_id'=>$id])->count();
        if($books > 0){
            Helper::showError('该站点下还有小说，不允许删除');
            return $this->redirect(['index']);
        }
         
        if($model->delete()){
            Helper::showSuccess('删除成功');
        }else{
            Helper::showError('删除失败');
        }
        return $this->redirect(['index']);
    }
}