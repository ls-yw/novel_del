<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>_<?=Yii::$app->configs->get['hostname'];?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<nav class="navbar navbar-default">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	    	<button aria-expanded="false" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
	      <a class="navbar-brand" href="http://<?=Yii::$app->configs->get['host'];?>"><img src="/logo.png" width="100"></a></a>
	    </div>
	
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <?php ActiveForm::begin(['method' => 'get','action' => ['search'], 'id'=>'form','class'=>"navbar-form navbar-left"]);?>
	        <div class="input-group">
	        <input type="text" class="form-control" name="wd" aria-label="..." placeholder="书名" value="">
	                  <span class="input-group-btn">
	                    <button type="submit" class="btn btn-default">Go!</button>
	                  </span>
	         </div>
	      <?php ActiveForm::end();?>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>









 

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <a href="http://<?=Yii::$app->configs->get['host'];?>"><?=Yii::$app->configs->get['hostname'];?></a> <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
