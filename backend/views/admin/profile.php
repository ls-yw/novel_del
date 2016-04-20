<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/">后台主页</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>修改资料</li>
</ul>

<div class="row-fluid sortable ui-sortable">
	<div class="box span12">
		<div data-original-title="" class="box-header">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>修改资料</h2>
			<div class="box-icon">
				<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
				<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
		      <?php ActiveForm::begin(['id'=>'form1','action'=>Url::to(['/admin/set']),'options'=>['class'=>'form-horizontal']])?>
				<fieldset>
				  <div class="control-group">
					<label for="focusedInput" class="control-label">昵称：</label>
					<div class="controls">
					  <input type="text" value="<?=\Yii::$app->user->identity->truename?>" name="Admin[truename]" id="truename" class="input-xlarge focused">
					</div>
				  </div>
				  <div class="form-actions">
					<button class="btn btn-primary" type="submit">保 存</button>
					<button class="btn" onclick="javascript:history.go(-1);">取 消</button>
				  </div>
				</fieldset>
			 <?php ActiveForm::end();?>
		
		</div>
	</div><!--/span-->

</div>

<div class="row-fluid sortable ui-sortable">
	<div class="box span12">
		<div data-original-title="" class="box-header">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>修改密码</h2>
			<div class="box-icon">
				<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
				<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php ActiveForm::begin(['id'=>'form2','action'=>Url::to(['/admin/set-password']),'options'=>['class'=>'form-horizontal']])?>
				<fieldset>
				  <div class="control-group">
					<label for="focusedInput" class="control-label">原　密　码：</label>
					<div class="controls">
					  <input name="Admin[oldpassword]" value="" type="password"  class="input-xlarge focused">
					</div>
				  </div>
				  <div class="control-group">
					<label for="focusedInput" class="control-label">新　密　码：</label>
					<div class="controls">
					  <input name="Admin[password]" value="" type="password" class="input-xlarge focused">
					</div>
				  </div>
				  <div class="control-group">
					<label for="focusedInput" class="control-label">确认新密码：</label>
					<div class="controls">
					  <input name="Admin[repassword]" value="" type="password" class="input-xlarge focused">
					</div>
				  </div>
				  <div class="form-actions">
					<button class="btn btn-primary" type="submit">保 存</button>
					<button class="btn" type="button" onclick="javascript:history.go(-1);">取 消</button>
				  </div>
				</fieldset>
			  <?php ActiveForm::end();?>
		
		</div>
	</div><!--/span-->

</div>