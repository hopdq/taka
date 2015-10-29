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
<script src="<?php echo base_url('/application/Content/Js/app/AddBanner.model.js')?>"></script>
<script src="<?php echo base_url('/application/Content/Js/jquery.form.js')?>"></script>
<div id = "addingUserPage" ng-app="AddBannerApp">
	<input type = "hidden" name = "baseUrl" id = "baseUrl" value = "<?php echo base_url();?>"/>
	<div id = "addingUserPopup" ng-controller="AddBannerController">
	<div class="col-sm-12 col-md-12 col-lg-6 jarviswidget jarviswidget-sortable" id="wid-id-1" role="widget" style="">
		<header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="#" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-resize-full "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div>
			<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
			<h2>Thêm mới banner</h2>
		</header>
		<!-- widget div-->
		<div role="content">
			<!-- widget content -->
			<div class="widget-body no-padding">

				<form class="smart-form">
					<fieldset>
						<section>
							<label class="label">Tiêu đề ảnh: </label>
							<label class="input">
								<i class="icon-append fa fa-font"></i>
								<input type="text" id="name-field" ng-model="infor.Title" name="username" placeholder="Tiêu đề ảnh">
							</label>
						</section>
						<div class="row">
							<section class="col col-6">
								<label class="select">
									<select id = "codeChoice" onchange="getCode();">
										<option value="" selected="">---Chọn vị trí---</option>
										<option value="<?php echo bannerPosition::HomeSlider; ?>"><?php echo bannerPosition::HomeSlider; ?></option>
										<option value="<?php echo bannerPosition::HomeHeader; ?>"><?php echo bannerPosition::HomeHeader; ?></option>
										<option value="<?php echo bannerPosition::DetailRightBar; ?>"><?php echo bannerPosition::DetailRightBar; ?></option>
									</select>
									<input type = "hidden" id = "code" />
									<i></i>
								</label>
							</section>
						</div>

						<section>
							<label class="label">Đường link: </label>
								<label class="input">
								<i class="icon-append fa fa-link"></i>
								<input ng-model = "infor.Link" id = "email-field" type="text" name="email" placeholder="Link">
							</label>
							<br/>
							<label class="label"> Url ảnh: </label>
							<label class="input" ng-repeat = "img in tempImgs">
								<i class="icon-append fa fa-link"></i>
								<input ng-model = "img.fullPath" id = "email-field" type="text" name="email" placeholder="Đường link ảnh">
							</label>
						</section>
					</fieldset>
					<!-- <div style="margin: 5px; float:left; width: 100%;">
						<div class="superbox col-sm-12">
							<div class="col-sm-3 img-item" ng-repeat="data in tempImgs">
								<div class="img">
									<img src="{{data.fullPath}}" class="superbox-img" />
								</div>
								<div class="act-bar">
									<a class="btn btn-sm btn-danger btn-block" ng-click="$parent.removeMappedImg">Xóa</a>
								</div>
							</div>
						</div>
					</div> -->
					<footer>
						<button type="submit" class="btn btn-primary" ng-click = "completeAddingImgsProcess();">
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
					<form action="<?php echo site_url(array('AdminBanner', 'FileUpload')); ?>" class="dropzone" id="myDropzone">
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
	function getTitle(img) {
		var title = img.value;
		title = title.substr(12);
		return title;
	}
	function getCode() {
		var code = $('#codeChoice').val();
		$('#code').val(code);
	}
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