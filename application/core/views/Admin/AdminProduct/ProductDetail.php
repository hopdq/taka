<?php  
	$this->load->helper('url');
?>
<div class="jarviswidget jarviswidget-sortable" id="productDetailZone" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">

	<header role="heading">
		<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
		<h2>Thêm mới sản phẩm</h2>				
		
	<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
		<ul id="widget-tab-1" class="nav nav-tabs pull-right">
			<li class="active">
				<a data-toggle="tab" href="#hr1"> 
					<i class="fa fa-lg fa-arrow-circle-o-down"></i> 
					<span class="hidden-mobile hidden-tablet"> Thông tin chính </span> 
				</a>
			</li>
			<li data-bind="visible: attrTabVisible">
				<a data-toggle="tab" href="#hr2"> 
					<i class="fa fa-lg fa-arrow-circle-o-up"></i> 
					<span class="hidden-mobile hidden-tablet"> Thuộc tính </span>
				</a>
			</li>
		</ul>
	</header>

	<!-- widget div-->
	<div role="content" class="tab-content">
		<div id="hr1" class="tab-pane fade active in">
		<!-- widget edit box -->
			<div class="jarviswidget-editbox">
				<!-- This area used as dropdown edit box -->
				
			</div>
			<!-- end widget edit box -->
			
			<!-- widget content -->
			<div class="widget-body no-padding">
				
				<form id="smart-form-product" class="smart-form" novalidate="novalidate" data-bind="submit: saveProductInfo">
					<fieldset>
					<div class="col col-6">
						<div class="row">
							<section class="col col-3">
								<label class="input">
									<input type="text" name="Code" id="Code" placeholder="Mã sản phẩm" data-bind="value: product.Code, attr: { readonly: attrTabVisible }">
									<b class="tooltip tooltip-bottom-right">Nhập mã sản phẩm</b> 
								</label>
							</section>
						</div>
					
						<div class="row">
							<section class="col col-10">
								<label class="input">
									<input type="text" name="Name" id="Name" placeholder="Tên sản phẩm" data-bind="value: product.Name">
									<b class="tooltip tooltip-bottom-right">Nhập tên sản phẩm</b> 
								</label>
							</section>
						</div>
					
						<div class="row">
							<section class="col col-4">
								<label class="label">Danh mục sản phẩm</label>
							</section>
							<section class="col col-6">
								<label class="select">
									<select name="CategoryId" id="CategoryId" data-bind="options: listCategories, optionsValue: 'Id', optionsText: 'textName', value: product.CategoryId">
									</select> 
									<i></i> 
								</label>
							</section>
						</div>
					
						<div class="row">
							<section class="col col-4">
								<label class="label">Trạng thái</label>
							</section>
							<section class="col col-6">
								<label class="select">
									<select name="Status" id="Status" data-bind="options: listStatuses, optionsValue: 'Id', optionsText: 'Name', value: product.Status">
									</select> 
									<i></i> 
								</label>
							</section>
						</div>
						
						<div class="row">
							<section class="col col-4">
								<label class="label">Thương hiệu</label>
							</section>
							<section class="col col-6">
								<label class="select">
									<select name="ProviderId" id="ProviderId" data-bind="options: listProviders, optionsValue: 'Id', optionsText: 'Name', value: product.ProviderId">
									</select>
									<i></i> 
								</label>
							</section>
						</div>
					</div>

					<div class="col col-6">
						<div class="row">
							<section class="col col-3">
								<label class="label">Giá</label>
							</section>
							<section class="col col-4">
								<label class="input">
									<input type="text" name="Price" id="Price" placeholder="Giá sản phẩm" data-bind="value: priceBinding" onkeydown="validatePriceKeycode(event)" onkeyup="formatPrice(event, this)">
									<b class="tooltip tooltip-bottom-right">Nhập giá sản phẩm</b> 
								</label>
							</section>
						</div>
					
						<div class="row">
							<section class="col col-3">
								<label class="label">Khuyến mại</label>
							</section>
							<section class="col col-4">
								<label class="input">
									<input type="text" name="PromotionValue" id="PromotionValue" placeholder="Khuyến mại" data-bind="value: promotionValueBinding" onkeydown="validatePriceKeycode(event)" onkeyup="formatPrice(event, this)">
									<b class="tooltip tooltip-bottom-right">Nhập khuyến mại</b> 
								</label>
							</section>
							<section class="col col-4">
								<label class="checkbox">
									<input type="checkbox" name="IsPercentPromotion" id="IsPercentPromotion" data-bind="checked: product.IsPercentPromotion">
									<i></i>% khuyến mại
								</label>
							</section>
						</div>
					
						<div class="row">
							<section>
								<label class="textarea">
									<textarea rows = "3" name="PromotionDesc" id="PromotionDesc" placeholder="Mô tả khuyến mại" data-bind="value: product.PromotionDesc"></textarea>
									<b class="tooltip tooltip-top-left">Nhập mô tả khuyến mại</b> 
								</label>
							</section>
						</div>
					</div>
					</fieldset>
					<fieldset>
						<section>
							<label class="textarea"> 										
								<textarea rows="3" class="custom-scroll" name="Summary" id="Summary" placeholder="Mô tả ngắn" data-bind="value: product.Summary"></textarea> 
								<b class="tooltip tooltip-top-left">Nhập mô tả ngắn</b> 
							</label>
						</section>
						<section>
							<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<!-- Widget ID (each widget will need unique ID)-->
								<div>
									<section>
										<label class="label">Mô tả chi tiết</label>
									</section>
					
									<!-- widget div-->
									<section>
										
										<!-- widget edit box -->
										<div class="jarviswidget-editbox">
											<!-- This area used as dropdown edit box -->
											
										</div>
										<!-- end widget edit box -->
										
										<!-- widget content -->
										<div class="widget-body">
											<textarea id="content" name="content" data-bind="text: product.Description"></textarea>	
										</div>
										<!-- end widget content -->
										
									</section>
									<!-- end widget div -->
									
								</div>
								<!-- end widget -->
							</article>
						</section>
					</fieldset>
					<footer>
						<button type="submit" class="btn btn-primary">
							Lưu lại
						</button>
					</footer>
				</form>						
				
			</div>
			<!-- end widget content -->
		</div>
		<div id="hr2" class="tab-pane fade">
			<article id="attrActionZone" class="row">
				<a class="btn btn-primary" id="saveAttrBtn" href="javascript:void(0)" data-bind="click: updateProductAttr">
					Lưu lại
				</a>
			</article>
			<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
				
				<!-- Widget ID (each widget will need unique ID)-->
				
				<!-- end widget -->
	
				<div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget" style="">
					<header role="heading"> 
						<span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
						<h2>Thuộc tính</h2>
					<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
	
					<!-- widget div-->
					<div role="content">
	
						<!-- widget edit box -->
						<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
	
						</div>
						<!-- end widget edit box -->
	
						<!-- widget content -->
						<div class="widget-body">
	
							<div class="tree smart-form">
								<ul role="tree" data-bind="foreach: listAttributeValues">
									<li class="parent_li" role="treeitem">
										<span title="Expand this branch"> <i class="fa fa-lg fa-plus-circle"></i> <span data-bind="text: Name"></span></span>
										<ul role="group" data-bind="foreach: listAttrValues">
											<li class="parent_li" role="treeitem" style="display: none;">
												<li style="display: none;">
													<span> 
														<label class="checkbox inline-block" data-bind="if: $parent.Code != 'mau-sac'">
															<input type="checkbox" name="checkbox-inline" data-bind="checked: Checked">
															<i></i><span data-bind="text: Value"></span>
														</label> 
														<label class="checkbox inline-block" data-bind="if: $parent.Code == 'mau-sac'">
															<input type="checkbox" name="checkbox-inline" data-bind="checked: Checked">
															<i></i><span class="color-item" data-bind="style: {backgroundColor: Value}"></span>
														</label> 
													</span>
												</li>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</article>
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
							<form action="<?php echo site_url(array('AdminProduct', 'FileUpload')); ?>" class="dropzone" id="myDropzone">
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="superbox col-sm-12" data-bind="foreach: listImgs">
						<div class="col-sm-3 img-item">
							<div class="img">
								<img data-bind="attr: {src: Path}" class="superbox-img">
							</div>
							<div class="act-bar">
								<a class="btn btn-sm btn-primary btn-block" data-bind="visible: $parent.imgDefaultId() != Id, click: $parent.setDefaultImg">Đặt làm đại diện</a>
								<a class="btn btn-sm btn-primary btn-block" data-bind="visible: $parent.imgDefaultId() == Id">Ảnh đại diện</a>
								<a class="btn btn-sm btn-danger btn-block" data-bind="click: $parent.removeMappedImg">Xóa</a>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
	</div>
	<input type="hidden" id="createUrl" value="<?php echo site_url(array('AdminProduct', 'createProduct')); ?>" />
	<input type="hidden" id="updateUrl" value="<?php echo site_url(array('AdminProduct', 'updateProduct')); ?>" />
	<input type="hidden" id="updateAttr" value="<?php echo site_url(array('AdminProduct', 'updateAttr')); ?>" />
	<input type="hidden" id="productId" value="<?php echo $data;?>"
</div>
<script type="text/javascript" src="<?php echo base_url('application/Content/Js/plugin/dropzone/dropzone.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('application/Content/Js/app/ProductAdminDetail.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/Content/asset/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/Content/asset/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var $registerForm = $("#smart-form-product").validate({
			// Rules for form validation
			rules : {
				Code : {
					required : true
				},
				Name : {
					required : true
				},
				Price : {
					required : true
				},
				Summary : {
					required : true
				},
				CategoryId : {
					required : true
				},
				Status : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				Code : {
					required : 'Mã sản phẩm trống'
				},
				Name : {
					required : 'Tên sản phẩm trống'
				},
				Price : {
					required : 'Giá sản phẩm trống'
				},
				Summary : {
					required : 'Mô tả ngắn trống'
				},
				CategoryId : {
					required : 'Danh mục chưa được chọn'
				},
				Status : {
					required : 'Trạng thái chưa được chọn'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		var model = new ProductAdminDetailModel();
		var productId = $('#productId').val();
		model.Init(productId, <?php echo '"'.site_url(array('AdminProduct', 'ProductAdminDetailData')).'"'; ?>);
		var baseUrl = $('#baseUrl').val();
		CKEDITOR.replace( 'content', {
			height: '500px',
		    filebrowserBrowseUrl: baseUrl + 'application/Content/asset/ckfinder/ckfinder.html',
		    filebrowserImageBrowseUrl: baseUrl + 'application/Content/asset/ckfinder/ckfinder.html?type=Images',
		    filebrowserFlashBrowseUrl: baseUrl + 'application/Content/asset/ckfinder/ckfinder.html?type=Flash',
		    filebrowserUploadUrl: baseUrl + 'application/Content/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		    filebrowserImageUploadUrl: baseUrl + 'application/Content/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		    filebrowserFlashUploadUrl: baseUrl + 'application/Content/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		} );
		Dropzone.autoDiscover = false;
		Dropzone.options.myDropzone = {
		  init: function() {
		    this.on("success", function(file, responseText) {
		    	var curModel = model;
		    	var jsonData = JSON.parse(responseText);
		    	curModel.addTempImg(jsonData);
		    	var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-danger btn-block' item-prop='" + jsonData[0] + "'>Xóa</button>");
		        var _this = this;
		        removeButton.addEventListener("click", function(e) {
		          e.preventDefault();
		          e.stopPropagation();
		          var id = this.getAttribute("item-prop");
		          curModel.removeTempImg(id);
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
	})
</script>