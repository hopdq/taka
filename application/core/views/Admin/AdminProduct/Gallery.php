<div>
	<div class="superbox col-sm-12" ng-controller="GalleryController">
		<div class="col-sm-3" ng-repeat="img in gallery">
			<img src="{{img.src}}" data-img="{{img.src}}" alt="{{img.alt}}" class="superbox-img">
		</div>
	</div>
</div>