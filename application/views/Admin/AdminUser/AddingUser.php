<?php 
	$this->load->helper('url');
?>
<style>
<!--
#addingUserPage {
	width:100%;
	height:100%;
	position: fixed;
	top: 0%;
	left: 0%;
	z-index: 1.5;
	opacity: 0.5;
    filter: Alpha(opacity=50);
    background-color: black;
}
#addingUserPopup {
	width: 35%;
	position: fixed;
	left: 30%;
	top: 25%;
	background-color: white;
}
.jarviswidget > header{
	width: 100%;
	padding: 0px 13px;
}
-->
</style>

<div id = "addingUserPage"></div>
<div id = "addingUserPopup">
	<div class="jarviswidget jarviswidget-sortable" role="widget">
		<header role="heading">Thêm người dùng mới</header>
		<div role="content">
			<div class="dt-wrapper" id="DtWrapper">
				<div class="widget-body no-padding">
					<form id="addingUserForm" action="<?php echo site_url(array('AdminUser', 'AddingProcess'));?>" class="smart-form" novalidate="novalidate" method="POST" >
						<fieldset class = "addingField">
							<section>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="text" id = "name-field" name="username" placeholder="Tên người dùng">
									<b class="tooltip tooltip-bottom-right">Nhập tên người dùng</b> </label>
							</section>
							
							<section>
								<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
									<input id = "email-field" type="email" name="email" placeholder="Địa chỉ E-mail (abc@gmail.com)">
									<b class="tooltip tooltip-bottom-right">Nhập địa chỉ E-mail người dùng</b> </label>
							</section>

							<section>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" id = "password-field" name="password" placeholder="Mật khẩu đăng nhập" id="password">
									<b class="tooltip tooltip-bottom-right">Nhập mật khẩu ( ít nhất 3 kí tự)</b> </label>
							</section>

							<section>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" id = "passwordConfirm-field" name="passwordConfirm" placeholder="Mật khẩu xác nhận">
									<b class="tooltip tooltip-bottom-right">Nhập lại mật khẩu đăng nhập</b> </label>
							</section>
							
						</fieldset>
						<footer id = "footerPopup" class = "addingField">	
							<button type="submit" id = "saveButton" class="btn btn-primary">
								Lưu lại
							</button>
							
							<a id = "cancelButton" class="btn btn-primary" onclick="CancelPopup();">Hủy</a>
						</footer>
					</form>					
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function CancelPopup() {
		$('#addedUserPopup').html("");
	}	
//
</script>