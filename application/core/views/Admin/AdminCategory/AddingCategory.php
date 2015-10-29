<?php 
	$this->load->helper('url');
?>
<?php
	$categoriesList = $data->content->categoriesList->listChilds;
	$defaultOrder = count($categoriesList)+1;
	$cateLevel1Len = count($categoriesList);
?>
<style>
#addingCategoryPage {
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
#addingCategoryPopup {
	width: 35%;
	position: fixed;
	left: 30%;
	top: 25%;
	background-color: white;
}
#headerPopup {
	background-color: #3399FF;
	color: white;
	font-family: arial;
	height: 50px;
	text-align: center;
}
.jarviswidget > header{
	width: 100%;
	padding: 0px 13px;
}
</style>
<div id = "addingCategoryPage"></div>
<div id = "addingCategoryPopup">
	<div class="jarviswidget jarviswidget-sortable" role="widget">
		<header role="heading">Thêm danh mục</header>
		<div role="content">
			<!-- widget content -->
			<div class="widget-body no-padding">
				<form id="addingCategoryForm" action="<?php echo site_url(array('AdminCategory', 'AddingCategoryProcess'));?>" class="smart-form" novalidate="novalidate" method="POST" >
					<fieldset class = "addingField">
						<section>
							<label class="input"> 
								<i class="icon-append fa fa-user"></i>
								<input type="text" id = "categoryname" name="categoryname" placeholder="Tên danh mục">
								<b class="tooltip tooltip-bottom-right">Nhập tên danh mục</b> 
							</label>
						</section>
						
						<section>
							<label class="label">Chọn thư mục chứa:</label>
							<label class="select">
								<select id="parentId" name="parentId" onchange="hintOrder('<?php echo site_url(array('AdminCategory','GetHintOrder'));?>', getValue());">
									<option value="0">--------Tất cả-------</option>
									<?php
										for ($i = 0; $i < $cateLevel1Len; $i++){
											$cate = $categoriesList[$i+1];
									?>
									<option value="<?php echo $cate->Id;?>"><?php echo $cate->Name;?></option>
											<?php
												if ($cate->listChilds != null) {
													$cateLevel2Len = count($cate->listChilds);
													for ($j = 0; $j < $cateLevel2Len; $j++) {
														$subCate = $cate->listChilds[$j+1];
											?>
													<option value="<?php echo $subCate->Id;?>"><?php echo "-- ".$subCate->Name;?></option>
											<?php
												if ($subCate->listChilds != null) {
													$cateLevel3Len = count($subCate->listChilds);
													for ($m = 0; $m < $cateLevel3Len; $m++) {
														$subSubCate = $subCate->listChilds[$m+1];
													?>
														<option value="<?php echo $subSubCate->Id;?>"><?php echo "---- ".$subSubCate->Name;?></option>
													<?php
														if ($subSubCate->listChilds != null) {
															$cateLevel4Len = count($subSubCate->listChilds);
															for ($n = 0; $n < $cateLevel4Len; $n++) {
																$ssubSubCate = $subSubCate->listChilds[$n+1];
															?>
																<option value="<?php echo $ssubSubCate->Id;?>"><?php echo "------ ".$ssubSubCate->Name;?></option>
									<?php }}}}}}} ?>
								</select>
								<i></i>
							</label>
						</section>
						<br/>
						<section>
							<h4>Thứ tự:</h4>
							<label class="input"> <i class="icon-append fa fa-user"></i>
								<input type="number" id = "categoryOrder" name="categoryOrder" placeholder="Thứ tự danh mục" min="1" value="<?php echo $defaultOrder;?>">
								<b class="tooltip tooltip-bottom-right">Nhập thứ tự danh mục</b> </label>
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
<script type="text/javascript">
	//
	function getValue() {
		return $('#parentId').val();
	}
	//
	function hintOrder(url, val) {
		url = url + '/' + val;
		$(document).load(url, function(data) {
			$('#categoryOrder').val(data);
		});
	}
	function CancelPopup() {
		$('#addedCategoryPopup').html("");
	}	
//
</script>