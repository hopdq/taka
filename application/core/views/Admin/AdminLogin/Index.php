<!DOCTYPE html>
<?php 
	$this->load->helper('url');
?>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
		<title> Đăng nhập vào hệ thống </title>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/bootstrap.min.css')?>">	
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/font-awesome.min.css')?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/Content/css/smartadmin-production.css')?>">
		<script src="<?php echo base_url('application/Content/Js/libs/jquery-2.0.2.min.js')?>"></script>
		<script src="<?php echo base_url('application/Content/Js/libs/knockout-3.3.0.js')?>"></script>
		<style>
			.login-box{
				width: 40%;
				margin: 0px auto;
			}
		</style>
	</head>
	<body id="login" class="animated fadeInDown">
		<div id="main" role="main">
			<!-- MAIN CONTENT -->
			<div id="content" class="container">
				<div class="row">
					<div class="login-box">
						<div class="well no-padding">
							<form id="login-form" class="smart-form client-form" data-bind="submit: loginFormSubmit">
								<input type="hidden" id="PostUrl" value = <?php echo site_url(array('AdminLogin', 'Login'))?> />
								<input type="hidden" id="HomeUrl" value = <?php echo site_url(array('AdminHome'))?> />
								<header>
									Đăng nhập hệ thống
								</header>
								<fieldset>
									<p class="alert alert-warning" id="login-fail" style="display: none">
										<i class="fa fa-warning fa-fw fa-lg"></i><strong>Cảnh báo!</strong> 
										Tên đăng nhập và mật khẩu không đúng
									</p>
									<section>
										<label class="label">E-mail</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="email" name="email" data-bind="value: email">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Nhập Email</b></label>
									</section>

									<section>
										<label class="label">Mật khẩu</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password" data-bind="value: password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Nhập mật khẩu</b> </label>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary" id="submitBtn">
										Đăng nhập
									</button>
								</footer>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- BOOTSTRAP JS -->		
		<script src="<?php echo base_url('application/Content/Js/bootstrap/bootstrap.min.js')?>"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url('application/Content/Js/plugin/jquery-validate/jquery.validate.min.js')?>"></script>

		<script type="text/javascript">
			function loginModel(){
				var self = this;
				self.email = "";
				self.password = "";
				self.loginFormSubmit = function(){
					var check = $('#login-form .state-error').length;
					if(check <= 0)
					{
						var url = $('#PostUrl').val();
						var email = self.email;
						var password = self.password;
						$.post(url, { email: email, password: password }, function(status){
							if(status){
									window.location.href = $('#HomeUrl').val();
								}
							else{
									$('#login-fail').slideDown();
								}
						})
					}
				}
			}
			$(function() {
				var model = new loginModel();
				ko.applyBindings(model);
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true,
							email : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Vui lòng nhập Email',
							email : 'Email không đúng định dạng'
						},
						password : {
							required : 'Vui lòng nhập mật khẩu'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>
	</body>
</html>