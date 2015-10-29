var app = angular.module('AddProviderApp', []);
		app.controller("AddProviderController", function($scope) {
		$scope.pro = {};
    $scope.tempImgs = [];
		$scope.newProJsonData = "";
    $scope.baseUrl = $("#baseUrl").val();
		$scope.init = function () {
			//$scope.$apply();
		}
		$scope.addTempImg = function(){
			//$scope.$apply();
			var obj = $('#addTempImg');
			var path = obj.attr('urlPath');
			var fullPath = obj.attr('fullPath');
  		$scope.tempImgs.push({ path: path, fullPath: fullPath });
      $scope.pro.LogoUrl = $scope.tempImgs[0].path;
      $scope.pro.fullPath = $scope.tempImgs[0].fullPath;
  			// $scope.$apply();
  		}
  		//
  		$scope.validateProvider = function () {
  			if(typeof($scope.tempImgs[0]) == "undefined"|| typeof($scope.tempImgs[0].fullPath) == "undefined"||typeof($scope.pro.Name) == "undefined" || typeof($scope.pro.Code) == "undefined" ||typeof($scope.pro.Description) == "undefined" || ($scope.pro.Name) == "" || ($scope.pro.Code) == "" ||($scope.pro.Description) == "" || $scope.tempImgs[0].fullPath == "") {
  				return false;
  			} else {
  				return true;
  			}
  		}
  		//
  		$scope.completeAddingProviderProcess = function () {
        if ($scope.validateProvider() == false) {
          ShowAlert("Vui lòng nhập đầy đủ thông tin !!!", "warning");
          return null;
        }
        $scope.pro.LogoUrl = $scope.tempImgs[0].path;
        $scope.pro.fullPath = $scope.tempImgs[0].fullPath;
  			var newProJsonData = 	JSON.stringify($scope.pro);
  			$.ajax({
  				url: $scope.baseUrl + 'index.php/AdminProvider/AddingProviderProcess',
  				data: { proData: newProJsonData},
  				type: "POST",
  				success: function(data) {
  					if(data == "1") {
              window.location.href =  $scope.baseUrl + "index.php/AdminProvider";
            }
            else {
              ShowAlert("Xảy ra lỗi trong quá trình thêm nhà cung cấp mới!!!", "danger");
            }
  				}
  			});
  		}
  		//
  		$scope.removeTempImg = function(){
  			var obj = $('#removeTempImg');
        var path = obj.attr('urlPath');
        var tempList = $scope.tempImgs;
        var length = $scope.tempImgs.length;
        if(length >= 1) {
          for(var i = 0; i < length; i++){
            var item = tempList[i];
            if(item.path == path ){
              if (i == 0 && $scope.tempImgs.length > 1) {
                $scope.pro.fullPath = $scope.tempImgs[1].fullPath;
                $scope.pro.path = $scope.tempImgs[1].path;
              }
              else if(length == 1) {
                $scope.pro.fullPath = "";
                $scope.pro.path = "";
                $('#logoImg').removeAttr('src', "");
              }
              tempList.splice(i, 1);
              break;
            }
          }
        }
	  	}
  	});