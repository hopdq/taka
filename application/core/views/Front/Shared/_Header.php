<header id="header"><!--header-->
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4" data-bind="with: logo">
					<div class="logo pull-left">
						<a data-bind="attr: { href: logoLink }"><img data-bind="attr: { src : logoPath }" alt="" /></a>
					</div>
				</div>
				<!-- <div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-user"></i> Account</a></li>
							<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
							<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							<li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
						</ul>
					</div>
				</div> -->
			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9" data-bind="with: navigator">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse" data-bind="foreach: listCategories">
							<li class="dropdown">
								<a data-bind="attr: { href: CategoryUrl }, css: active ? 'active' : ''">
									<span data-bind="text: Name"></span>
									<i class="fa fa-angle-down"></i>
								</a>
                                <ul role="menu" class="sub-menu" data-bind="foreach: listChilds">
                                    <li>
                                    	<a data-bind="attr: { href: CategoryUrl }">
                                    		<span data-bind="text: Name"></span>
											<i class="fa fa-angle-right pull-right"></i>
                                    	</a>
                                    	<ul role="menu" class="sub-menu-lv3" data-bind="foreach: listChilds">
		                                    <li>
		                                    	<a data-bind="attr: { href: CategoryUrl}, text: Name"></a>
		                                    </li>
		                                </ul>
                                    </li>
                                </ul>
                            </li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="search_box pull-right">
						<input type="text" placeholder="Search"/>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->
	