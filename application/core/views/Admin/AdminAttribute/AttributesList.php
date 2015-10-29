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
		background-color: #c2e0ff;
	}
</style>
<script src="<?php echo base_url('/application/Content/Js/angular.min.js')?>"></script>
<script src="<?php echo base_url('/application/Content/Js/app/AttributesList.model.js')?>"></script>
<div ng-app="AttributesListApp">
<input type = "hidden" name = "baseUrl" id = "baseUrl" value = "<?php echo base_url();?>"/>
<div ng-controller = "AttributesListController">
<div class="dt-wrapper" id="DtWrapper">
		<br/>
		<table class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
			<tr >
				<th  style = "background-color: #85C2FF;font-color: white;" align="center" ><h1><strong>Thêm thuộc tính sản phẩm</strong></h1></th>
			</tr>
		</table>
		<table id = "addingAttrfield" class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
			<tr>
				<td style="background-color:#d4e9ff;width: 39%;">
					<input type = "text" name = "newAttrCode" id = "newAttrCode" style = "width: 60%; height:80%;" type="text" ng-model="activeAttribute.Code" placeholder = "Nhập mã thuộc tính"/>
				</td>
				<td  style="background-color:#d4e9ff;">
					<input type = "text" name = "newAttrName" id = "newAttrName" style = " width: 60%; height:80%;" type="text" ng-model="activeAttribute.Name" placeholder = "Nhập tên thuộc tính"/>
				</td  style="background-color:#d4e9ff;">
				<td  style="background-color:#d4e9ff;" align = "center" style = "width:15%;"><div href="Javascript:void(0)" class="btn btn-labeled btn-success" type = "submit" ng-click="addOrEditAttribute(activeAttribute.Id);"><i class="glyphicon fa-2x glyphicon-ok"></i></div>
				</td>
				<td style="background-color:#d4e9ff;" align = "center" style = "width:15%;"><div href="Javascript:void(0)" class="btn btn-labeled btn-danger" ng-click="cancelAttributeProcess();" ><i class="glyphicon fa-2x glyphicon-remove"></i></div>
				</td>
			</tr>
		</table>
		<br/>
		<br/>
		<div id = "attributesList" ng-repeat="attr in AttributesList">
			<div class="dt-wrapper">
				<table class="table table-striped table-bordered table-hover dataTable" aria-describedby="dt_basic_info">
					<thead  >
						<tr role="row">
							<th style= "background-color: #B4CDCD;" style="width: 5%; text-align: center">Stt</th>
							<th style= "background-color: #B4CDCD;" style="width: 20%; text-align: center">Mã thuộc tính</th>
							<th style= "background-color: #B4CDCD;" style="width: 20%; text-align: center">Tên thuộc tính</th>
							<th style= "background-color: #B4CDCD;" style="width: 4%; text-align: center">Sửa</th>
							<th style= "background-color: #B4CDCD;" style="width: 4%; text-align: center">Xóa</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<tr>
							<td>{{attr.Order}}</td>
							<td>{{attr.Code}}</td>
							<td>{{attr.Name}}</td>
							<td align = "center" ><div href="Javascript:void(0)"  class="btn btn-primary btn-sm" ng-click = "editAttribute(attr.Id);"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
							<td align = "center" ><a href="Javascript:void(0)" class="btn btn-primary btn-danger btn-sm" ng-click = "deleteAttribute(attr.Id);"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
						</tr>
						<tr class="attr-value-header">
							<td style="background-color: #dae6e6;" colspan="5"><i>Giá trị thuộc tính</i></td>
						</tr>
						<tr ng-repeat = "val in attr.AttributeValuesList" ng-model = "val">
							<td class=" sorting_1" >{{val.Order}}</td>
							<td colspan="2">{{val.Value}}</td>
							<td align = "center" ><div href="Javascript:void(0)"  class="btn btn-primary btn-sm" ng-click = "editAttributeValue(attr.Id, val.Id);"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
							<td align = "center" ><a href="Javascript:void(0)" class="btn btn-primary btn-danger btn-sm" ng-click = "deleteAttributeValue(attr.Id, val.Id);"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
						</tr>
						<tr>
							<td></td>
							<input type = "hidden" name = "newAttrId" id = "attrId" value = "{{ attr.Id }}">
							<td colspan="2">
								<input type = "text" name = "newAttrValue" id = "attrValue" style = "width: 50%; height:80%;" type="text" ng-model="attr.activeValue.Value" placeholder = "Nhập giá trị thuộc tính"/>
							</td>
							<td align = "center" ><div href="Javascript:void(0)" class="btn btn-labeled btn-success" type = "submit" ng-click="addOrEditValue(attr.Id, attr.activeValue.Id);"><i class="glyphicon fa-2x glyphicon-ok"></i></div>
							</td>
							<td align = "center" ><div href="Javascript:void(0)" class="btn btn-labeled btn-danger" ng-click="cancelValueProcess(attr.Id);" ><i class="glyphicon fa-2x glyphicon-remove"></i></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</br>
			</br>
		</div>
</div>
<input type="hidden" id="clickBinding" ng-click="init()" />
</div>
</div>
<script type="text/javascript">
	$('document').ready(function(){
		$('#clickBinding').click();
	})
</script>