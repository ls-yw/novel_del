<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	
	<!-- start: Meta -->
	<meta charset="<?= Yii::$app->charset ?>">
	 <?= Html::csrfMetaTags() ?>
	<title>竹刻书后台管理</title>
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="/static/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="/static/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="/static/css/style-responsive.css" rel="stylesheet">
	<link id="base-style-responsive" href="/static/css/artdialog.css" rel="stylesheet">
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<link id="ie-style" href="/static/css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="/static/css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<!-- end: Favicon -->
	<script src="/static/js/jquery-1.9.1.min.js"></script>
</head>

<body>


		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/"><span>竹刻书后台管理中心</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li>
							<a class="btn" target="_blank" href="http://<?=Yii::$app->configs->get['host']?>" title="网站预览">
								<i class="halflings-icon white home"></i>
							</a>
						</li>
						<!-- start: Message Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white envelope"></i>
							</a>
							<ul class="dropdown-menu messages">
								<li class="dropdown-menu-title">
 									<span>You have 9 messages</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                            	<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	6 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                
								<li>
                            		<a class="dropdown-menu-sub-footer">View all messages</a>
								</li>	
							</ul>
						</li>
						<!-- end: Message Dropdown -->
						<li>
							<a class="btn" href="#">
								<i class="halflings-icon white wrench"></i>
							</a>
						</li>
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <?=\Yii::$app->user->identity->truename?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>帐号设置</span>
								</li>
<!-- 								<li><a href="#"><i class="halflings-icon user"></i> 基本资料</a></li> -->
								<li><a href="<?=Url::to(['/admin/profile'])?>"><i class="halflings-icon user"></i>修改资料</a></li>
								<li><a href="<?=Url::to(['/login/logout']);?>"><i class="halflings-icon off"></i> 退出</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
<!-- 						<li><a href="index.html"><i class="icon-bar-chart"></i><span class="hidden-tablet">小说站点</span></a></li>	 -->
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> 小说站点</span></a>
							<ul>
								<li><a class="submenu" href="<?=Url::to(['/collect/index'])?>"><i class="icon-file-alt"></i><span class="hidden-tablet"> 目标小说站</span></a></li>
							</ul>	
						</li>
						<li><a href="<?=Url::to(['/index/keywords'])?>"><i class="icon-search"></i><span class="hidden-tablet"> 搜索关键词</span></a></li>
						<li><a href="<?=Url::to(['/system/index'])?>"><i class="icon-cog"></i><span class="hidden-tablet"> 系统设置</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			<?= $content ?>

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://www.zhukeshu.com/" alt="竹刻书小说网">竹刻书小说网</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

	<script src="/static/js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="/static/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="/static/js/jquery.ui.touch-punch.js"></script>
	
		<script src="/static/js/modernizr.js"></script>
	
		<script src="/static/js/bootstrap.min.js"></script>
	
		<script src="/static/js/jquery.cookie.js"></script>
	
		<script src='/static/js/fullcalendar.min.js'></script>
	
		<script src='/static/js/jquery.dataTables.min.js'></script>

		<script src="/static/js/excanvas.js"></script>
	<script src="/static/js/jquery.flot.js"></script>
	<script src="/static/js/jquery.flot.pie.js"></script>
	<script src="/static/js/jquery.flot.stack.js"></script>
	<script src="/static/js/jquery.flot.resize.min.js"></script>
	
		<script src="/static/js/jquery.chosen.min.js"></script>
	
		<script src="/static/js/jquery.uniform.min.js"></script>
		
		<script src="/static/js/jquery.cleditor.min.js"></script>
	
		<script src="/static/js/jquery.noty.js"></script>
	
		<script src="/static/js/jquery.elfinder.min.js"></script>
	
		<script src="/static/js/jquery.raty.min.js"></script>
	
		<script src="/static/js/jquery.iphone.toggle.js"></script>
	
		<script src="/static/js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="/static/js/jquery.gritter.min.js"></script>
	
		<script src="/static/js/jquery.imagesloaded.js"></script>
	
		<script src="/static/js/jquery.masonry.min.js"></script>
	
		<script src="/static/js/jquery.knob.modified.js"></script>
	
		<script src="/static/js/jquery.sparkline.min.js"></script>
	
		<script src="/static/js/counter.js"></script>
	
		<script src="/static/js/retina.js"></script>

		<script src="/static/js/custom.js"></script>
		<script src="/static/js/artDialog.js"></script>
		<script src="/static/js/common.js"></script>
	<!-- end: JavaScript-->
	<?php 
if( Yii::$app->getSession()->hasFlash('error') || Yii::$app->getSession()->hasFlash('success')) {
?>
<script type="text/javascript">
$(function(){
	alertMsg('<?=(Yii::$app->getSession()->hasFlash('error')) ? Yii::$app->getSession()->getFlash('error') : Yii::$app->getSession()->getFlash('success');?>');
});
</script>
<?php
}
?>
</body>
</html>
