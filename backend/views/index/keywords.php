<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/">后台主页</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>搜索关键字</li>
</ul>
<div class="row-fluid sortable ui-sortable">
	<div class="box span12">
		<div class="box-header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>搜索关键词列表</h2>
			<div class="box-icon">
				<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
				<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped">
				  <thead>
					  <tr>
						  <th>关键词</th>
						  <th>搜索次数</th>
						  <th>热门</th>
						  <th>操作</th>
					  </tr>
				  </thead>   
				  <tbody>
				  <?php if($model):
				           foreach ($model as $v): 
				  ?>
					<tr>
						<td><?=$v->keyword?></td>
						<td class="center"><?=$v->count?></td>
						<td class="center" rolname="<?=$v->keyword?>">
							<?=($v->is_hot == 1) ? '<a href="javascript:void(0)" class="keyhot label label-important">显示</a>' : '<a href="javascript:void(0)" class="label keyhot">隐藏</a>';?>
						</td>     
						<td>
						  <a href="javascript:if(confirm('确定删除？')){window.location.href='<?=Url::to(['/index/del-keyword','wd'=>$v->keyword])?>'}" class="btn btn-danger">
							<i class="halflings-icon white trash"></i> 
						  </a>
						</td>                                       
					</tr>
					<?php endforeach;else :?>
				 <tr><td colspan="3">暂无数据</td></tr>
				 <?php endif;?>
				  </tbody>
			 </table>  
			 <div class="pagination pagination-centered">
			  <?=LinkPager::widget(['pagination'=>$pages])?>
			</div>     
		</div>
	</div><!--/span-->
</div>
<input name="_csrf" id="_csrf" type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>"/>
<script>
$(function(){
	$('.table').on('click','.keyhot',function(){
		var obj = $(this);
		loading()
		$.post("<?=Url::to(['keywordhot'])?>",{keyword:obj.parent().attr('rolname'),_csrf:$('#_csrf').val()},function(result){
			loading()
			if(result.code < 0){
				alertMsg(result.msg);
			}else if(result.code == 0){
				var html = (result.hot==1) ? '<a href="javascript:void(0)" class="keyhot label label-important">显示</a>' : '<a href="javascript:void(0)" class="label keyhot">隐藏</a>';
				obj.parent().html(html);
				
			}
		},'json');
	})
})		  

</script >