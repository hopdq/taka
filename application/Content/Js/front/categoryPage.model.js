function categoryModel(){
	var self = this;
	this.logo = "";
	this.customer = {};
	this.shoppingCart = {};
	this.navigator = [];
	this.txtSearch = "";
	this.body = {};
	this.provider = [];
	this.footer = {};
	this.loadGridData = "";
	this.filterSortPagingProcess = function(){
		var input = {};
		var grid = this.body.grid;
		input.paging = grid.paging;
		input.filter = grid.filter;
		input.sorter = grid.sorter;
		var strInput = JSON.stringify(input);
		var url = self.loadGridData;
		$.get(url, { input : strInput },function(data){
			var jsonData = JSON.parse(data);
			self.initGrid(jsonData);
		});
	};
	this.setProviderFilter = function(item){
		self.body.grid.filter.providerId = item.Id;
		self.body.grid.paging.page = 1;
		self.filterSortPagingProcess();
	}
	this.setAttrFilter = function(item){
		var filter = self.body.grid.filter;
		var attrValues = filter.attrValues;
		if(attrValues == null || attrValues.length == 0){
			filter.attrValues = [{ attrId : item.attrId, value: item.id }];
		}
		else{
			var length = attrValues.length;
			var check = true;
			for(var idx = 0; idx < length; idx ++){
				var fItem = attrValues[idx];
				if(fItem.attrId == item.attrId){
					fItem.value = item.id;
					check = false;
					break;
				}
			}
			if(check){
				attrValues.push({ attrId : item.attrId, value: item.id });
			}
		}
		self.body.grid.paging.page = 1;
		self.filterSortPagingProcess();
	}
	this.unSetProviderFilter = function(item){
		self.body.grid.filter.providerId = null;
		self.body.grid.paging.page = 1;
		self.filterSortPagingProcess();
	}
	this.unSetAttrFilter = function(item){
		var filter = self.body.grid.filter;
		var attrValues = filter.attrValues;
		if(attrValues != null && attrValues.length > 0){
			var length = attrValues.length;
			var check = -1;
			for(var idx = 0; idx < length; idx ++){
				var fItem = attrValues[idx];
				if(fItem.attrId == item.attrId && fItem.value == item.id){
					check = idx;
					break;
				}
			}
			if(check >= 0){
				attrValues.splice(check, 1);
			}
		}
		self.body.grid.paging.page = 1;
		self.filterSortPagingProcess();
	}
	this.gotoPage = function(item){
		self.body.grid.paging.page = item.value;
		self.filterSortPagingProcess();
	}
	this.initSlider = function (){
		$('#sl2').slider();
		$('#sl2').on('slideStop', function(){
			var value = $('#sl2').slider('getValue').val();
			var spl = value.split(',');
			if(spl.length >= 2){
				var filter = self.body.grid.filter;
				filter.price = { from : spl[0], to: spl[1]};
				self.body.grid.paging.page = 1;
				self.filterSortPagingProcess();
			}
		});
		var filter = self.body.grid.filter;
		if(filter.price != null && filter.price.from >= 0 && filter.price.to > 0){
			$('#sl2').slider('setValue', [filter.price.from, filter.price.to]);
		}
	}
	this.init = function(categoryId, loadUrl, loadGridData){
		self.loadGridData = loadGridData;
		var url = loadUrl;
		$.get(url, { categoryId : categoryId },function(data){
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
			self.initSlider();
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
		self.body.infor = data.infor;
		self.body.grid = {};
		var grid = self.body.grid;
		if(data.grid.filter != null){
			grid.filter = data.grid.filter;
		}
		if(data.childCategories != null){
			self.body.childCategories = data.childCategories;
		}
		if(data.grid.paging != null){
			grid.paging = data.grid.paging;
			var pageItems = self.initPaging(grid.paging);
			self.body.grid.pageNavigationModel = ko.observableArray(pageItems);
		}
		if(data.grid.sorter != null){
			grid.sorter = data.grid.sorter;
		}
		var filterModel = {};
		var filterModelData = data.grid.filterModel;
		if(filterModelData != null){
			if(filterModelData.providers != null)
			{
				filterModel.providers = ko.observableArray(filterModelData.providers);
			}
			if(filterModelData.price != null)
			{
				filterModel.price = ko.observable({ from : filterModelData.price.from, to : filterModelData.price.to });
			}
			if(filterModelData.attrs != null)
			{
				filterModel.attrs = ko.observableArray(filterModelData.attrs);
			}
		}
		grid.filterModel = filterModel;
		if(data.grid.products != null){
			grid.products = ko.observableArray(data.grid.products);
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
	
	this.initGrid = function(grid, type){
		if(grid.products != null){
			self.body.grid.products(grid.products);
		}
		var filterModel = self.body.grid.filterModel;
		var filterModelData = grid.filterModel;
		if(filterModelData != null){
			if(filterModelData.providers != null)
			{
				filterModel.providers(filterModelData.providers);
			}
			if(filterModelData.price != null)
			{
				filterModel.price({ from : filterModelData.price.from, to : filterModelData.price.to });
			}
			if(filterModelData.attrs != null)
			{
				filterModel.attrs(filterModelData.attrs);
			}
		}

		if(grid.paging != null){
			var pageItems = self.initPaging(grid.paging);
			self.body.grid.pageNavigationModel(pageItems);
		}

		self.initSlider();
	}
	this.initPaging = function(paging){
		var start = Math.max(paging.page - 2, 1);
		var end = Math.min(paging.totalPages, start + 4);
		var goStart = { status : true, value : 1};
		var goBack = { status : true, value : paging.page - 1};
		var goEnd = { status : true, value : paging.totalPages};;
		var goNext = { status : true, value : paging.page + 1};
		var pageItems = [];
		if(paging.page == 1){
			goStart = { status : false };
			goBack =  { status : false };
		}
		if(paging.page == paging.totalPages){
			goEnd =  { status : false };
			goNext =  { status : false };
		}
		if(start == 1){
			goStart =  { status : false };
		}
		if(end == paging.totalPages){
			goEnd =  { status : false };
		}
		if(goStart.status){
			pageItem = { value : goStart.value, text : "&laquo;&laquo;", activeClass : '', isActive : false};
			pageItems.push(pageItem);
		}
		if(goBack.status){
			pageItem = { value : goBack.value, text : "&laquo;", activeClass : '', isActive : false};
			pageItems.push(pageItem);
		}
		for(var idx = start; idx <= end; idx ++){
			if(idx == paging.page){
				pageItem = { value : idx, text: idx, activeClass : 'active', isActive : true};
			}
			else
			{
				pageItem = { value : idx, text: idx, activeClass : '', isActive : false};
			}
			pageItems.push(pageItem);
		}

		if(goNext.status){
			pageItem = { value : goNext.value, text : "&raquo;", activeClass : '', isActive : false};
			pageItems.push(pageItem);
		}

		if(goEnd.status){
			pageItem = { value : goEnd.value, text : "&raquo;&raquo;", activeClass : '', isActive : false};
			pageItems.push(pageItem);
		}
		return pageItems;
	}
}