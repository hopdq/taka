<?php 
	$this->load->helper('url');
?>

<?php
	$categoriesList = $data->categoriesList->listChilds;
	$cateLevel1Len = count($categoriesList);
?>
<div class="dt-wrapper" id="DtWrapper">
		<table style = "width :100%;" id="categoriesListTable" class="table table-striped table-bordered table-hover dataTable" aria-describedby="categoriesListTable_info">
			<thead>
				<tr role="row">
				<th style = "width :8%; text-align: center" class="sorting_asc" role="columnheader" tabindex="0" aria-controls="categoriesListTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 5%; text-align: center">Stt</th>
				<th style = " text-align: center" class="sorting" role="columnheader" tabindex="0" aria-controls="categoriesListTable" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 20%; text-align: center">Các loại sản phẩm</th>
				<th style = "width :5%; text-align: center" class="sorting" role="columnheader" tabindex="0" aria-controls="categoriesListTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 20%; text-align: center">Thứ tự</th>
				<th style="width: 5%; text-align: center">Sửa</th>
				<th style="width: 5%; text-align: center">Xóa</th>
				</tr>
			</thead>
			<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php
						for ($i = 0; $i < $cateLevel1Len; $i++){
							$cate = $categoriesList[$i+1];
					?>
					<tr class="cateLevel1" stt = "<?php echo $cate->Order;?>" item-level = "1" style="font-weight: bold;font-style: italic;" id="<?php echo $cate->ParentId."-".$cate->Order ?>" class="<?php echo $i % 2 == 0 ? 'odd' : 'event';?>">
						<td id = "<?php echo "stt-".$cate->ParentId."-"."$cate->Order";?>" class=" sorting_1" align="center"><?php echo $cate->Order;?></td>
						<td id="<?php echo "name-".$cate->Id ?>" class=""><?php echo ' '.$cate->Name;?></td>
						<td class=" "><?php echo $cate->Order;?></td>
						<td align = "center" ><a href="Javascript:void(0)" onclick = "EditCategory('<?php echo site_url(array('AdminCategory', 'EditCategory', $cate->Id));?>');" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></a></td>
						<td align = "center" ><a href="Javascript:void(0)"	onclick = "DeleteCategory('<?php echo site_url(array('AdminCategory', 'DeleteCategory', $cate->Id));?>', '<?php echo $cate->Id;?>');" class="btn btn-primary btn-sm btn-danger"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
					</tr>
					<?php
						if ($cate->listChilds != null) {
							$cateLevel2Len = count($cate->listChilds);
							for ($j = 0; $j < $cateLevel2Len; $j++) {
								$subCate = $cate->listChilds[$j+1];
							?>
								<tr class = "cateLevel2" stt = "<?php echo $cate->Order."-".$subCate->Order;?>" item-level = "2" id = "<?php echo $subCate->ParentId."-".$subCate->Order;?>" class="<?php echo $i % 2 == 0 ? 'odd' : 'event';?>">
									<td id = "<?php echo "stt-".$subCate->ParentId."-"."$subCate->Order";?>" class=" sorting_1" align="center"><?php echo $cate->Order.'-'.$subCate->Order;?></td>
									<td id="<?php echo "name-".$subCate->Id ?>" class=""><?php echo '-- '.$subCate->Name;?></td>
									<td class=" "><?php echo $subCate->Order;?></td>
									<td align = "center" ><div href="Javascript:void(0)" onclick = "EditCategory('<?php echo site_url(array('AdminCategory', 'EditCategory', $subCate->Id));?>');" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
									<td align = "center" ><a href="Javascript:void(0)"	onclick = "DeleteCategory('<?php echo site_url(array('AdminCategory', 'DeleteCategory', $subCate->Id));?>', '<?php echo $cate->Id;?>');" class="btn btn-primary btn-sm btn-danger"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>

								</tr>
								<?php
									if ($subCate->listChilds != null) {
										$cateLevel3Len = count($subCate->listChilds);
										for ($m = 0; $m < $cateLevel3Len; $m++) {
											$subSubCate = $subCate->listChilds[$m+1];
										?>
											<tr class = "cateLevel3" stt = "<?php echo $cate->Order."-".$subCate->Order."-".$subSubCate->Order;?>" item-level="3" id = "<?php echo $subSubCate->ParentId."-".$subSubCate->Order;?>" class="<?php echo $i % 2 == 0 ? 'odd' : 'event';?>">
												<td id = "<?php echo "stt-".$subSubCate->ParentId."-"."$subSubCate->Order";?>" class=" sorting_1" align="center"><?php echo $cate->Order.'-'.$subCate->Order.'-'.$subSubCate->Order;?></td>
												<td id="<?php echo "name-".$subSubCate->Id ?>" class=""><?php echo '---- '.$subSubCate->Name;?></td>
												<td class=" "><?php echo $subSubCate->Order;?></td>
												<td align = "center" ><div href="Javascript:void(0)" onclick = "EditCategory('<?php echo site_url(array('AdminCategory', 'EditCategory', $subSubCate->Id));?>');" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
												<td align = "center" ><a href="Javascript:void(0)"	onclick = "DeleteCategory('<?php echo site_url(array('AdminCategory', 'DeleteCategory', $subSubCate->Id));?>', '<?php echo $cate->Id;?>');" class="btn btn-primary btn-sm btn-danger"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>

											</tr>
											<?php
												if ($subSubCate->listChilds != null) {
													$cateLevel4Len = count($subSubCate->listChilds);
													for ($n = 0; $n < $cateLevel4Len; $n++) {
														$ssubSubCate = $subSubCate->listChilds[$n+1];
													?>
													<tr class = "cateLevel4" stt = "<?php echo $cate->Order."-".$subCate->Order."-".$subSubCate->Order.'-'.$ssubSubCate->Order;?>" item-level="4" id = "<?php echo $ssubSubCate->ParentId."-".$ssubSubCate->Order;?>" class="<?php echo $i % 2 == 0 ? 'odd' : 'event';?>">
															<td id = "<?php echo "stt-".$ssubSubCate->ParentId."-"."$ssubSubCate->Order";?>" class=" sorting_1" align="center"><?php echo $cate->Order.'-'.$subCate->Order.'-'.$subSubCate->Order.'-'.$ssubSubCate->Order; ?></td>
															<td id="<?php echo "name-".$ssubSubCate->Id ?>" class=""><?php echo '------ '.$ssubSubCate->Name;?></td>
															<td class=" "><?php echo $ssubSubCate->Order;?></td>
															<td align = "center" ><div href="Javascript:void(0)" onclick = "EditCategory('<?php echo site_url(array('AdminCategory', 'EditCategory', $ssubSubCate->Id));?>');" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
															<td align = "center" ><a href="Javascript:void(0)"	onclick = "DeleteCategory('<?php echo site_url(array('AdminCategory', 'DeleteCategory', $ssubSubCate->Id));?>', '<?php echo $cate->Id;?>');" class="btn btn-primary btn-sm btn-danger"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>

													</tr>				
				<?php
				}}}}}}}?>
				
			</tbody>
		</table>
		<div id="changedPasswordUserPopup"></div>
		<div id="addedCategoryPopup"></div>
		<div id="editedCategoryPopup"></div>
		<input type="hidden" id="UrlLoadData" value= "<?php echo site_url(array('AdminUser', 'LoadData')); ?>"/>
</div>