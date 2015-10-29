<?php 
	$this->load->helper('url');
?>
<?php
	$editingCategory = $data->content->editingCategory;
	$categoriesList = $data->content->categoriesList->listChilds;
	$edtParentId = $editingCategory->ParentId;
	$edtId = $editingCategory->Id;
	$edtOrder = $editingCategory->Order;
	//$categoriesList[$edtParentId][$edtOrder] = null;
	//$categoriesList[$edtId] = null;
	$parentOfEditingCategory = $data->content->parentOfEditingCategory;
	if ($parentOfEditingCategory->Id == "0") {
		$parentOfEditingCategory->Name = "--- Tất cả ---";
	}
	$defaultOrder = intval($editingCategory->Order);
	$cateLevel1Len = count($categoriesList);
?>
<style>
<!--
#editingCategoryPage {
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
#editingCategoryPopup {
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
<div id = "editingCategoryPage"></div>
<div id = "editingCategoryPopup">
	<div class="jarviswidget jarviswidget-sortable" role="widget">
		<header role="heading">Sửa danh mục</header>
		<div role="content">
		<div class="dt-wrapper" id="DtWrapper">
			<div class="widget-body no-padding">
			<form id="editingCategoryForm" action="<?php echo site_url(array('AdminCategory', 'EditingCategoryProcess'));?>" class="smart-form" novalidate="novalidate" method="POST" >
					<input type = "hidden" name = "categoryId" id = "editingCategoryId" value = "<?php echo $editingCategory->Id;?>" >
					<fieldset class = "editingField">
						<section>
							<label class="input"> <i class="icon-append fa fa-user"></i>
								<input type="text" id = "categoryname" name="categoryname" placeholder="Tên danh mục" value = "<?php echo $editingCategory->Name;?>">
								<b class="tooltip tooltip-bottom-right">Nhập tên danh mục</b>
								</label>
						</section>
						
						<section>
							<label>Chọn thư mục chứa:</label>
							<label class="select">
									<select id="parentId" name="parentId" onchange="hintOrder('<?php echo site_url(array('AdminCategory','GetHintOrder'));?>', getValue());">
										<option value="0">--- Tất cả ---</option>
										<?php
											for ($i = 0; $i < $cateLevel1Len; $i++){
												$cate = $categoriesList[$i+1];
												if ($cate->Id == $edtId ) {
													continue;
												}
										?>
										<option value="<?php echo $cate->Id;?>" <?php echo $parentOfEditingCategory->Id == $cate->Id ? "selected" : ""; ?> ><?php echo $cate->Name;?></option>
												<?php
													if ($cate->listChilds != null) {
														$cateLevel2Len = count($cate->listChilds);
														for ($j = 0; $j < $cateLevel2Len; $j++) {
															$subCate = $cate->listChilds[$j+1];
															if ($subCate->Id == $edtId ) {
																continue;
															}
															
												?>
														<option value="<?php echo $subCate->Id;?>"  <?php echo $parentOfEditingCategory->Id == $subCate->Id ? "selected" : ""; ?>><?php echo "-- ".$subCate->Name;?></option>
												<?php
													if ($subCate->listChilds != null) {
														$cateLevel3Len = count($subCate->listChilds);
														for ($m = 0; $m < $cateLevel3Len; $m++) {
															$subSubCate = $subCate->listChilds[$m+1];
															if ($subSubCate->Id == $edtId ) {
																continue;
															}
														?>
															<option value="<?php echo $subSubCate->Id;?>"  <?php echo $parentOfEditingCategory->Id == $subSubCate->Id ? "selected" : ""; ?>><?php echo "---- ".$subSubCate->Name;?></option>
														<?php
															if ($subSubCate->listChilds != null) {
																$cateLevel4Len = count($subSubCate->listChilds);
																for ($n = 0; $n < $cateLevel4Len; $n++) {
																	$ssubSubCate = $subSubCate->listChilds[$n+1];
																	if ($ssubSubCate->Id == $edtId ) {
																		continue;
																	}
																?>
																	<option value="<?php echo $ssubSubCate->Id;?>"  <?php echo $parentOfEditingCategory->Id == $ssubSubCate->Id ? "selected" : ""; ?>><?php echo "------ ".$ssubSubCate->Name;?></option>
										<?php }}}}}}} ?>
									</select>
									<i></i>
							</label>
						</section>
						<section>
							<label>Thứ tự:</label>
							<label class="input"> <i class="icon-append fa fa-sort-numeric-asc"></i>
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
		$('#editedCategoryPopup').html("");
	}	
//
</script>
	