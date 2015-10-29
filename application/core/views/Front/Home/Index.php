<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators" data-bind="foreach: slider">
						<li data-target="#slider-carousel" data-bind="attr: { 'data-slide-to' : stt }, css: active ? 'active' : ''"></li>
					</ol>
					
					<div class="carousel-inner" data-bind="foreach: slider">
						<div class="item" data-bind="css: active ? 'active' : ''">
							<a data-bind="attr: { href : link }">
								<img data-bind="attr: { src : urlPath }" />
							</a>
						</div>
					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->

<section>
	<div class="container">
		<div class="row" data-bind="foreach: categories">
			<div class="category-tab"><!--category-tab-->
				<div class="col-sm-12 tab-header">
					<div class="cate-title"><h3 data-bind="text: Name"></h3></div>
					<ul class="nav nav-tabs" data-bind="foreach: sorts">
						<li data-bind="css: activeClass"><a href="javascript:void(0)" data-bind="click: $root.sortCategoryBox, text : name"></a></li>
<!-- 							<li class="active"><a  href="javascript:void(0)" data-bind="onclick: $parent.sortCategoryBox.bind($data.Id,'NEW_OLD')">Mới nhất</a></li>
						<li><a href="javascript:void(0)" data-bind="click: $parent.sortCategoryBox.bind('sort','PROMOTION')">Khuyến mại</a></li>
						<li><a href="javascript:void(0)" data-bind="click: $parent.sortCategoryBox.bind('sort','PRICE_ASC')">Giá từ thấp -> cao</a></li>
						<li><a href="javascript:void(0)" data-bind="click: $parent.sortCategoryBox.bind('sort','PRICE_DESC')">Giá từ cao -> thấp</a></li> -->
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tshirt" data-bind="foreach: listProducts.products" >
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<a data-bind="attr: { href: DetailUrl }">
											<img data-bind="attr: {src: ImagePath, alt : Name }"/>
										</a>
										<h2 data-bind="text: formatPriceString(PromotionPrice) + ' VNĐ'"></h2>
										<h3 class="old-price" data-bind="visible: PromotionValue > 0, text: formatPriceString(Price) + ' VNĐ'"></h3>
										<a data-bind="attr: { href: DetailUrl }">
											<p data-bind="text: Name" class="product-name"></p>
										</a>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/category-tab-->
		</div>
	</div>
</section>


<script src="<?php echo base_url('application/Content/Js/front/homepage.model.js');?>"></script>
<script type="text/javascript">
    $('document').ready(function(){
        var model = new homeModel();
        model.init(<?php echo '"'.$loadDataUrl.'"';?>, <?php echo '"'.$cateBoxSortingUrl.'"';?>, <?php echo '"'.$loadBannerUrl.'"';?>);
    });
</script>