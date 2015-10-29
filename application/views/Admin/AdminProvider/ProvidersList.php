<?php 
	$this->load->helper('url');
?>
<style type="text/css">
	#DtWrapper {
		padding: 0% 3% 0% 3%;
		border: 1px solid #A3C2C2;
	}
	*.dt-wrapper {
		border: 1px solid #D1D1E0;
	}
	#addingAttrfield {
		border: 1px solid #D1D1E0;
	}
</style>

<script src="<?php echo base_url('/application/Content/Js/angular.min.js')?>"></script>
<script src="<?php echo base_url('/application/Content/Js/app/ProvidersList.model.js')?>" ></script>
<div ng-app="AdminProviderApp">
	<div ng-controller = "AdminProviderController">
		<input type = "hidden" name = "baseUrl" id = "baseUrl" value = "<?php echo base_url();?>"/>
		<input type = "hidden" id = "clickBinding" ng-click = "init()" /> 
		<div class="dt-wrapper" id="DtWrapper">
		<br/>
		<div id = "attributesList">
			<div class="dt-wrapper">
				<table class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
					<thead  >
						<tr role="row">
							<th style= "width:3%;background-color: #B4CDCD;" style=" text-align: center">Stt</th>
							<th style= "width:12%;background-color: #B4CDCD;" style="text-align: center">Mã nhà cung cấp</th>
							<th style= "width:22%;background-color: #B4CDCD;" style="text-align: center">Tên nhà cung cấp</th>
							<th style= "width:25%;background-color: #B4CDCD;" style=" text-align: center">Logo nhà cung cấp</th>
							<th style= "width:30%;background-color: #B4CDCD;" style="text-align: center">Đặc tả</th>
							<th style= "width:4%;background-color: #B4CDCD;" style="text-align: center">Sửa</th>
							<th style= "width:4%;background-color: #B4CDCD;" style="text-align: center">Xóa</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all"  ng-repeat="pro in providersList">
						<tr>
							<td>{{pro.Order}}</td>
							<td>{{pro.Code}}</td>
							<td>{{pro.Name}}</td>
							<td style= "width:25%;"><img ng-src = "{{ baseUrl + pro.LogoUrl}}" height="50px" width="50px" /></td>
							<td>{{pro.Description}}</td>
							<td align = "center" ><a href="Javascript:void(0)"  class="btn btn-primary btn-sm" ng-click = "editProvider(pro.Id);"><i class="fa fa-x fa-pencil-square-o"></i></a></td>
							<td align = "center" ><a href="Javascript:void(0)" class="btn btn-primary btn-danger btn-sm" ng-click = "deleteProvider(pro.Id);"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</br>
		</br>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('document').ready( function () {
		$('#clickBinding').click();
	});
</script>