<div class="provider_items container"><!--provider_items-->
    <h2 class="title text-center">Thương hiệu nổi bật</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" data-bind="foreach: footer.providers">
            <div data-bind="css: active ? 'item active' : 'item',foreach: items">
                <div class="col-sm-2">
                    <div class="text-center">
                        <a data-bind="attr: { href: Link }">
                            <img data-bind="attr: { src: LogoUrl, alt: Name }" />
                        </a>
                        <p data-bind="text: Name"></p>
                    </div>
                </div>
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>          
    </div>
</div><!--/provider_items-->
<footer id="footer" data-bind="with: footer.infor">
	<div class="footer-bottom">
		<div class="container">
            <div class="logo pull-left col-sm-3" data-bind="with: logo">
                <a data-bind="attr: { href: logoLink }"><img data-bind="attr: { src : logoPath }" alt="" /></a>
            </div>
            <div class="col-sm-8" data-bind="with: company">
    			<div class="row">
    				<p class="pull-left" data-bind="text: name"></p>
    			</div>
                <div class="row">
                    <p class="pull-left"><b>Địa chỉ: </b><span data-bind="text: address"></span></p>
                </div>
                <div class="row">
                    <p class="pull-left"><b>MST: </b><span data-bind="text: mst"></span></p>
                </div>
            </div>
		</div>
	</div>
</footer><!--/Footer-->