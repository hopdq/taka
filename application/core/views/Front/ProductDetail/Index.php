<section>
	<div class="container" data-bind="with: body">
		<div class="row">
			<div class="col-sm-9">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5" data-bind="with: imgsModel">
						<div class="view-product" data-bind="with: active">
							<img data-bind="attr: {src : Path }" alt="" />
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							<!-- Wrapper for slides -->
						    <div class="carousel-inner" data-bind="foreach: viewImgs">
								<div data-bind="css: active ? 'item active' : 'item',foreach: viewImgItem">
								  <a href="javascript:void(0)" data-bind="click: $root.changeImg">
								  	<img data-bind="attr: { src : Path }, css: active" alt="">
								  </a>
								</div>
							</div>
							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
							<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
							<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
					<div class="col-sm-7" data-bind="with: detail">
						<div class="product-information"><!--/product-information-->
							<img src="images/product-details/new.jpg" class="newarrival" alt="" />
							<h2 data-bind="text: Name"></h2>
							<p>Mã: <span data-bind="text: Code"></span></p>
							<img src="images/product-details/rating.png" alt="" />
							<span>
								<span data-bind="text: formatPriceString(PromotionPrice) + ' VNĐ'"></span>
								<h3 class="old-price" data-bind="visible: PromotionValue > 0, text: formatPriceString(Price) + ' VNĐ'"></h3>
								<!-- <label>Số lượng:</label>
								<input type="text" value="3" />
								<button type="button" class="btn btn-fefault cart">
									<i class="fa fa-shopping-cart"></i>
									Thêm vào giỏ
								</button> -->
							</span>
							<p><b>Trạng thái:</b> <span data-bind="text: Status"></span></p>
							<p><b>Thương hiệu:</b> <span data-bind="text: ProviderName"></span></p>
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->
				
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
							<li ><a href="#reviews" data-toggle="tab">Bình luận</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="details" data-bind="html: detail.Description">
						</div>
						<div class="tab-pane fade" id="reviews" >
							<div class="col-sm-12">
								<form action="#">
									<span>
										<input type="text" placeholder="Your Name"/>
										<input type="email" placeholder="Email Address"/>
									</span>
									<textarea name="" ></textarea>
									<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
									<button type="button" class="btn btn-default pull-right">
										Submit
									</button>
								</form>
							</div>
						</div>
						
					</div>
				</div><!--/category-tab-->
			</div>

			<div class="col-sm-3 padding-right">
				<div class="row" id="relateProduct">
					<h2 class="title text-center">Sản phẩm liên quan</h2>
					<div data-bind="foreach: relateProducts">
						<div class="row" data-bind="foreach: $data">
							<div class="product-image-wrapper col-sm-6">
								<div class="single-products">
									<div class="productinfo text-center">
										<a data-bind="attr: { href: DetailUrl }">
											<img data-bind="attr: { src: ImagePath, alt : Name }"/>
										</a>
										<h2 data-bind="text: formatPriceString(PromotionPrice) + ' VNĐ'"></h2>
										<h3 class="old-price" data-bind="visible: PromotionValue > 0, text: formatPriceString(Price) + ' VNĐ'"></h3>
										<a data-bind="attr: { href: DetailUrl }">
											<p data-bind="text: truncateString(Name, 34)" class="product-name"></p>
										</a>
										<!-- <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url('application/Content/Js/front/detailPage.model.js');?>"></script>
<script type="text/javascript">
    $('document').ready(function(){
        var model = new productDetailModel();
        var loadSameProviderProducts = <?php echo isset($loadSameProviderProducts) ? '"'.$loadSameProviderProducts.'"' : "";?>;
        model.init(<?php echo '"'.$loadDataUrl.'"';?>, <?php echo '"'.$loadRelateProducts.'"';?>, loadSameProviderProducts);
    });
</script>