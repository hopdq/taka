angular.module('Gallery', []).controller('GalleryController', ['$scope', function($scope) {
	$scope.gallery = [{
			src: 'http://www.w3schools.com/images/colorpicker.gif',
			alt: 'test'
		}];
	// $scope.Init = function(){
	// 	$scope.gallery = [{
	// 		src: 'http://www.w3schools.com/images/colorpicker.gif',
	// 		alt: 'test'
	// 	}];
	// 	$scope.$digest();
	// };
	// $scope.addToGallery = function(img){
	// 	$scope.gallery.push(img);
	// }
}]);