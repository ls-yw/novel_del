<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\widgets\Helper;
use yii\widgets\LinkPager;

AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?= Html::csrfMetaTags()?>
<title><?=$wd?>_竹刻书小说搜索</title>
<meta name="keywords" content="<?=$wd?>,竹刻书小说搜索">
<meta name="description" content="<?=$wd?>">
<?php $this->head()?>
</head>
<body>
<?php $this->beginBody() ?>
	<div class="wrap">
	   <div class="row list_search">
	       <div class="logo"><a href="/"><img src="/logo.png" width="100"></a></div>
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
                  <input type="text" class="form-control" name="wd" aria-label="..." placeholder="书名" value="<?=$wd?>">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Go!</button>
                  </span>
                </div><!-- /input-group -->
                <?php ActiveForm::end();?>
	   </div>
	   
	   <div class="row search_content">
	       <div class="col-md-6 col-sm-8 col-xs-12">
	           <div class="search_result">
	           <?php if($models):foreach ($models as $list):?>
	               <div class="row">
	                  <div class="list-group">
	                    <div class="list-group-item">
	                       <h4 class="list-group-item-heading"><a href="<?=Url::to(['book/chapter','bookid'=>$list['id']])?>" target="_blank"><?=Helper::getRedKeyWord($list->name, $wd);?>&nbsp;&nbsp;<?=$hosts[$list->id]['name'];?></a></h4>
	                       <div class="row nomargin">
	                           <div class="baseinfo row">
	                               <div class="col-md-6 col-sm-6 col-xs-6"><strong class="novelinfo">作者：</strong><?=Helper::getRedKeyWord($list->author, $wd);?></div>
	                               <div class="col-md-6 col-sm-6 col-xs-6"><strong class="novelinfo">来源：</strong><?=$hosts[$list->id]['domain'];?></div>
	                           </div>
	                           <div class="list-group-item-text"><?=Helper::getRedKeyWord($list->description, $wd);?></div>
	                       </div>
	                    </div>
	                  </div>
	               </div>
	           <?php endforeach;?>
	           <?php else:?>
	               <div class="row nomargin">
	                  <div class="no_result">找不到结果</div>
	               </div>
	           <?php endif;?>
	           </div>
	           <div class="page"><?=LinkPager::widget(['pagination' => $pages])?></div>
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