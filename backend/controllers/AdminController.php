<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Admin;
use yii\data\Pagination;
use common\widgets\Helper;

class AdminController extends Controller
{
    /**
     * (non-PHPdoc)
     * @see \yii\web\Controller::beforeAction()
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(['login/login']);
            return false;
        } else {
            return parent::beforeAction($action);
        }
    }

    /**
     * 管理员列表
     */
    public function actionIndex()
    {
        $query = Admin::find();
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        $data = array();
        $data['models'] = $models;
        $data['pages'] = $pages;

        return $this->render('index', $data);
    }

    /**
     * 添加管理员
     */
    public function actionAdd()
    {

        //$model = new AdminSetForm();
        $model = new Admin();
        $model->scenario = 'add';
        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->saveData()) {
                    Helper::showSuccess('添加成功');
                    return $this->redirect(['index']);
                } else {
                    Helper::showError('添加失败');
                }
            } else {
                if ($model->errors) {
                    Helper::showError($model->errors);
                }
            }
        }

        $data = array();
        $data['model'] = $model;

        return $this->render('set', $data);
    }

    /**
     * 修改管理员
     */
    public function actionEdit($id)
    {
        $model = Admin::findOne($id);
        $model->scenario = 'edit';

        if (!$model) {
            Helper::showError('该管理员不存在');
            return $this->redirect(['index']);
        }
        if(\Yii::$app->user->identity->username != 'admin' && $model->username == 'admin'){
            Helper::showError('你无权限修改');
            return $this->redirect(['index']);
        }

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if($model->username == 'admin' && $model->status != 0){
                    Helper::showError('总管理员不能修改状态');
                    return $this->redirect(['/admin/admin/edit','id'=>$model->admin_id]);
                }
                if ($model->saveData()) {
                    Helper::showSuccess('修改成功');
                    return $this->redirect(['index']);
                } else {
                    Helper::showError('修改失败');
                }
            } else {
                if ($model->errors) {
                    Helper::showError($model->errors);
                }
            }
        }

        $data = array();
        $data['model'] = $model;

        return $this->render('set', $data);
    }

    /**
     * 删除管理员
     */
    public function actionDel($id)
    {
        $model = Admin::findOne($id);
        if ($model->username == 'admin') {
            Helper::showError('总管理员不能删除');
            return $this->redirect(['index']);
        }

        if ($model->delete()) {
            Helper::showSuccess('删除成功');
        } else {
            Helper::showError('删除失败');
        }
        return $this->redirect(['index']);
    }

    /**
     * 修改资料
     */
    public function actionSet()
    {
        //$model = Admin::findIdentity(\Yii::$app->user->id);
        $model = \Yii::$app->user->identity;
        $model->scenario = 'set';

        if (Yii::$app->request->isPost) {
            $truename = \Yii::$app->request->post('truename');
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    Helper::showSuccess('修改成功');
                } else {
                    Helper::showError('修改失败');
                }
            } else {
                if ($model->errors) {
                    Helper::showError($model->errors);
                }
            }
        }

        return $this->redirect(['profile']);
    }

    /**
     * 修改密码
     */
    public function actionSetPassword()
    {

        $model = \Yii::$app->user->identity;

        $model->scenario = 'pwd';

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->oldpassword == $model->password) {
                    Helper::showError('新密码和原密码不能相同');
                } else {
                    if (\Yii::$app->security->validatePassword($model->oldpassword, $model->password_hash)) {
                        $model->setPassword();
                        if ($model->save()) {
                            //Fun::showSuccess('修改成功');
                            return $this->redirect(['login/logout']);
                        } else {
                            Helper::showError('修改失败');
                        }
                    } else {
                        Helper::showError('原密码错误');
                    }
                }
            } else {
                if ($model->errors) {
                    Helper::showError($model->errors);
                }
            }
        }

        return $this->redirect(['profile']);
    }

    /**
     * 修改账户资料
     */
    public function actionProfile(){
        return $this->render('profile');
    }
}
