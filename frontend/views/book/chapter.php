<?php
use yii\helpers\Url;
$this->title = $book->name;
$this->registerMetaTag(['name' => 'keywrods', 'content' => $book->name.','.$book->author], 'keywrods');
$this->registerMetaTag(['name' => 'description', 'content' => $book->description], 'description');
?>
<div class="row">
    <div class="bookinfo">
        <h1><?=$book->name?></h1>
        <p class="bookbase"><strong>作者：</strong><?=$book->author?></p>
        <p><?=$book->description?></p>
     </div>
</div>
<div class="row chapter">
    <?php if(isset($chapters[1])):foreach ($chapters[1] as $k => $v):?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 chapterlink"><a href="<?=Url::to(['book/article', 'doid'=>$book->domain_id,'u'=>urlencode(base64_encode($v)),'b'=>$book->book_id])?>" title="<?=$chapters[2][$k]?>" target="_blank"><?=$chapters[2][$k]?></a></div>
    <?php endforeach;endif;?>
</div>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
<input name="c" type="hidden" id="c" value="<?=$_GET['bookid']?>">
<script type="text/javascript">
var __getChapter = '<?=Url::to(['/book/ajaxchapter','bookid'=>intval($_GET['bookid'])])?>';
</script>