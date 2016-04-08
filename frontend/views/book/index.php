<?php
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use yii\helpers\Html;

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
    <title>竹刻书小说搜索</title>
    <meta name="keywords" content="竹刻书,竹刻书小说搜索,小说搜索,玄幻修真小说">
    <meta name="description" content="竹刻书小说搜索内容来源于网络。">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
   <div class="container">
    <div class="row auhe">&nbsp;</div>
    <div class="row search-box">
      <div class="col-lg-12 logo"><img alt="竹刻书小说" src="/logo.png" width="150"></div>
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
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 竹刻书小说  <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>