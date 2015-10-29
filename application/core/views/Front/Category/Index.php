<section>
	<div class="container" data-bind="with: body">
		<div class="row" data-bind="with: grid">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<div class="brands_products" data-bind="with: filterModel"><!--brands_products-->
						<div class="filter-item">
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked" data-bind="foreach: providers">
									<li>
										<a href="javascript:void(0)" data-bind="click: isActive ? $root.unSetProviderFilter : $root.setProviderFilter"> 
											<span data-bind="text: Name"></span>
											<span data-bind="text: '(' + Cnt + ')'"></span>
											<i class="pull-right fa fa-square-o" data-bind="visible: !isActive"></i>
											<i class="pull-right fa fa-check-square-o" data-bind="visible: isActive"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<!--price-range-->
						<div class="price-range" data-bind="with: price">
							<h2>Khoảng giá</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-bind="attr: { 'data-slider-min' : from, 'data-slider-max' : to, 'data-slider-value' : '[' + from + ',' + to + ']'}" data-slider-step="50000" id="sl2" ><br />
								 <b class="price-min" data-bind="text: formatPriceString(from) + ' VNĐ'"></b>
								 <b class="pull-right price-max" data-bind="text: formatPriceString(to) + ' VNĐ'"></b>
							</div>
						</div>
						<!--/price-range-->
						<div data-bind="foreach: attrs">
							<div class="filter-item" data-bind="visible: code != 'mau-sac'">
								<h2 data-bind="text: title"></h2>
								<div class="brands-name">
									<ul class="nav nav-pills nav-stacked" data-bind="foreach: items">
										<li>
											<a href="javascript:void(0)" data-bind="click: isActive ? $root.unSetAttrFilter : $root.setAttrFilter"> 
												<span data-bind="text: name"></span>
												<span data-bind="text: '(' + Cnt + ')'"></span>
												<i class="pull-right fa fa-square-o" data-bind="visible: !isActive"></i>
												<i class="pull-right fa fa-check-square-o" data-bind="visible: isActive"></i>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="filter-item" data-bind="visible: code == 'mau-sac'">
								<h2 data-bind="text: title"></h2>
								<div class="brands-name">
									<ul class="nav nav-pills nav-stacked" data-bind="foreach: items">
										<li>
											<a href="javascript:void(0)" data-bind="click: isActive ? $root.unSetAttrFilter : $root.setAttrFilter, style: { backgroundColor: name }, css: isActive ? 'filter-color active' : 'filter-color'"> 
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div><!--/brands_products-->
				</div>
			</div>
			
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<div data-bind="foreach: products">
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
					<div class="clear"></div>
					<ul class="pagination" data-bind="foreach: pageNavigationModel">
						<li data-bind="css: activeClass">
							<a href="javascript:void(0)" data-bind="html: text, click: $root.gotoPage"></a>
						</li>
					</ul>
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>

<script src="<?php echo base_url('application/Content/Js/front/categoryPage.model.js');?>"></script>
<script type="text/javascript">
    $('document').ready(function(){
        var model = new categoryModel();
        model.init(<?php echo ''.$data;?>, <?php echo '"'.$loadDataUrl.'"';?>, <?php echo '"'.$loadGridData.'"';?>);
    });
</script>