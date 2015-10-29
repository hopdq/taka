<?php 
	$this->load->helper('date');
	$this->load->helper('url');
?>
<?php require_once 'application/helpers/ProductStatusHelper.php'; ?>
<div class="jarviswidget jarviswidget-sortable" id="productListZone" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
	<header role="heading">
		<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
		<h2>Danh sách sản phẩm</h2>				
		<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
	</header>
	<!-- widget div-->
	<div role="content">
		<!-- widget edit box -->
		<div class="jarviswidget-editbox">
		<!-- This area used as dropdown edit box -->
		</div>
		<!-- end widget edit box -->

		<!-- widget content -->
		<div class="widget-body no-padding">
			<div id="dt_basic_wrapper" class="dataTables_wrapper form-inline smart-form" role="grid">
				<div class="row table-filter-row">
					<div class="row">
						<div class="col col-2" id="dt_basic_filter">
							<input id="keyword" class="form-control" placeholder="Từ khóa" type="text" aria-controls="dt_basic"/>
						</div>
						<?php if(count($data->filter->categoryFilter->listCategories) > 0) {?>
							<div class="col col-1">
								<label class="label">Danh mục: </label>
							</div>
							<div class="col col-3">
								<span class="smart-form">
									<label class="select" style="width:200px">
										<select size="1" name="dt_basic_length" aria-controls="dt_basic" id="CategoryFilter">
											<?php foreach($data->filter->categoryFilter->listCategories as $cate) {?>
												<option value="<?php echo $cate->Id; ?>"><?php echo $cate->textName; ?></option>
											<?php }?>
										</select>
										<i></i>
									</label>
								</span>
							</div>
						<?php }?>
						<?php if(count($data->filter->statusFilter->listStatuses) > 0) {?>
							<div class="col col-1">
								<label class="label">Trạng thái: </label>
							</div>
							<div class="col col-2">
								<span class="smart-form">
									<label class="select" style="width:200px">
										<select size="1" name="dt_basic_length" aria-controls="dt_basic" id="StatusFilter">
											<?php foreach($data->filter->statusFilter->listStatuses as $stt) {?>
												<option value="<?php echo $stt->Id; ?>"><?php echo $stt->Name; ?></option>
											<?php }?>
										</select>
										<i></i>
									</label>
								</span>
							</div>
						<?php }?>
					</div>
					<div class="action-bar row" style="margin-top: 10px;">
						<div class="col col-1">
							<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="FilterProcess();">
								<i class="fa fa-search" style="margin-right: 5px;"></i>Tìm kiếm
							</a>
						</div>
						<div class="col col-1">
							<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="AddProcess();">
								<i class="fa fa-plus" style="margin-right: 5px;"></i>Thêm mới
							</a>
						</div>
						<div class="col col-1">
							<a href="javascript:void(0);" class="btn btn-primary btn-sm btn-danger" onclick="DeleteProcess();">
								<i class="fa fa-trash-o" style="margin-right: 5px;"></i>Xóa
							</a>
						</div>
					</div>
				</div>
				<input type="hidden" name="AddUrl" id="AddUrl" value="<?php echo site_url(array("AdminProduct", "AddProduct"));?>" />
				<input type="hidden" name="DeleteUrl" id="DeleteUrl" value="<?php echo site_url(array("AdminProduct", "DeleteProduct"));?>" />
			<?php   $lstData['data'] = $data->listData; 
					$this->load->view('Admin/AdminProduct/ProductList', $lstData)
			?>
		</div>
		</div>
		</div>
		<!-- end widget content -->

	</div>
	<!-- end widget div -->
</div>

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
	function AddProcess(){
		window.location.href = $('#addProductUrl').val();
	}
	function DeleteProcess(){
		var idList = "";
		var cnt = 0;
		$('.chk-del-item:Checked').each(function(){
			var chkVal = $(this).val();
			if(cnt == 0)
			{
				idList += chkVal;
			}
			else
			{
				idList += "," + chkVal;
			}
			cnt++;
		});
		if(idList == null || idList == '')
		{
			return;
		}
		if(confirm("Bạn chắc chắn muốn xóa?"))
		{
			$.ajax({
				url: $('#deleteUrl').val(),
				type: 'POST',
				data: {id: idList},
				beforSend: function(){
					
				},
				success: function(data){
					if(data > 0){
						LoadPageData(1);
					}
				},
				error: function(){

				},
				complete: function(){

				}
			});
		}
	}
	function DeleteSelectAll(obj){
		$('.chk-del-item').click();
	}
</script>