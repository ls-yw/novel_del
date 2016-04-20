<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<input type="hidden" class="js_menu" value="domain"/>
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/">后台主页</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>编辑站点</li>
</ul>

<div class="row-fluid sortable ui-sortable">
				<div class="box span12">
					<div data-original-title="" class="box-header">
						<h2><i class="icon-file-alt edit"></i><span class="break"></span>规则说明</h2>
						<div class="box-icon">
							<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
							<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
							<fieldset>
							  <div class="control-group error">
							     <p class="help-inline">
								  系统默认变量：用&lt;{bookid}&gt;代替链接中的book_id<br/>
								  系统标签 * 可以替代任意字符串。<br/>
								  系统标签 ! 可以替代除了&lt;和&gt;以外的任意字符串。<br/>
								  系统标签 $ 可以替代数字字符串。<br/>
								  空格 & nbsp; 可使用@代替。<br/>
								  采集规则中，需要获取的内容部分用四个以上系统标签代替，如 $$$$ 
								</p>
							</fieldset>
					
					</div>
				</div><!--/span-->
			
			</div>

<div class="row-fluid sortable ui-sortable">
				<div class="box span12">
					<div data-original-title="" class="box-header">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>编辑站点</h2>
						<div class="box-icon">
							<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
							<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php ActiveForm::begin(['id'=>'form1','options'=>['class'=>'form-horizontal']])?>
							<fieldset>
							  <div class="control-group">
								<label class="control-label">站点名称：</label>
								<div class="controls">
								  <input type="text" value="<?=$model->name?>" name="Domain[name]" class="input-xlarge focused">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">网站域名：</label>
								<div class="controls">
								  <input type="text" value="<?=$model->domain?>" name="Domain[domain]" class="input-xlarge focused">
								  <span class="help-inline">如：www.zhukeshu.com</span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">小说url规则：</label>
								<div class="controls">
								  <input type="text" value="<?=$model->book_regular?>" name="Domain[book_regular]" class="input-xlarge focused">
								  <span class="help-inline">&lt;{bookid}&gt; 代替book_id  mark_id标记用&lt;{markid}&gt;</span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">URL子序号运算方式：</label>
								<div class="controls">
								  <input type="text" value="<?=$model->book_mark_id?>" name="Domain[book_mark_id]" class="input-xlarge focused">
								  <span class="help-inline">支持使用&lt;{bookid}&gt;标记的四则运算（+加，-减，*乘，/除，%取余，%%取整） 暂只支持一步运算</span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">小说名称规则：</label>
								<div class="controls">
								  <input type="text" value="<?=$model->bookname_regular?>" name="Domain[bookname_regular]" class="input-xlarge focused">
								  <span class="help-inline"></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">作者规则：</label>
								<div class="controls">
								  <input type="text" value="<?=$model->author_regular?>" name="Domain[author_regular]" class="input-xlarge focused">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">简介规则：</label>
								<div class="controls">
								  <textarea name="Domain[descript_regular]" class="input-xlarge focused"><?=$model->descript_regular?></textarea>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">章节规则：</label>
								<div class="controls">
								  <textarea name="Domain[chapter_regular]" class="input-xlarge focused"><?=$model->chapter_regular?></textarea>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">内容规则：</label>
								<div class="controls">
								  <textarea name="Domain[content_regular]" class="input-xlarge focused"><?=$model->content_regular?></textarea>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">章节翻页区域规则：</label>
								<div class="controls">
								  <textarea name="Domain[paging_regular]" class="input-xlarge focused"><?=$model->paging_regular?></textarea>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">是否开启采集：</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" <?if($model->is_open == 1 || $model->is_open == '')echo 'checked="checked"';?> value="1" id="optionsRadios1" name="Domain[is_open]">
								 	开启
								  </label>
								  <label class="radio" style="padding-top:5px;">
									<input type="radio" <?if($model->is_open === 0)echo 'checked="checked"';?> value="0" id="optionsRadios2" name="Domain[is_open]">
									关闭
								  </label>
								</div>
							  </div>
							  <div class="form-actions">
								<button class="btn btn-primary" type="submit">保 存</button>
								<button class="btn" type="button" onclick="javascript:location.href='<?=Url::to(['index'])?>'">取 消</button>
							  </div>
							</fieldset>
						  <?php ActiveForm::end();?>
					
					</div>
				</div><!--/span-->
			
			</div>
			
