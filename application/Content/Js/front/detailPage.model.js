function productDetailModel(){
	var self = this;
	this.logo = "";
	this.customer = {};
	this.shoppingCart = {};
	this.navigator = [];
	this.txtSearlengthch = "";
	this.body = {};
	this.provider = [];
	this.footer = {};
	this.loadDataUrl = "";
	this.loadRelateProducts = "";
	this.loadSameProviderProducts = "";
	this.init = function(loadDataUrl, loadRelateProducts, loadSameProviderProducts){
		self.loadDataUrl = loadDataUrl;
		self.loadRelateProducts = loadRelateProducts;
		self.loadSameProviderProducts = loadSameProviderProducts;
		var url = self.loadDataUrl;
		$.get(url,function(data){
			var jData = JSON.parse(data);
			if(jData != null){
				if(jData.header != null && jData.header != ""){
					self.initHeader(jData.header);
				}
				if(jData.body != null && jData.body != ""){
					self.initBody(jData.body);
				}
				if(jData.footer != null && jData.footer != ""){
					self.initFooter(jData.footer);
				}
			}
			ko.applyBindings(self);
		});
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
	this.initBody = function(data){
		self.body = { detail: data.detail, relateProducts : [] };
		var imgs = data.imgs;
		var length = imgs.length;
		if(length > 0){
			self.body.imgsModel = { active: ko.observable(imgs[0])};
			var viewImgs = [];
			var cnt = 3;
			var round = Math.ceil(length / cnt);
			for(var i = 0; i < round; i++){
				var viewImgItem = [];
				var iS = i * cnt;
				var iE = (i + 1) * cnt - 1;
				for(var j = iS; j < Math.min(iE, length); j++){
					var img = imgs[j];
					var itemImg = { active: ko.observable(j == 0 ? "active" : ""), id: img.Id, Path: img.Path};
					viewImgItem.push(itemImg);
				}
				viewImgs.push({ viewImgItem : viewImgItem, active : i == 0 });
			}
			self.body.imgsModel.viewImgs = viewImgs;
		}
		var relateProducts = data.relateProducts;
		var rowNums = 2;
		var length = relateProducts.length;
		var rowCnt = Math.ceil(length / rowNums);
		for(var idx = 0; idx < rowCnt; idx ++){
			var start = idx * rowNums;
			var end = Math.min(start + rowNums, length);
			var row = [];
			for(var jdx = start; jdx < end; jdx ++){
				row.push(relateProducts[jdx]);
			}
			self.body.relateProducts.push(row);
		}
	}
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
	this.changeImg = function(img){
		var id = img.id;
		var model = self.body.imgsModel;
		model.active(img);
		for(var idx = 0; idx < model.viewImgs.length; idx ++){
			var viewImgItem = model.viewImgs[idx];
			for(var jdx = 0; jdx < viewImgItem.viewImgItem.length; jdx ++){
				var itemImg = viewImgItem.viewImgItem[jdx];
				if(itemImg.active() == "active"){
					itemImg.active("");
				}
				if(itemImg.id == id){
					itemImg.active("active");
				}
			}
		}
	}
}