<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?= Html::csrfMetaTags()?>
<title>Insert title here</title>
<?php $this->head()?>
</head>
<body>
<?php $this->beginBody() ?>
	<div class="wrap">
	   <div class="row list_search">
	       <div class="logo"><img src="" width="110" height="40"></div>
              <?php ActiveForm::begin(['method' => 'get','action' => ['search'], 'id'=>'form']);?>
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
	   </div>
	   
	   <div class="row search_content">
	       <div class="col-md-6 col-sm-8 col-xs-12">
	           <div class="search_result">
	           <?php foreach ($models as $list):?>
	               <div class="row">
	                  <div class="list-group">
	                    <div class="list-group-item">
	                       <h4 class="list-group-item-heading"><a href="<?=Url::to(['book/chapter','bookid'=>$list['id']])?>" target="_blank"><?=$list->name;?>&nbsp;&nbsp;百度知道</a></h4>
	                       <div class="row">
	                           <div class="baseinfo">
	                               <strong class="novelinfo">作者：</strong><?=$list->author;?>
	                           </div>
	                           <div class="list-group-item-text"><?=$list->description;?></div>
	                       </div>
	                    </div>
	                  </div>
	               </div>
	           <?php endforeach;?>
	           </div>
	       </div>
	       <!-- 推荐的内容 -->
	       <div class="col-md-4 col-sm-4 hidden-xs"></div>
	       <!-- 推荐的内容  end-->
	       <div class="col-md-2 hidden-sm hidden-xs"></div>
	   </div>
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>