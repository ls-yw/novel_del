<?php
use yii\widgets\ActiveForm;
?>
<div class="row search-box">
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
