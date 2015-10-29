function homeModel(){
	var self = this;
	this.logo = "";
	this.customer = {};
	this.shoppingCart = {};
	this.navigator = [];
	this.txtSearch = "";
	this.slider = [];
	this.categories = ko.observableArray([]);
	this.provider = [];
	this.footer = {};
	this.cateBoxSortingUrl = "";
	self.sortCategoryBox = function(item){
		var url = self.cateBoxSortingUrl;
		$.get(url, { categoryId : item.cateId, sort: item.code },function(data){
			var jsonData = JSON.parse(data);
			var itemId = item.cateId;
			var curCategories = self.categories();
			var length = curCategories.length;
			for(var idx = 0; idx < length; idx ++){
				var cate = curCategories[idx];
				if(cate.Id == itemId){
					cate.listProducts.products(jsonData.products);
					var sorts = cate.sorts;
					var sortsLength = sorts.length;
					var check = 0;
					for(var i = 0; i < sortsLength; i++){
						var sort = sorts[i];
						if(sort.code == item.code){
							sort.activeClass('active');
							check ++;
						}
						else{
							if(sort.activeClass() == 'active'){
								sort.activeClass('');
								check ++;
							}
						}
						if(check == 2){
							break;
						}
					}
					// cate.listProducts.products.push(data.products);
					break;
				}
			}		
		});
	};
	this.init = function(loadDataUrl, cateBoxSortingUrl, loadBannerUrl){
		self.cateBoxSortingUrl = cateBoxSortingUrl;
		var url = loadDataUrl;
		$.get(url, function(data){
			var jData = JSON.parse(data);
			if(jData != null){
				if(jData.header != null && jData.header != ""){
					self.initHeader(jData.header);
				}
				if(jData.body != null && jData.body != ""){
					self.initCategories(jData.body.listCategories);
				}
				if(jData.footer != null && jData.footer != ""){
					self.initFooter(jData.footer);
				}
			}
			ko.applyBindings(self);
		});
		self.initBanner(loadBannerUrl);
	};
	this.initHeader = function(data){
		if(data != null){
			if(data.logo != null && data.logo != ""){
				self.logo = data.logo;
			}
			if(data.customer != null){
				self.customer = data.customer;
			}
			if(data.shoppingCart != null){
				self.shoppingCart = data.shoppingCart;
			}
			if(data.navigator != null){
				self.navigator = data.navigator;
			}
		}
	};
	this.initBanner = function(url){
		$.get(url, function(data){
			var jData = JSON.parse(data);
			if(jData != null){
				if(jData.slider != null){
					var slides = jData.slider;
					var length = slides.length;
					for(var idx = 0; idx < length; idx++){
						var banner = slides[idx];
						banner.active = idx == 0;
						banner.stt = idx;
						self.slider.push(banner);
					}
				}
			}
		});
	};
	this.initFooter = function(footer){
		self.footer = { providers : [], infor : {} };
		var providers = footer.providers;
		var length = providers.length;
		var itemsInPage = 6;
		var pageCnt = Math.ceil(length / itemsInPage);
		for(var idx = 0; idx < pageCnt; idx ++){
			var page = { items : [], active : idx == 0};
			var start = idx * itemsInPage;
			var end = Math.min(start + itemsInPage, length);
			for(var jdx = start; jdx < end; jdx ++){
				page.items.push(providers[jdx]);
			}
			self.footer.providers.push(page);
		}
		if(footer.infor != null){
			self.footer.infor = footer.infor;
		}
	}
	this.initCategories = function(data){
		var length = data.length;
		if(data != null && length > 0){
			for(var idx = 0; idx < length; idx ++){
				var item = data[idx];
				var sorts = [
					{ activeClass : ko.observable('active'), cateId : item.Id, code : 'OLD_NEW', name : 'Mới nhất'},
					{ activeClass : ko.observable(''), cateId : item.Id, code : 'PROMOTION', name : 'Khuyến mại'},
					{ activeClass : ko.observable(''), cateId : item.Id, code : 'PRICE_ASC', name : 'Giá thấp --> cao'},
					{ activeClass : ko.observable(''), cateId : item.Id, code : 'PRICE_DESC', name : 'Giá cao --> thấp'}
					];
				var products = ko.observableArray(item.listProducts.products);
				var cate = { Id : item.Id, Name : item.Name, sorts : sorts, listProducts: { products : products }};
				self.categories.push(cate);
			}
		}
	};
}