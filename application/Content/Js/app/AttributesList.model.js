var app = angular.module("AttributesListApp", []);
app.controller("AttributesListController", function($scope) {
    $scope.AttributesList= [];
    $scope.activeAttribute = {};
    $scope.baseUrl = $('#baseUrl').val();
    //
    $scope.synchValue = function (valId, callback) {
        $.ajax({
            url: $scope.baseUrl + 'index.php/AdminAttribute/SynchValue',
            type: 'POST',
            data: { valId: valId},
            success: function (data) {
                if (data != '') {
                    $scope.backupValue = data;
                    if(callback != null){
                        callback();
                    }
                    $scope.$apply();
                }
                else {
                    return null;
                }
            }
        });
    }
    //
    $scope.init = function() {
    	$.ajax({
    		url: $scope.baseUrl + 'index.php/AdminAttribute/GetData',
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
                $scope.activeAttribute.Order = cnt + 1;
    			$scope.$apply();
    		}
    	});
    };
    //
    $scope.validateAttribute = function (attr) {
        var tmpArray = [];
        tmpArray[0] = attr.Name;
        tmpArray[1] = attr.Code;
        for (var i = 0; i < tmpArray.length; i ++) {
            if (typeof(tmpArray[i]) == "undefined" || tmpArray[i] == "") {
                return false;
            }
        }
        return true;
    }
    //
    $scope.addOrEditAttribute = function (attrId) {
        if (attrId == null) {
            $scope.addAttribute();
        }
        else {
            var curAttr = $scope.activeAttribute;
            if ($scope.validateAttribute(curAttr) == false) {
                ShowAlert('Vui lòng nhập đầy đủ thông tin !!!', "warning");
                return null;
            }
            $.ajax({
                url: $scope.baseUrl + 'index.php/AdminAttribute/EditAttribute',
                data: { attrId: attrId, attrCode: curAttr.Code, attrName: curAttr.Name },
                type: 'POST',
                success: function(data) {
                    if (data != "") {
                        $list = $scope.AttributesList;
                        for (idx = 0; idx < $list.length; idx ++) {
                            if ($list[idx].Id == attrId) {
                                $scope.AttributesList[idx].Code = curAttr.Code;
                                $scope.AttributesList[idx].Name = curAttr.Name;
                            }
                        }
                        $scope.activeAttribute = {};
                        $scope.activeAttribute.Order = $scope.AttributesList.length + 1;
                        ShowAlert('Sửa thành công thuộc tính!!!', "success");
                        $scope.$apply();
                    }
                    else {
                        ShowAlert('Xảy ra lỗi trong quá trình sửa thuộc tính ! Vui lòng thao tác lại!', "danger");
                        $scope.$apply();
                    }
                   
                }
            });
        }
    }
    //
    $scope.addAttribute = function(){
        var order = $scope.activeAttribute.Order;
        var newAttr = $scope.activeAttribute;
        if ($scope.validateAttribute(newAttr) == false) {
            ShowAlert('Vui lòng nhập đầy đủ thông tin !!!', "warning");
            return null;
        }
        $.ajax({
            url: $scope.baseUrl + 'index.php/AdminAttribute/AddAttribute',
            data: { newAttrCode: $scope.activeAttribute.Code, newAttrName: $scope.activeAttribute.Name},
            type: 'POST',
            success: function(data){
                if (data != "0") {
                    $scope.AttributesList.unshift({Order: order, Id: data, Code: newAttr.Code, Name : newAttr.Name });
                    len = $scope.AttributesList.length;
                    $scope.AttributesList[0].AttributeValuesList = [];
                    $scope.activeAttribute = {};
                    $scope.activeAttribute.Order = len + 1;
                    ShowAlert("Thêm thành công thuộc tính mới !!!", "success");
                    $scope.$apply();     
                }
                else {
                    ShowAlert("Xảy ra lỗi trong quá trình thêm thuộc tính mới !!!", "danger");
                    $scope.$apply();
                }
               
            }
        });
    }
    //
    $scope.editAttribute = function (attrId) {
        var attrsList = $scope.AttributesList;
        var len = attrsList.length;
        for (var idx = 0; idx < len; idx ++) {
            if (attrsList[idx].Id == attrId) {
                $scope.activeAttribute.Id = attrsList[idx].Id;
                $scope.activeAttribute.Code = attrsList[idx].Code;
                $scope.activeAttribute.Name = attrsList[idx].Name;
            }
        }
    }
    //
    $scope.cancelAttributeProcess = function(attrId) {
        $scope.activeAttribute = {};
        $scope.activeAttribute.Order = $scope.AttributesList.length + 1;
    }
    //
    $scope.deleteAttribute = function (attrId) {
        var cfm = confirm("Bạn có chắc muốn xóa bỏ thuộc tính này ?");
        if (cfm == true) {
            $.ajax({
                url: $scope.baseUrl + 'index.php/AdminAttribute/DeleteAttribute',
                data: { deletedId: attrId },
                type: "POST",
                success: function (data) {
                    if (data != "0") {
                        var attrList = $scope.AttributesList;
                        var len = attrList.length;
                        var valuesListLen = 0;
                        for (var idx = 0; idx < len ; idx ++) {
                            if (attrList[idx].Id == attrId) {
                                var order = attrList[idx].Order;
                                if (order == len) {
                                    valuesListLen = attrList[len - 1].AttributeValuesList.length;
                                    $scope.AttributesList.splice(idx, 1);
                                    $scope.activeAttribute = {};
                                    $scope.activeAttribute.Order = len;
                                    $scope.$apply();
                                    break;
                                }
                                else {
                                    valuesListLen = attrList[idx].AttributeValuesList.length;
                                    $scope.AttributesList.splice(idx, 1);
                                    $scope.$apply();
                                    for (var jdx = 0; jdx < len -1; jdx ++) {
                                        if (attrList[jdx].Order > order) {
                                            attrList[jdx].Order--;
                                        }
                                    }
                                    $scope.activeAttribute = {};
                                    $scope.activeAttribute.Order = len;
                                    $scope.$apply();
                                    break;
                                }
                            }
                        }
                        ShowAlert("Đã xóa thành công thuộc tính !!!", "success");
                    }
                    else {
                        ShowAlert("Đã xảy ra lỗi trong quá trình xóa thuộc tính ! Vui lòng thao tác lại !", "danger");
                    }
                }
            });
        }
        else {
            return null;
        }
    }
    //
    $scope.validateValue = function (val) {
       if (typeof(val.Value) == "undefined" || val.Value == "") {
            return false;
       }
       else {
        return true;
       }
    }
    //
    $scope.addOrEditValue = function (attrId, valId) {
        var len = $scope.AttributesList.length;
        var idx = 0;
        for (var i = 0; i < len; i ++) {
            var attr = $scope.AttributesList[i];
            if (attr.Id == attrId) {
                idx = i;
                if (typeof(attr.activeValue.Id) == "undefined") {
                    $scope.addValue(attrId);
                    return 1;
                }
                else {
                    if (typeof(attr.activeValue.Value) == 'undefined' || attr.activeValue.Value == "") {
                        ShowAlert('Vui lòng nhập đầy đủ thông tin !!!', "warning");
                        return null;
                    }
                    $.ajax({
                        url: $scope.baseUrl + 'index.php/AdminAttribute/EditAttributeValue',
                        data: { attrValId: valId, attrNewVal: attr.activeValue.Value},
                        type: 'POST',
                        success: function(data){
                            if (data == '1') {
                                for (var jdx = 0; jdx < attr.AttributeValuesList.length; jdx ++) {
                                    if ($scope.AttributesList[idx].AttributeValuesList[jdx].Id == valId) {
                                        $scope.AttributesList[idx].AttributeValuesList[jdx].Value = attr.activeValue.Value;
                                        break;
                                    }
                                }
                                $scope.AttributesList[i].activeValue = {};
                                ShowAlert('Thay đổi giá trị thuộc tính thành công !!!', "success");
                                $scope.$apply();
                            } else {
                                ShowAlert('Xảy ra lỗi trong quá trình thay đổi giá trị thuộc tính !!!', "danger");
                                $scope.$apply();
                            }
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
        if ($scope.validateValue(valueData) == false) {
            ShowAlert('Vui lòng nhập đầy đủ thông tin !!!', "warning");
            return null;
        }
        $.ajax({
            url: $scope.baseUrl + 'index.php/AdminAttribute/AddAttributeValue',
            data: { attrId: attrId, attrValue: valueData.Value},
            type: 'POST',
            success: function(data){
                if (data != "0") {
                    attrData.AttributeValuesList.push({Order: order, Id: data, AttributeId: attrData.Id, Value : valueData.Value });
                    attrData.activeValue = {};
                    ShowAlert('Thêm thành công giá trị mới !!!', "success");
                    $scope.$apply();
                }
                else {
                    ShowAlert('Xảy ra lỗi trong quá trình thêm giá trị mới cho thuộc tính ! Vui lòng thao tác lại!', "danger");
                    $scope.$apply();
                }
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
                        attr.activeValue.Id = valueItem.Id;
                        attr.activeValue.AttributeId = valueItem.AttributeId;
                        attr.activeValue.Value = valueItem.Value;
                        break;
                    }
                }
                break;
            }
        }
    }
    //
    $scope.cancelValueProcess = function (attrId) {
        var cnt = $scope.AttributesList.length;
        var attrLst = $scope.AttributesList;
        for(var idx = 0; idx < cnt; idx ++){
                var item = attrLst[idx];
                if(item.Id == attrId){
                    if (typeof(item.activeValue) == "undefined") {
                        return null;
                    }
                    $scope.AttributesList[idx].activeValue.Value = $scope.backupValue;
                    $scope.AttributesList[idx].activeValue = {};
                    break;
                }
        }
    }
    //
    /*$scope.cancelAddingProcess = function(attrId, valId) {
        var callback = function(){
            var attrLst = $scope.AttributesList;
            var cnt = attrLst.length;
            for(var idx = 0; idx < cnt; idx ++){
                var item = attrLst[idx];
                if(item.Id == attrId){
                    $scope.AttributesList[idx].activeValue.Value = $scope.backupValue;
                    $scope.AttributesList[idx].activeValue = {};
                    break;
                }
            }
        }
        if (valId != null) {
            $scope.synchValue(valId,callback);
        }
        else {
            var attrLst = $scope.AttributesList;
            var cnt = attrLst.length;
            for(var idx = 0; idx < cnt; idx ++){
                var item = attrLst[idx];
                if(item.Id == attrId){
                    $scope.AttributesList[idx].activeValue.Value = $scope.backupValue;
                    $scope.AttributesList[idx].activeValue = {};
                    break;
                }
            }
        }
    }*/
    //
    $scope.deleteAttributeValue = function(attrId, valId) {
        var conf = confirm("Bạn có muốn xóa bỏ giá trị này của thuộc tính ?");
        if (conf == true) {
            $.ajax({
                url: $scope.baseUrl + 'index.php/AdminAttribute/DeleteAttributeValue',
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
                        ShowAlert("Xóa thành công giá trị của thuộc tính !!!", "success");
                    } else {
                        ShowAlert("xảy ra lỗi trong quá trình xóa giá trị ! Vui lòng thao tác lại !!!", "danger");
                    }
                }
            });
        } else {
            return null;
        }
    }
});