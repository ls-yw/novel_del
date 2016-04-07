<?php
use yii\helpers\Url;
?>
<div class="row">
    <div class="bookinfo">
        <h1 id="title"></h1>
     </div>
</div>
<div class="row">
    <div class="content">
        
    </div>
</div>
<div class="row nextchapter">
    <?php /*if($paging[2][0] == '上一章' || $paging[2][0] == '下一章'):?>
    <div class="col-md-6 col-sm-6 col-xs-6"><a href="javascript:void(0);" class="getArticle" data-url="<?if(isset($paging[1][0]) && $paging[2][0] == '上一章')echo urlencode(base64_encode($paging[1][0]));?>">上一章</a></div>
    <div class="col-md-6 col-sm-6 col-xs-6"><a href="javascript:void(0);" class="getArticle" data-url="<?if(isset($paging[1][1])):echo urlencode(base64_encode($paging[1][1]));elseif ($paging[2][0] == '下一章'):echo urlencode(base64_encode($paging[1][0]));endif;?>">下一章</a></div>
    <?php else :?>
    <div class="col-md-6 col-sm-6 col-xs-6"><?php if(isset($paging[1][0])):?><a href="javascript:void(0);" class="getArticle" data-url="<?=urlencode(base64_encode($paging[1][0]))?>"><?=$paging[2][0]?></a><?php endif;?></div>
    <div class="col-md-6 col-sm-6 col-xs-6"><?php if(isset($paging[1][1])):?><a href="javascript:void(0);" class="getArticle" data-url="<?=urlencode(base64_encode($paging[1][1]))?>"><?=$paging[2][1]?></a><?php endif;?></div>
    <?php endif;*/?>
</div>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
<input name="u" type="hidden" id="u" value="<?=urlencode(base64_encode($u))?>">
<script type="text/javascript">
var __getArticle = '<?=Url::to(['/book/ajaxarticle','doid'=>intval($_GET['doid'])])?>';
var _getArticle = '<?=Url::to(['/book/article','doid'=>intval($_GET['doid'])])?>';
</script>