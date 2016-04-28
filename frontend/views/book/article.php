<?php
use yii\helpers\Url;
use common\widgets\Helper;

$this->registerJsFile('/static/js/jquery.min.js');
$this->registerJsFile('/static/js/book.js');
?>
<div class="row">
    <div class="bookinfo">
        <h1 id="title"></h1>
     </div>
</div>
<?php if(Helper::isMoblie() == false):?>
<div class="cont-style">
    <span>
                背景颜色 <select id="bjys" onchange="selectbj(this);">
                    <option value="#ffffff">默认</option>
                    <option style="background-color: #fff" value="#000">黑色</option>
                    <option style="background-color: #E9FAFF" value="#E9FAFF">淡蓝</option>
                    <option style="background-color: #FFFFED" value="#FFFFED">明黄</option>
                    <option style="background-color: #eefaee" value="#eefaee">淡绿</option>
                    <option style="background-color: #FCEFFF" value="#FCEFFF">红粉</option>
                    <option style="background-color: #efefef" value="#efefef">灰色</option>
                </select>
     </span>
     <span>
                字体颜色 <select id="ztys" onchange="selectzy(this);">
                    <option value="#333333">默认</option>
                    <option style="color: #000" value="#000">黑色</option>
                    <option style="color: #000" value="#fff">白色</option>
                    <option style="color: #0f0" value="#0f0">绿色</option>
                    <option style="color: #060" value="#060">青色</option>
                    <option style="color: #f00" value="#f00">红色</option>
                    <option style="color: #00F" value="#00F">蓝色</option>
                    <option style="color: #960" value="#960">橘黄</option>
                </select>
     </span>
     <span>
               字体大小 <select id="ztdx" onchange="selectzd(this);">
                    <option value="14px">默认</option>
                    <option value="16px">16号</option>
                    <option value="18px">18号</option>
                    <option value="20px">20号</option>
                    <option value="22px">22号</option>
                    <option value="24px">24号</option>
                </select>
     </span>
     <span>
               双击滚动 <select id="gdsd" onchange="selectgd(this);">
                    <option value="0">滚屏</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
        (1-10，1最慢，10最快）
     </span>
</div>
<?php endif;?>
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
var __getArticle = '<?=Url::to(['/book/ajaxarticle','doid'=>intval($_GET['doid']),'b'=>intval($_GET['b'])])?>';
var _getArticle = '<?=Url::to(['/book/article','doid'=>intval($_GET['doid']),'b'=>intval($_GET['b'])])?>';
</script>