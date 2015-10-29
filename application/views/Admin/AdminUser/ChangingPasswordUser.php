<?php 
	$this->load->helper('url');
?>
<style>
<!--
#changingPasswordUserPage {
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
#changingPasswordUserPopup {
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
<?php
	$changingPasswordUser = $data->content->changingPasswordUser;
	$id = $changingPasswordUser->Id;
	$name = $changingPasswordUser->Name;
	$email = $changingPasswordUser->Email;
?>
<div id = "changingPasswordUserPage"></div>
<div id = "changingPasswordUserPopup">
	<div class="jarviswidget jarviswidget-sortable" role="widget">
		<header role="heading">Đổi mật khẩu</header>
		<div role="content">
			<div class="dt-wrapper" id="DtWrapper">
				<div class="widget-body no-pediting">
					<form id="changingPasswordUserForm" action="<?php echo site_url(array('AdminUser', 'ChangePasswordProcess'));?>" class="smart-form" novalidate="novalidate" method="POST" >
						<fieldset class = "changingPasswordField">
							<section>
								<label>Tên người dùng: </label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="text" style = "background-color:#A3C2C2;" id = "name-field" name="username" placeholder="Tên người dùng" value="<?php echo $name;?>" disabled = "disabled">
									<b class="tooltip tooltip-bottom-right">Tên người dùng</b> </label>
							</section>
							
							<section>
								<label>E-mail: </label>
								<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
									<input style = "background-color:#A3C2C2;" type="email" id = "email-field" name="email" value="<?php echo $email;?>" disabled = "disabled">
									<b class="tooltip tooltip-bottom-right">Địa chỉ E-mail</b>
								</label>
							</section>

							<section>
								<label>Mật khẩu: </label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" id = "password-field" name="password" placeholder="Mật khẩu đăng nhập" id="password">
									<b class="tooltip tooltip-bottom-right">Nhập mật khẩu ( ít nhất 3 kí tự)</b> </label>
							</section>

							<section>
								<label>Nhập lại mật khẩu</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" id = "passwordConfirm-field" name="passwordConfirm" placeholder="Mật khẩu xác nhận">
									<b class="tooltip tooltip-bottom-right">Nhập lại mật khẩu đăng nhập</b> </label>
							</section>
						</fieldset>
						<footer id = "footerPopup" class = "changingPasswordField">	
							<button type="submit" id = "saveButton" class="btn btn-primary">
								<strong>Lưu lại</strong>
							</button>
							<input type = "button" style="font-family: arial;" id = "cancelButton" class="btn btn-primary" onclick="CancelPopup();" value = "Hủy">
						</footer>
						<input type = "hidden" name="id" value="<?php echo $id; ?>" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
//
function CancelPopup() {
	$('#changedPasswordUserPopup').html("");
}	
//
</script>