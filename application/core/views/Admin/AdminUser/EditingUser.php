<?php 
	$this->load->helper('url');
?>
<style>
<!--
#editingUserPage {
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
#editingUserPopup {
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
	$editingUser = $data->content->editingUser;
	$id = $editingUser->Id;
	$name = $editingUser->Name;
	$email = $editingUser->Email;
?>
<div id = "editingUserPage"></div>
<div id = "editingUserPopup">
	<div class="jarviswidget jarviswidget-sortable" role="widget">
			<header role="heading">Thay đổi thông tin người dùng</header>
			<div role="content">
			<div class="dt-wrapper" id="DtWrapper">
				<div class="widget-body no-pediting">
					<form id="editingUserForm" action="<?php echo site_url(array('AdminUser', 'EditProcess'));?>" class="smart-form" novalidate="novalidate" method="POST" >
							<fieldset class = "editingField">
								<section>
									<label>Tên người dùng: </label>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" id = "name-field" name="username" placeholder="Tên người dùng" value="<?php echo $name;?>">
										<b class="tooltip tooltip-bottom-right">Nhập tên người dùng</b> </label>
								</section>
								
								<section>
									<label>E-mail: </label>
									<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
										<input style = "background-color:#A3C2C2;" type="email" id = "email-field" name="email" value="<?php echo $email;?>" disabled = "disabled">
										<b class="tooltip tooltip-bottom-right">Địa chỉ E-mail</b>
									</label>
								</section>
								
							</fieldset>
							<footer id = "footerPopup" class = "editingField">	
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
	$('#editedUserPopup').html("");
}	
//
</script>