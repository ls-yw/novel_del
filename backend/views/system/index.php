<div class="row-fluid sortable ui-sortable">
	<div class="box span12">
		<div data-original-title="" class="box-header">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>基本配置</h2>
			<div class="box-icon">
				<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
				<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post">
			<input name="_csrf" id="_csrf" type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>"/>
			<input name="type" type="hidden" value="common"/>
				<fieldset>
				  <div class="control-group">
					<label for="prependedInput" class="control-label">网站名称：</label>
					<div class="controls">
						<input type="text" class="span6 typeahead" id="hostname" name="hostname" value="<?=Yii::$app->configs->get['hostname']?>">
					</div>
				  </div>
				  <div class="control-group">
					<label for="prependedInput" class="control-label">网站域名：</label>
					<div class="controls">
					  <div class="input-prepend">
						<span class="add-on">http://</span><input type="text" size="16" id="host" name="host" value="<?=Yii::$app->configs->get['host']?>">
					  </div>
					</div>
				  </div>
				  <div class="control-group">
					<label for="prependedInput" class="control-label">关键字：</label>
					<div class="controls">
						<input type="text" class="span6 typeahead" id="keywords" name="keywords" value="<?=Yii::$app->configs->get['keywords']?>">
					</div>
				  </div>
				  <div class="control-group">
					<label for="prependedInput" class="control-label">描述：</label>
					<div class="controls">
						<textarea class="span6 typeahead" id="description" name="description"><?=Yii::$app->configs->get['description']?></textarea>
					</div>
				  </div>
				  <div class="form-actions">
					<button class="btn btn-primary" type="submit">保 存</button>
					<button class="btn" onclick="javascript:history.go(-1)">取 消</button>
				  </div>
				</fieldset>
			</form>
		</div>
	</div><!--/span-->

</div>