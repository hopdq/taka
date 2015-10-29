var app = angular.module("AttributesListApp", []);
app.controller("AttributesListController", function($scope) {
    $scope.AttributesList= [];
    $scope.activeAttribute = {};
    $scope.init = function(){
    	$.ajax({
    		url: 'http://localhost/ecom/index.php/AdminAttribute/GetData',
    		type: 'GET',
    		success: function(data){
    			$scope.AttributesList = JSON.parse(data);
                var attrLst = $scope.AttributesList;
                var cnt = attrLst.length;
                for(var idx = 0; idx < cnt; idx ++){
                    $scope.AttributesList[idx].Order = idx+1;
                    for(var jdx = 0; jdx < $scope.AttributesList[idx].AttributeValuesList.length; jdx ++) {
                        $scope.AttributesList[idx].AttributeValuesList[jdx].Order = jdx + 1;
                    }
                    var item = attrLst[idx];
                    item.activeValue = {};
                }
    			$scope.$apply();
    		}
    	});
    };
    $scope.addAttribute = function(){
        var callback = function(data){
            if(data > 0)
            {
                var activeAttribute = $scope.activeAttribute;
                activeAttribute.Id = data;
                $scope.AttributesList.push({ Id: activeAttribute.Id, Code: activeAttribute.Code, Name : activeAttribute.Name });
                $scope.activeAttribute = {};
                $scope.$apply();
            }
        }
    }
    //
    $scope.addOrEditValue = function (attrId) {
        var len = $scope.AttributesList.length;
        for (var i = 0; i < len; i ++) {
            var attr = $scope.AttributesList[i];
            if (attr.Id == attrId) {
                if (attr.activeValue.Id == null) {
                    $scope.addValue(attrId);
                    return 1;
                } else {
                    attr = attr.activeValue;
                    $.ajax({
                        url: 'http://localhost/ecom/index.php/AdminAttribute/EditAttributeValue',
                        data: { valId: attr.Value, attrValue: valueData.Value},
                        type: 'POST',
                        success: function(data){
                            attrData.AttributeValuesList.push({Order: order, Id: data, AttributeId: attrData.Id, Value : valueData.Value });
                            attrData.activeValue = {};
                            $scope.$apply();
                        }
                    });
                    return 2;
                }
            }
        }
    }
    //
    $scope.addValue = function(attrId){
        var attrData = {};
        var attrLst = $scope.AttributesList;
        var order = 0;
        var cnt = attrLst.length;
        for(var idx = 0; idx < cnt; idx ++){
            var item = attrLst[idx];
            if(item.Id == attrId){
                attrData = item;
                order = attrData.AttributeValuesList.length + 1;
                break;
            }
        }
        //
        var valueData = attrData.activeValue;
        $.ajax({
            url: 'http://localhost/ecom/index.php/AdminAttribute/AddAttributeValue',
            data: { attrId: attrId, attrValue: valueData.Value},
            type: 'POST',
            success: function(data){
                attrData.AttributeValuesList.push({Order: order, Id: data, AttributeId: attrData.Id, Value : valueData.Value });
                attrData.activeValue = {};
                $scope.$apply();
            }
        });
    }
    //
    $scope.editAttributeValue = function(attrId, valId) {
        var len = $scope.AttributesList.length;
        for (var i = 0; i < len; i ++) {
            var attr = $scope.AttributesList[i];
            if (attr.Id == attrId) {
                var valueList = attr.AttributeValuesList;
                var valsLen = valueList.length;
                for (var j = 0; j < valsLen; j ++) {
                    var valueItem = valueList[j];
                    if (valueItem.Id == valId) {
                        attr.activeValue = valueItem;
                        break;
                    }
                }
                break;
            }
        }
        valueItem = attr.activeValue;
    }
    //
    $scope.cancelAddingProcess = function(attrId) {
    var attrLst = $scope.AttributesList;
    var cnt = attrLst.length;
        for(var idx = 0; idx < cnt; idx ++){
            var item = attrLst[idx];
            if(item.Id == attrId){
                $scope.AttributesList[idx].activeValue = {};
                break;
            }
        }
    }
    //
  
    $scope.deleteAttributeValue = function(attrId, valId) {
        var conf = confirm("Ban co muon xoa gia tri nay cua thuoc tinh ?");
        if (conf == true) {
            $.ajax({
                url: 'http://localhost/ecom/index.php/AdminAttribute/DeleteAttributeValue',
                data: {attrValueId: valId},
                type: 'POST',
                success: function (data) {
                    if (data == 1) {
                        var len = $scope.AttributesList.length;
                            for (var i = 0; i < len; i ++) {
                                var attr = $scope.AttributesList[i];
                                if (attr.Id == attrId) {
                                    var valueList = attr.AttributeValuesList;
                                    var valsLen = valueList.length;
                                    for (var j = 0; j < valsLen; j ++) {
                                        var valueItem = valueList[j];
                                        if (valueItem.Id == valId) {
                                            if (j == valsLen - 1) {
                                                valueList.splice(j, 1);
                                                $scope.$apply();
                                                break;
                                            } else {
                                                valueList.splice(j, 1);
                                                for (var k = j; k < valsLen; k ++ ) {
                                                    valueList[k].Order = k+1;
                                                    $scope.$apply();
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    break;
                                }
                            }
                        alert("Xoa thanh cong gia tri moi cua thuoc tinh !!!");
                    } else {
                        alert("Xay ra loi trong qua trinh xoa gia tri cua thuoc tinh!!!");
                    }
                }
            });
        } else {
            return null;
        }
    }
});