<!DOCTYPE html>
<?php 
	$this->load->helper('url');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/bootstrap.min.css');?>" />

    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/font-awesome.min.css');?>">

    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/prettyPhoto.css');?>">

    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/price-range.css');?>">

    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/animate.css');?>">

    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/main.css');?>">

    <link rel="stylesheet" type="text/css" media="screen" 
    	href="<?php echo base_url('application/Content/Front/css/responsive.css');?>">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo base_url('application/Content/Front/images/ico/favicon.ico');?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('application/Content/Front/images/ico/apple-touch-icon-144-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('application/Content/Front/images/ico/apple-touch-icon-114-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('application/Content/Front/images/ico/apple-touch-icon-72-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('application/Content/Front/images/ico/apple-touch-icon-57-precomposed.png');?>">
    
    <script src="<?php echo base_url('application/Content/Front/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Front/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Front/js/jquery.scrollUp.min.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Front/js/price-range.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Front/js/jquery.prettyPhoto.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Front/js/main.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Js/libs/knockout-3.3.0.js');?>"></script>
    <script src="<?php echo base_url('application/Content/Js/app/common.js');?>"></script>
</head><!--/head-->

<body>
	<?php $this->load->view('Front/Shared/_Header'); ?>
	<?php $this->load->view($content_view); ?>      
	<?php $this->load->view('Front/Shared/_Footer'); ?>
</body>
</html>