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
	<li>目标小说站</li>
</ul>
<div class="row-fluid" style="margin-bottom: 10px;">
    <a href="<?=Url::to(['/collect/set-domain'])?>"><button class="btn btn-large btn-success">新增站点</button></a>
</div>
<div class="row-fluid sortable ui-sortable">	
	<div class="box span12">
		<div class="box-header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>小说站列表</h2>
			<div class="box-icon">
				<a class="btn-minimize" href="#"><i class="halflings-icon chevron-up"></i></a>
				<a class="btn-close" href="#"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content" style="display: block;">
			<table class="table table-bordered table-striped table-condensed">
				  <thead>
					  <tr>
						  <th>网站名称</th>
						  <th>网站域名</th>
						  <th>小说数量</th>
						  <th>采集状态</th>
						  <th>更新时间</th>        
						  <th>操  作</th>                                  
					  </tr>
				  </thead>   
				  <tbody>
				  <?php if($model):
				           foreach ($model as $v): 
				  ?>
					<tr>
						<td><?=$v['name']?></td>
						<td class="center"><?=$v['domain']?></td>
						<td class="center"><?=isset($books[$v['id']]) ? $books[$v['id']] : 0;?></td>
						<td class="center"><?=($v['is_open']) ? '<span class="green label">已开启</span>' : '<span class="gray label">已关闭</span>';?></td>
						<td class="center"><?=$v['update_time']?></td>    
						<td>
						  <a href="<?=Url::to(['/collect/set-domain','id'=>$v['id']])?>" class="btn btn-info">
							 <i class="halflings-icon white edit"></i>  
						  </a>
						  <a href="javascript:if(confirm('确定删除？')){window.location.href='<?=Url::to(['/collect/del-domain','id'=>$v['id']])?>'}" class="btn btn-danger">
							<i class="halflings-icon white trash"></i> 
						  </a>
						</td>                                   
					</tr>
				 <?php endforeach;else :?>
				 <tr><td colspan="5">暂无数据</td></tr>
				 <?php endif;?>
				  </tbody>
			 </table>  
			 <div class="pagination pagination-centered">
			  <?=LinkPager::widget(['pagination'=>$pages])?>
			</div>     
		</div>
	</div><!--/span-->
</div>