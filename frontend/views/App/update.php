<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ZksBooks */

$this->title = 'Update Zks Books: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Zks Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zks-books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
