<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ZksBooks */

$this->title = 'Create Zks Books';
$this->params['breadcrumbs'][] = ['label' => 'Zks Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zks-books-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
