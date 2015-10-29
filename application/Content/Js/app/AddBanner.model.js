var app = angular.module('AddBannerApp', []);
		app.controller("AddBannerController", function($scope) {
		$scope.infor = {};
		$scope.tempImgs = [];
		$scope.imgsList = [];
		$scope.imgsJsonData = "";
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
  		}
  		//
  		$scope.validateImgsList = function () {
  			$scope.infor.Code = $('#code').val();
  			if (typeof($scope.tempImgs[0]) == "undefined") {
  				return false;
  			}
  			else if(typeof($scope.infor.Title) == "undefined" || typeof($scope.infor.Code) == "undefined" ||typeof($scope.infor.Link) == "undefined"|| typeof($scope.infor.Link) == ""|| $scope.infor.Title == "" || $scope.infor.Code =="" || $scope.infor.Code == "0") {
  				return false;
  			} else {
  				return true;
  			}
  		}
  		//
  		$scope.completeAddingImgsProcess = function () {
  			if ($scope.validateImgsList() == false) {
  				ShowAlert("Vui lòng nhập đầy đủ thông tin !!!", "warning");
  				return null;
  			}
  			var len = $scope.tempImgs.length;
  			for (var i = 0; i < len; i ++) {
  				$scope.imgsList[i] = {};
  				$scope.imgsList[i].Title = $scope.infor.Title;
  				$scope.imgsList[i].Code = $scope.infor.Code;
  				$scope.imgsList[i].UrlPath = $scope.tempImgs[i].path;
  				$scope.imgsList[i].Link = $scope.infor.Link;
  			}
  			var imgsJsonData = 	JSON.stringify($scope.imgsList);
  			$.ajax({
  				url: $scope.baseUrl + 'index.php/AdminBanner/AddingBannerProcess',
  				data: { imgsData: imgsJsonData},
  				type: "POST",
  				success: function(data) {
  					if(data == "1") {
              window.location.href =  $scope.baseUrl + "index.php/AdminBanner";
            }
            else {
              ShowAlert("Xảy ra lỗi trong quá trình thêm banner!!!", "danger");
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
			if(length >= 1)
	  		{
	  			for(var i = 0; i < length; i++){
	  				var item = tempList[i];
	  				if(item.path == path ){
	  					tempList.splice(i, 1);
	  					$scope.imgsList.splice(i,1);
	  					break;
	  				}
	  			}
	  		}
	  		$scope.$apply();
	  	}
  	});