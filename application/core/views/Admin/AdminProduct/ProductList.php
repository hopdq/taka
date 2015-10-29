<?php 
	$this->load->helper('url');
?>
<div class="dt-wrapper" id="DtWrapper">
	<table id="dt_basic" class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
		<thead>
			<tr role="row">
			<th style="width: 5%;">
				<label>
					<input type="checkbox" class="checkbox style-0" name="checkbox" onchange="DeleteSelectAll(this);" />
					<span></span>
				</label>
			</th>
			<th style="width: 5%;">Stt</th>
			<th style="width: 10%">Mã hàng</th>
			<th style="width: 30%;">Tên hàng</th>
			<th style="width: 20%;">Danh mục</th>
			<th style="width: 10%;">Giá</th>
			<th style="width: 10%;">GT Km</th>
			<th style="width: 5%;">% km</th>
			<th style="width: 10%;">Trạng thái</th>
			<th style="width: 10%;">Người cập nhật</th>
			<th style="width: 10%;">Ngày cập nhật</th>
			<th style="width: 5%;">Sửa</th>
			</tr>
		</thead>
		<tbody role="alert" aria-live="polite" aria-relevant="all">
			<?php foreach($data->ListItem as $product){?>
				<tr class="<?php echo $product->RowNumber % 2 == 0 ? 'odd' : 'event';?>">
					<td class=" ">
						<label>
							<input type="checkbox" name="checkbox" class="chk-del-item checkbox style-0" value="<?php echo $product->Id; ?>" />
							<span></span>
						</label>
					</td>
					<td class=" sorting_1"><?php echo $product->RowNumber;?></td>
					<td class=" "><?php echo $product->Code;?></td>
					<td class=" "><?php echo $product->Name;?></td>
					<td class=" "><?php echo $product->CategoryName?></td>
					<td class=" "><?php echo $product->Price; ?></td>
					<td class=" "><?php echo $product->PromotionValue; ?></td>
					<td class=" ">
						<label>
								<input type="checkbox" class="checkbox style-0" name="checkbox" <?php echo $product->IsPercentPromotion ? "checked='checked'" : ""; ?>>
								<span></span>
						</label>
					</td>
					<td class=" "><?php echo ProductStatusHelper::GetNameById($product->Status); ?></td>
					<td class=" "><?php echo $product->UserUpdate; ?></td>
					<td class=" "><?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $product->UpdateDate); echo $date->format('d/m/Y')?></td>
					<td><a href="<?php echo site_url(array('AdminProduct','EditProduct', $product->Id)); ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				</tr>
			<?php }?>
		</tbody>
	</table>
	<?php if($data->PageModel->TotalPages > 0) {
			$first = $data->PageModel->TotalPages > 1 && $data->PageModel->Page > 1;
			$last = $data->PageModel->TotalPages > 1 && $data->PageModel->Page < $data->PageModel->TotalPages;
		?>
		<div class="dt-row dt-bottom-row">
			<div class="col-sm-6"><div class="dataTables_info" id="datatable_fixed_column_info"></div></div>
			<div class="col-sm-6 text-right">
				<div class="dataTables_paginate paging_bootstrap_full">
					<ul class="pagination">
						<li class="first <?php echo $first ? "" : "disabled"; ?>" <?php echo $first ? "onclick='LoadPageData(1)'" : "";?>><a href="#">Trang đầu</a></li>
						<li class="prev <?php echo $first ? "" : "disabled"; ?>" <?php echo $first ? "onclick='LoadPageData(".($data->PageModel->Page - 1).")'" : "";?>><a href="#">Trang trước</a></li>
					<?php for($i = 1; $i <= $data->PageModel->TotalPages; $i++) {?>
						<li class="<?php echo $i == $data->PageModel->Page ? "active" : ""; ?>">
							<a href="#" <?php echo $i != $data->PageModel->Page ? "onclick='LoadPageData(".$i.")'" : "";?>><?php echo $i; ?></a>
						</li>
					<?php }?>
						<li class="next <?php echo $last ? "" : "disabled"; ?>"><a href="#" <?php echo $last ? "onclick='LoadPageData(".($data->PageModel->Page + 1).")'" : "";?>>Trang tiếp</a></li>
						<li class="last <?php echo $last ? "" : "disabled"; ?>"><a href="#" <?php echo $last ? "onclick='LoadPageData(".$data->PageModel->TotalPages.")'" : "";?>>Trang cuối</a></li>
					</ul>
				</div>
			</div>
		</div>
	<?php }?>
	<input type="hidden" id="UrlLoadData" value= "<?php echo site_url(array('AdminProduct', 'LoadData')); ?>"/>
	<input type="hidden" id="addProductUrl" value= "<?php echo site_url(array('AdminProduct', 'AddProduct')); ?>"/>
	<input type="hidden" id="deleteUrl" value= "<?php echo site_url(array('AdminProduct', 'DeleteProduct')); ?>"/>
</div>
