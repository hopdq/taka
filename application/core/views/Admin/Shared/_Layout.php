<!DOCTYPE html>
<?php 
	$this->load->helper('url');
?>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title><?php echo $title; ?></title>
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Use the correct meta names below for your web application
			 Ref: http://davidbcalhoun.com/2010/viewport-metatag 
			 
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/bootstrap.min.css')?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/font-awesome.min.css')?>">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/smartadmin-production_unminified.css')?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/smartadmin-skins.css')?>">

		<!-- SmartAdmin RTL Support is under construction
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/smartadmin-rtl.css')?>"> -->

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/your_style.css')?>"> -->

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/admin.css')?>">
		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="<?php echo base_url('application/Content/Js/libs/jquery-2.0.2.min.js')?>"></script>
		<script src="<?php echo base_url('application/Content/Js/libs/knockout-3.3.0.js')?>"></script>
	</head>
	<body class="">
		<!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->
		<!-- alert -->
		<article class="col-sm-12 alert-box">
			<div class="alert alert-warning fade in alert-item" id="alert-warning">
				<button class="close" data-dismiss="alert">
					×
				</button>
				<i class="fa-fw fa fa-warning"></i>
				<strong>Warning</strong> <span class="message"></span>
			</div>
	
			<div class="alert alert-success fade in alert-item" id="alert-success">
				<button class="close" data-dismiss="alert">
					×
				</button>
				<i class="fa-fw fa fa-check"></i>
				<strong>Success</strong> <span class="message"></span>
			</div>
	
			<div class="alert alert-info fade in alert-item" id="alert-info">
				<button class="close" data-dismiss="alert">
					×
				</button>
				<i class="fa-fw fa fa-info"></i>
				<strong>Info!</strong> <span class="message"></span>
			</div>
	
			<div class="alert alert-danger fade in alert-item" id="alert-danger">
				<button class="close" data-dismiss="alert">
					×
				</button>
				<i class="fa-fw fa fa-times"></i>
				<strong>Error!</strong> <span class="message"></span>
			</div>
		</article>
		<!-- end alert -->
		<!-- HEADER -->
		<header id="header">
			<?php
				$this->load->view("Admin/Shared/_Header");
			?>
		</header>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">
			<?php 
				if(isset($data))
				{
					$navi['data'] = $data->navigator; 
				}
				else{
					$navi['data'] = null;
				}
				$this->load->view("Admin/Shared/_Navigation", $navi)
			?>
		</aside>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">
			<?php 
			if(isset($data))
			{
				$model['data'] = $data->content; 
			}
			else{
				$model['data'] = null;
			}
			$this->load->view($content_view, $model)?>
		</div>
		<!-- END MAIN PANEL -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<input type="hidden" id="baseUrl" value="<?php echo base_url();?>" />
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo base_url('application/Content/Js/libs/jquery-ui-1.10.3.min.js')?>"><\/script>');
			}
		</script>
		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url('application/Content/Js/bootstrap/bootstrap.min.js')?>"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo base_url('application/Content/Js/smartwidgets/jarvis.widget.min.js')?>"></script>
		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url('application/Content/Js/plugin/jquery-validate/jquery.validate.min.js')?>"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url('application/Content/Js/app.js')?>"></script>
		<!-- Full Calendar -->
		<script src="<?php echo base_url('application/Content/Js/app/common.js')?>"></script>
		<!-- Full Calendar 
		<script src="<?php echo base_url('application/Content/Js/plugin/ckeditor/ckeditor.js')?>"></script>-->
	</body>

</html>