<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>beatle</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="<?php echo ASSETS_URL; ?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />

		<link href="<?php echo ASSETS_URL; ?>css/custom_style.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<style type="text/css">
		.panel.panel-inverse{
			border: 0px solid black !important;

		}
		.error{
			color:#900 !important;
			height:35px !important;
			text-align: left !important;
		}
	</style>
	
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	 <?php if($this->session->flashdata('success')) { ?>
		 <div id="gritter-notice-wrapper">
			 <div id="gritter-item-4" class="gritter-item-wrapper" style="" role="alert">
			 		<div class="gritter-top"></div>
			 		<div class="gritter-item">
			 			<a class="gritter-close" href="#" tabindex="1" style="display: none;">Close Notification</a>
			 			<div class="gritter-without-image">
			 				<span class="gritter-title">Message</span>
			 				<p> <?php echo $this->session->flashdata('message')?></p>
			 			</div>
			 			<div style="clear:both"></div>
			 		</div>
			 		<div class="gritter-bottom"></div>
			 	</div>
		 </div>
     <?php }?>
	<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><b>B</b> aris</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				
				
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo ASSETS_URL; ?>img/user/user-13.jpg" alt="" /> 
						<span class="d-none d-md-inline">Sidharth J</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:;" class="dropdown-item">Edit Profile</a>
						
						<div class="dropdown-divider"></div>
						<a href="<?php echo ADMIN_URL?>logout" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>