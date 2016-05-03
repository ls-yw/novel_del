<?php
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCss('.footer{position:absolute;bottom:0px;width:100%;}');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?=Yii::$app->configs->get['hostname'];?></title>
    <meta name="keywords" content="<?=Yii::$app->configs->get['keywords'];?>">
    <meta name="description" content="<?=Yii::$app->configs->get['description'];?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
   <div class="container">
    <div class="row auhe">&nbsp;</div>
    <div class="row search-box">
      <div class="col-lg-12 logo"><img alt="<?=Yii::$app->configs->get['hostname'];?>" src="/logo.png" width="150"></div>
      <div class="col-lg-12">
      <?php ActiveForm::begin(['method' => 'get','action' => ['search']]);?>
        <div class="input-group">
          <!-- <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle"  aria-haspopup="true" aria-expanded="false">书名 <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </div> --><!-- /btn-group -->
          <input type="text" class="form-control" name="wd" aria-label="..." placeholder="书名">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Go!</button>
          </span>
        </div><!-- /input-group -->
        <?php ActiveForm::end();?>
        <div class="keyword-hot">
            <?php if($keywords):?>
            <span>热门搜索：</span>
            <?php foreach ($keywords as $v):?>
            <a href="<?=Url::to(['search','wd'=>$v->keyword])?>"><?=$v->keyword?></a>
            <?php endforeach;endif;?>
        </div>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <a href="http://<?=Yii::$app->configs->get['host'];?>"><?=Yii::$app->configs->get['hostname'];?></a>  <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>