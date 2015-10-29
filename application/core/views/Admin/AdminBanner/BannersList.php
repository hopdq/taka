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
<script src="<?php echo base_url('/application/Content/Js/angular.min.js')?>" ></script>
<script src="<?php echo base_url('/application/Content/Js/app/BannersList.model.js')?>"></script>
<div ng-app="AdminBannerApp">
	<div ng-controller = "AdminBannerController">
		<input type = "hidden" name = "baseUrl" id = "baseUrl" value = "<?php echo base_url();?>"/>
		<input type = "hidden" id = "clickBinding" ng-click = "init()" /> 
		<div class="dt-wrapper" id="DtWrapper">
		<br/>
		<div id = "bannersList">
			<div class="dt-wrapper">
				<table class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
					<thead  >
						<tr role="row">
							<th style= "width:5%;background-color: #B4CDCD;" style=" text-align: center">Stt</th>
							<th style= "width:25%;background-color: #B4CDCD;" style="text-align: center">Ảnh</th>
							<th style= "width:40%;background-color: #B4CDCD;" style=" text-align: center">Tiêu đề ảnh</th>
							<th style= "width:25;background-color: #B4CDCD;" style="text-align: center">Mã ảnh</th>
							<th style= "width:5%;background-color: #B4CDCD;" style="text-align: center">Xóa</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<tr ng-repeat="ban in bannersList">
							<td>{{ban.Order}}</td>
							<td><a ng-href="{{ban.Link}}" target="_blank" ><img ng-src="{{baseUrl + ban.UrlPath}}" alt = "banner" height="50px" width="50px" /></a></td>
							<td>{{ban.Title}}</td>
							<td>{{ban.Code}}</td>
							<td align = "center" ><a href="Javascript:void(0)" class="btn btn-primary btn-danger btn-sm" ng-click = "deleteBanner(ban.Id);"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
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