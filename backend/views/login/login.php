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
	<title>后台登录</title>
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
	
			<style type="text/css">
			body { background: url(/static/img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>登录你的帐号</h2>
					<form class="form-horizontal" action="<?Url::to(['/login/login'])?>" method="post">
					<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="Admin[username]" id="username" type="text" placeholder="帐号"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="Admin[password]" id="password" type="password" placeholder="密码"/>
							</div>
							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input type="checkbox" name="Admin[rememberMe]" id="remember" />记住密码</label>

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">登录</button>
							</div>
							<div class="clearfix"></div>
					</form>
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
	<!-- start: JavaScript-->

		<script src="/static/js/jquery-1.9.1.min.js"></script>
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
