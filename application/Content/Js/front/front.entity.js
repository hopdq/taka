function productList(){
	var self = this;
	this.products = [];
	this.pageInfo = {};
	this.filter = {};
	this.sort = {};
	this.url = {};
	this.addItems = function(item){
		self.products.push(item);
	}
	this.initData = function(url, callback){
		if(url != null && url != ""){
			$.get(url, { filter: filter, sort: sort, url: url }, function(ret){
				var rData = JSON.parse(ret);
				if(rData.products != null){
					var length = rData.products.length;
					if(length > 0){
						self.products = rData.products;
					}
					self.pageInfo = rData.pageInfo;
				}
			})
		}
	}
}