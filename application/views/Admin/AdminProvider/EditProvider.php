<style>
#addingUserPopup {
	position: absolute;
	top:10%;
	right: 2%;
	width: 80%;
	padding-top: 10px;
}
#headerPopup {
	background-color: #C2C2C2;
	color: white;
	font-family: arial;
	height: 50px;
	text-align: center;
}
#title {
	position: fixed;
}
#footerPopup {
	height: 50px;
	margin-right: 25%;
}
#cancelButton, #saveButton {
	width: 25%;
}
</style>
<script src="<?php echo base_url('/application/Content/Js/angular.min.js')?>"></script>
<script src="<?php echo base_url('/application/Content/Js/app/EditProvider.model.js')?>"></script>
<script src="<?php echo base_url('/application/Content/Js/jquery.form.js')?>"></script>
<div id = "addingUserPage" ng-app="EditProviderApp">
	<input type = "hidden" name = "baseUrl" id = "baseUrl" value = "<?php echo base_url();?>"/>
	<input type = "hidden" name = "proId" id = "proId" value = "<?php echo $data;?>"/>
	<div id = "addingUserPopup" ng-controller="EditProviderController">
	<div class="col-sm-12 col-md-12 col-lg-6 jarviswidget jarviswidget-sortable" id="wid-id-1" role="widget" style="">
		<header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="#" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-resize-full "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div>
			<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
			<h2>Sửa thông tin nhà cung cấp</h2>
		</header>
		<!-- widget div-->
		<div role="content">
			<!-- widget content -->
			<div class="widget-body no-padding">

				<form class="smart-form">
					<fieldset>
						<section>
							<label class="label">Nhà cung cấp: </label>
							<label class="input">
								<i class="icon-append fa fa-font"></i>
								<input type="text" id="name-field" ng-model="pro.Name" name="username" placeholder="Tên nhà cung cấp">
							</label>
						</section>
						<section>
							<label class="label">Mã nhà cung cấp: </label>
							<label class="input">
								<i class="icon-append fa fa-font"></i>
								<input type="text" id="name-field" ng-model="pro.Code" name="username" placeholder="Nhập mã nhà cung cấp">
							</label>
						</section>

						<section>
							<label class="label">Logo: </label>
								<label>
									<img ng-src= "{{ baseUrl + pro.LogoUrl}}" alt = "Logo" width="60px" height="60px" />
								</label>
							</label>
						</section>
						<section>
							<label class="label">Đặc tả:</label>
								<label class="input">
								<textarea ng-model = "pro.Description" rows="6" cols="60" placeholder = "Một vài thông tin về nhà cung cấp"></textarea>
							</label>
						</section>
					</fieldset>
					<footer>
						<button type="submit" class="btn btn-primary" ng-click = "completeEditingProviderProcess();">
							Lưu lại
						</button>
					</footer>
				</form>
			</div>
			<!-- end widget content -->
		</div>
		<!-- end widget div -->
	</div>
	<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
		<div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-0" data-widget-editbutton="false">
			<header>
				<span class="widget-icon"> <i class="fa fa-cloud"></i> </span>
				<h2>Hình ảnh</h2>
			</header>
			<div>
				<div class="jarviswidget-editbox">
				</div>
				<div class="widget-body">
					<form action="<?php echo site_url(array('AdminProvider', 'FileUpload')); ?>" class="dropzone" id="myDropzone">
					</form>
				</div>
			</div>
		</div>
	</article>
	<input type = "hidden" id="addTempImg" ng-click="addTempImg()" /> 
	<input type = "hidden" id="removeTempImg" ng-click="removeTempImg()" /> 
	<input type = "hidden" id="clickBinding" ng-click ="init()" /> 
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('application/Content/Js/plugin/dropzone/dropzone.min.js')?>"></script>
<script type="text/javascript">
	$('document').ready(function(){
		$('#clickBinding').click();
		Dropzone.autoDiscover = false;
		Dropzone.options.myDropzone = {
		  init: function() {
		    this.on("success", function(file, responseText) {
		    	var jsonData = JSON.parse(responseText);
		    	$('#addTempImg').attr({ 'urlPath' : jsonData[0], 'fullPath' : jsonData[1]});
		    	$('#addTempImg').click();
		    	var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-danger btn-block' item-prop='" + jsonData[0] + "'>Xóa</button>");
		        var _this = this;
		        removeButton.addEventListener("click", function(e) {
		          e.preventDefault();
		          e.stopPropagation();
		          var path = this.getAttribute("item-prop");
		          $('#removeTempImg').attr('urlPath',jsonData[0]);
		          $('#removeTempImg').click();
		          _this.removeFile(file);
		        });
		        file.previewElement.appendChild(removeButton);
		    });
		  }
		};
		$("#myDropzone").dropzone({
			maxFilesize: 0.5,
			dictResponseError: 'Error uploading file!'
		});
	});
</script>