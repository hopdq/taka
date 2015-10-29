var app = angular.module('EditProviderApp', []);
    app.controller("EditProviderController", function($scope) {
    $scope.pro = {};
    $scope.tempImg = {};
    $scope.tempImgs = [];
    $scope.officalPro = {};
    $scope.newProJsonData = "";
    $scope.proId = $('#proId').val();
    $scope.baseUrl = $("#baseUrl").val();
    $scope.backupPro = {};
    $scope.init = function () {
      $.ajax({
        url: $scope.baseUrl + 'index.php/AdminProvider/GetProviderData/' + $scope.proId,
        type: "GET",
        success: function(data) {
          $scope.pro = JSON.parse(data);
          $scope.backupPro.Id = $scope.pro.Id;
          $scope.backupPro.Name = $scope.pro.Name;
          $scope.backupPro.LogoUrl = $scope.pro.LogoUrl;
          $scope.$apply();
        }
      });
    }
    $scope.addTempImg = function(){
      //$scope.$apply();
      var obj = $('#addTempImg');
      var path = obj.attr('urlPath');
      var fullPath = obj.attr('fullPath');
      $scope.tempImgs.push({ path: path, fullPath: fullPath });
      $scope.pro.LogoUrl = $scope.tempImgs[0].path;
        // $scope.$apply();
    }
      //
      $scope.validateProvider = function () {
        if (typeof($scope.pro.LogoUrl) == "undefined") {
          return false;
        }
        else if(typeof($scope.pro.Name) == "undefined" || typeof($scope.pro.Code) == "undefined" ||typeof($scope.pro.Description) == "undefined" || ($scope.pro.Name) == "" || ($scope.pro.Code) == "" ||($scope.pro.Description) == "") {
          return false;
        } else {
          return true;
        }
      }
      //
      $scope.completeEditingProviderProcess = function () {
        if ($scope.validateProvider() == false) {
          ShowAlert("Vui lòng nhập đầy đủ thông tin !!!", "warning");
          return null;
        }
        $scope.officalPro.Id = $scope.proId;
        $scope.officalPro.Name = $scope.pro.Name;
        $scope.officalPro.Code = $scope.pro.Code;
        $scope.officalPro.LogoUrl = $scope.pro.LogoUrl;
        $scope.officalPro.Description = $scope.pro.Description;
        var newProJsonData =  JSON.stringify($scope.officalPro);
        $.ajax({
          url: $scope.baseUrl + 'index.php/AdminProvider/EditingProviderProcess',
          data: {newProJsonData: newProJsonData},
          type: "POST",
          success: function(data) {
            if (data == "1") {
              window.location.href = $scope.baseUrl + 'index.php/AdminProvider';
            }
            else {
              ShowAlert("Xảy ra lỗi trong quá trình sửa thông tin nhà cung cấp !!!", "danger");
              return null;
            }
          }
        });
      }
      $scope.removeTempImg = function(){
        var obj = $('#removeTempImg');
        var path = obj.attr('urlPath');
        var tempList = $scope.tempImgs;
        var length = $scope.tempImgs.length;
         if(length >= 1) {
          for(var i = 0; i < length; i++){
            var item = tempList[i];
            if(item.path == path ){
              if (length == 1) {
                $scope.pro.LogoUrl = $scope.backupPro.LogoUrl;
              }
              else if (i == 0) {
                  $scope.pro.LogoUrl = $scope.tempImgs[1].path;
              }
              tempList.splice(i, 1);
              break;
            }
          }
        }
      }
    });