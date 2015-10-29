var app = angular.module('AdminProviderApp', []);
app.controller("AdminProviderController", function($scope) {
	$scope.providersList = [];
	$scope.baseUrl = $('#baseUrl').val();
	//
	$scope.init = function () {
		$.ajax({
			url: $scope.baseUrl + 'index.php/AdminProvider/GetData',
			type: "GET",
			success: function (data) {
				if (data != "") {
					$scope.providersList = JSON.parse(data);
					var len = $scope.providersList.length;
					for (var i = 0; i < len; i ++) {
						$scope.providersList[i].Order = i + 1;
                        if ($scope.providersList[i].Description.length > 100) {
                            $scope.providersList[i].Description = $scope.providersList[i].Description.substring(0,100) + "...more...";
                        }
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
    $scope.editProvider = function (proId) {
        window.location.href = $scope.baseUrl + 'index.php/AdminProvider/EditProvider/' + proId;
    }
    //
    $scope.deleteProvider = function (proId) {
        var cfm = confirm("Bạn có chắc muốn xóa bỏ  thông tin nhà cung cấp này ?");
        if (cfm == true) {
            $.ajax({
                url: $scope.baseUrl + 'index.php/AdminProvider/DeleteProvider',
                data: { proId: proId },
                type: "POST",
                success: function (data) {
                    if (data == "1") {
                        var prosList = $scope.providersList;
                        var len = prosList.length;
                        for (var idx = 0; idx < len; idx ++) {
                            if (proId == prosList[idx].Id) {
                            	var order = prosList[idx].Order;
                            	if (prosList[idx].Order == len) {
                            		$scope.providersList.splice(idx, 1);
	                                $scope.$apply();
	                                break;
                            	}
                            	else {
                            		$scope.providersList.splice(idx, 1);
	                                $scope.$apply();
	                                for (var jdx = 0; jdx < len -1 ; jdx ++) {
	                                	if (prosList[jdx].Order > order) {
	                                  	  $scope.providersList[jdx].Order --;
	                                	}
	                                }
	                                $scope.$apply();
	                                break;
                            	}
                            }
                        }
                        ShowAlert("Đã xóa thành công  thông tin nhà cung cấp !!!", "success");
                    }
                    else {
                        ShowAlert("Đã xảy ra lỗi trong quá trình xóa  thông tin nhà cung cấp ! Vui lòng thao tác lại !", "success");
                    }
                }
            });
        }
        else {
            return null;
        }
    }
});