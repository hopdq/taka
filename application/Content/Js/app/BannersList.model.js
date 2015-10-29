var app = angular.module('AdminBannerApp', []);
app.controller("AdminBannerController", function($scope) {
	$scope.bannersList = [];
	$scope.baseUrl = $('#baseUrl').val();
	//
	$scope.init = function () {
		$.ajax({
			url: $scope.baseUrl + 'index.php/AdminBanner/GetBannersList',
			type: "GET",
			success: function (data) {
				if (data != "") {
					$scope.bannersList = JSON.parse(data);
					var len = $scope.bannersList.length;
					for (var i = 0; i < len; i ++) {
						$scope.bannersList[i].Order = i + 1;
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
	//
	$scope.deleteBanner = function (id) {
		var cfm = confirm("Bạn có muốn xóa banner này ???");
		if (cfm == true) {
			$.ajax({
				url: $scope.baseUrl + 'index.php/AdminBanner/DeleteBanner',
				data: {deletedId : id},
				type: "POST",
				success: function (data) {
					if (data == "1") {
                        var bansList = $scope.bannersList;
                        var len = bansList.length;
                        for (var idx = 0; idx < len; idx ++) {
                            if (id == bansList[idx].Id) {
                            	var order = bansList[idx].Order;
                            	if (bansList[idx].Order == len) {
                            		$scope.bannersList.splice(idx, 1);
	                                $scope.$apply();
	                                break;
                            	}
                            	else {
                            		$scope.bannersList.splice(idx, 1);
	                                $scope.$apply();
	                                for (var jdx = 0; jdx < len -1 ; jdx ++) {
	                                	if (bansList[jdx].Order > order) {
	                                  	  $scope.bannersList[jdx].Order --;
	                                	}
	                                }
	                                $scope.$apply();
	                                break;
                            	}
                            }
                        }
                        ShowAlert("Xóa thành công banner !!!", "success");
                    }
					else {
						ShowAlert("Xảy ra lỗi trong quá trình xóa banner!!!", "danger");
						return null;
					}
				}
			});
		}
		else {
			return null;
		}
	}
	//
});