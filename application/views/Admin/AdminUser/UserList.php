<?php 
	$this->load->helper('url');
?>
	<div class="dt-wrapper" id="DtWrapper">
		<table id="dt_basic" class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
			<thead>
				<tr role="row">
				<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 5%; text-align: center">Stt</th>
				<th class="sorting" role="columnheader" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 20%; text-align: center">Họ tên</th>
				<th class="sorting" role="columnheader" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 20%; text-align: center">Email</th>
				<th class="sorting" role="columnheader" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 15%; text-align: center">Ngày tạo</th>
				<th style = "width :7%; text-align: center" >Mật khẩu</th>
				<th style="width: 4%; text-align: center">Sửa</th>
				<th style="width: 4%; text-align: center">Xóa</th>
				</tr>
			</thead>
			<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php 	$i = 1;
						foreach($data->listUsers as $user){
					?>
					<tr id = "<?php echo $user->Id;?>" class="<?php echo $i % 2 == 0 ? 'odd' : 'event';?>">
						<td class=" sorting_1" align="center"><?php echo $i++;?></td>
						<td id="<?php echo "name-".$user->Id ?>" class=""><?php echo $user->Name;?></td>
						<td class=" "><?php echo $user->Email;?></td>
						<td class=" "><?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $user->CreateDate); echo $date->format('d/m/Y')?></td>
						<td align = "center" ><div href="Javascript:void(0)" class = "changePasswordButtons" onclick="ChangePassword('<?php echo site_url(array('AdminUser','ChangePassword', $user->Id)); ?>');" class="btn btn-primary"><i class="fa  fa-lock fa-2x "></i></button></td>
						<td align = "center" ><div href="Javascript:void(0)" onclick = "EditUserPopup('<?php echo site_url(array('AdminUser','EditUser', $user->Id)); ?>')" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
						<td align = "center" ><a href="Javascript:void(0)" onclick = "DeleteUser('<?php echo site_url(array('AdminUser','DeleteUser', $user->Id)); ?>', <?php echo $user->Id; ?>)" class="btn btn-primary btn-danger btn-sm"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
					</tr>
				<?php
				}?>
				
			</tbody>
		</table>
		<div id="changedPasswordUserPopup"></div>
		<div id="addedUserPopup"></div>
		<div id="editedUserPopup"></div>
		<input type="hidden" id="UrlLoadData" value= "<?php echo site_url(array('AdminUser', 'LoadData')); ?>"/>
	</div>

<script src="<?php echo base_url('/application/Content/Js/jquery.form.js')?>"></script>
<script type="text/javascript">
	function LoadPageData(page){
			var keyword = $('#keyword').val();
			var categoryId = $('#CategoryFilter').val();
			var status = $('#StatusFilter').val();
			var url = $('#UrlLoadData').val();
			$('#DtWrapper').load(url, { keyword : keyword, categoryId : categoryId, status : status, page: page }, function(){});
	}
	function FilterProcess(){
		LoadPageData(1);
	}
	//
	function ChangePassword(url) {
		$('#changedPasswordUserPopup').load(url, function(){
			var $registerForm = $("#changingPasswordUserForm").validate({
				// Rules for form validation
				rules : {
					password : {
						required : true,
						minlength : 3,
						maxlength : 20
					},
					passwordConfirm : {
						required : true,
						minlength : 3,
						maxlength : 20,
						equalTo : '#password-field'
					}
				},

				// Messages for form validation
				messages : {
					password : {
						required : 'Nhập mật khẩu người dùng (chứa ít nhất 3 kí tự) !'
					},
					passwordConfirm : {
						required : 'Vui lòng nhập lại mật khẩu !',
						equalTo : 'Vui lòng nhập mật khẩu trùng với mật khẩu bên trên !'
					}
				},
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
			$('#changingPasswordUserForm').ajaxForm(function(data){
				if (data == -1) {
					ShowAlert("Thay đổi mật khẩu không thành công! Vui lòng thao tác lại !","danger");
				} else {
					ShowAlert('Thay đổi mật khẩu thành công!', "success");
					CancelPopup();
				}
			});
		});
	}
	//
	function DeleteUser(url, id) {
		var cf = confirm('Bạn có muốn xóa người dùng này ?');
		if (cf == true) {
			$.get(url, function(data) {
				if (data == 0) {
					ShowAlert("Xảy ra lỗi trong quá trình xóa người dùng ! Vui lòng thao tác lại !", "danger");
				} else {
					var tr = document.getElementById(id);
					  if (tr) {
					    if (tr.nodeName == 'TR') {
					      var tbl = tr; // Look up the hierarchy for TABLE
					      while (tbl != document && tbl.nodeName != 'TABLE') {
					        tbl = tbl.parentNode;
					      }

					      if (tbl && tbl.nodeName == 'TABLE') {
					        while (tr.hasChildNodes()) {
					          tr.removeChild( tr.lastChild );
					        }
					      tr.parentNode.removeChild( tr );
					      }
					    }
					}
					ShowAlert("Xóa thành công người dùng !", "success");
				}
			});
		}
		else {
			return 0;
		}
	}
	//
	function EditUserPopup(url){
		$('#editedUserPopup').load(url, function(){
			var $registerForm = $("#editingUserForm").validate({
				// Rules for form validation
				rules : {
					username : {
						required : true
					}
				},

				// Messages for form validation
				messages : {
					username : {
						required : 'Vui lòng nhập tên mới ! ( Chứa ít nhất 1 kí tự)!'
					}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
			$('#editingUserForm').ajaxForm(function(data){
				if (data == -1) {
					ShowAlert("Xảy ra lỗi trong quá trình sửa thông tin người dùng ! Vui lòng thực hiện lại!", "danger");
				} else {
					var jsonData = JSON.parse(data);
					$('#name-' + jsonData.Id).html(jsonData.Name);
					ShowAlert('Thông tin người dùng đã được sửa thành công !', "success");
					CancelPopup();
				}
			});
		});
	}
	//
	function AddUserPopup(url){
		$('#addedUserPopup').load(url, function(){
			var $registerForm = $("#addingUserForm").validate({
				// Rules for form validation
				rules : {
					username : {
						required : true
					},
					email : {
						required : true,
						email : true
					},
					password : {
						required : true,
						minlength : 3,
						maxlength : 20
					},
					passwordConfirm : {
						required : true,
						minlength : 3,
						maxlength : 20,
						equalTo : '#password-field'
					}
				},

				// Messages for form validation
				messages : {
					username : {
						required : 'Vui lòng nhập tên người dùng !'
					},
					email : {
						required : 'Vui lòng nhập địa chỉ e-mail người dùng !',
						email : 'Vui lòng nhập địa chỉ E-mail hợp lệ !'
					},
					password : {
						required : 'Nhập mật khẩu người dùng (chứa ít nhất 3 kí tự) !'
					},
					passwordConfirm : {
						required : 'Vui lòng nhập lại mật khẩu !',
						equalTo : 'Vui lòng nhập mật khẩu trùng với mật khẩu bên trên !'
					}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
			$('#addingUserForm').ajaxForm(function(data){
				if (data == -1) {
					ShowAlert("Xảy ra lỗi trong quá trình thêm người dùng ! Vui lòng thực hiện lại!", "danger");
				} else {
					if ($('#dt_basic tbody tr:first-child').length == 0) {
						$('#dt_basic tbody').html(data);
					} else {
						$('#dt_basic tbody tr:first-child').before(data);
					}
					ShowAlert("Đã thêm thành công người dùng mới !", "success");
					$('#addedUserPopup').html("");
					$('#addingUserPage').html("");
				}
			});
		});
	}
</script>