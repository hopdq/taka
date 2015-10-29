function ProductAdminDetailModel(){
	var self = this;
  	this.listCategories = [];
  	this.listStatuses = [];
  	this.listProviders = [];
  	this.listAttributeValues = [];
  	this.listImgs = ko.observableArray([]);
  	this.product = {};
  	this.tempImgs = [];
  	this.attrTabVisible = ko.observable(true);
  	this.imgDefaultId = ko.observable(0);
  	this.priceBinding = ko.observable("0");
  	this.promotionValueBinding = ko.observable("0");
  	this.Init = function(productId, dataUrl){
  		$.get(dataUrl, { productId : productId }, function(data){
  			var jsonData = JSON.parse(data);
  			if(jsonData.listCategoriesModel != null){
  				self.listCategories = jsonData.listCategoriesModel.listCategories;
  			}
  			if(jsonData.listStatusesModel != null){
  				self.listStatuses = jsonData.listStatusesModel.listStatuses;
  			}
  			if(jsonData.listProvidersModel != null){
  				self.listProviders = jsonData.listProvidersModel.listProviders;
  			}
  			if(jsonData.listAttrValues != null){
  				self.listAttributeValues = jsonData.listAttrValues.listAttributes;
  			}
  			if(jsonData.product != null){
  				self.product = jsonData.product;
  				self.priceBinding(formatPriceString(self.product.Price));
  				self.promotionValueBinding(formatPriceString(self.product.PromotionValue));
  			} 
  			if(jsonData.listImgs != null && jsonData.listImgs.listImages != null){
  				var lstImgs = jsonData.listImgs.listImages;
  				var length = lstImgs.length;
  				for(var idx = 0; idx < length; idx ++){
  					var imgItem = lstImgs[idx];
  					self.tempImgs.push({ Id : imgItem.Id, Path: imgItem.Path});
  					self.listImgs.push({ Id : imgItem.Id, Path: imgItem.Path});
  					if(imgItem.IsDefault == 1){
  						self.imgDefaultId(imgItem.Id);
  					}
  				}
  			}
  			self.attrTabVisible(self.product.Id != '' && self.product.Id != 'undefined' && self.product.Id != null);
  			ko.applyBindings(self);

  			$('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
			$('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
				var children = $(this).parent('li.parent_li').find(' > ul > li');
				if (children.is(':visible')) {
					children.hide('fast');
					$(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
				} else {
					children.show('fast');
					$(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
				}
				e.stopPropagation();
			});
  		});
  	}
  	this.addTempImg = function(img){
  		self.tempImgs.push({ Id: img[0], Path: img[1] });
  	}
  	this.removeTempImg = function(id){
  		var tempList = self.tempImgs;
  		var length = self.tempImgs.length;
		if(length >= 1)
  		{
  			for(var i = 0; i < length; i++){
  				var item = tempList[i];
  				if(item.Id == id ){
  					tempList.splice(i, 1);
  					break;
  				}
  			}
  		}
  	}
  	this.removeMappedImg = function(item){
  		var id = item.Id;
  		var lstImgs = self.listImgs();
  		var length = lstImgs.length;
  		var checkDefaultDeleted = false;
  		if(length >= 1){
  			for(var i = 0; i < length; i++){
  				var item = lstImgs[i];
  				if(item.Id == id){
  					if(item.Id == self.imgDefaultId()){
  						checkDefaultDeleted = true;
  					}
  					self.listImgs.splice(i, 1);
  					break;
  				}
  			}
  			if(checkDefaultDeleted){
  				self.imgDefaultId(self.listImgs()[0].Id);
  			}
  		}
  		self.removeTempImg(id);
  	}
  	this.setDefaultImg = function(item){
  		var id = item.Id;
  		self.imgDefaultId(id);
  	}
  	this.saveProductInfo = function(){
  		var check = $('#smart-form-product .state-error').length;
  		if(check > 0)
  		{
  			return false;
  		}
  		else{
  			var price = $('#Price').val();
  			self.product.Price = removeCommas(price);
	  		if(self.product != null && self.product.Id != null && self.product.Id != ''){
	  			self.updateProduct();
	  		}
	  		else{
	  			self.createProduct();
	  		}
  		}
  	}
  	this.createProduct = function(){
  		var url = $('#createUrl').val();
  		self.product.Description = CKEDITOR.instances.content.getData();
      var product = JSON.stringify(self.product);
  		$.post(url, {product : product}, function(data){
  			if(data > 0){
  				self.attrTabVisible(true);
  				self.product.Id = data;
          ShowAlert('Thêm mới sản phẩm thành công!','success');
  			}
        else{
          ShowAlert('Có lỗi trong quá trình xử lý!','danger');
        }
  		});
  	}
  	this.updateProduct = function(){
  		var url = $('#updateUrl').val();
  		self.product.Description = CKEDITOR.instances.content.getData();
  		var product = JSON.stringify(self.product);
  		$.post(url, {product : product}, function(data){
  			if(data > 0){
          ShowAlert('Cập nhật thông tin sản phẩm thành công!','success');
  			}
        else{
          ShowAlert('Có lỗi trong quá trình xử lý!','danger');
        }
  		});
  	}
  	this.updateProductAttr = function(){
  		var url = $('#updateAttr').val();
  		var attrList = self.listAttributeValues;
  		var attrLength = attrList.length;
  		var attrInputList = [];
  		if(attrLength > 0){
  			for(var idx = 0; idx < attrLength; idx++ ){
  				var attrItem = attrList[idx];
  				var listAttrValues = attrItem.listAttrValues;
  				var cnt = listAttrValues.length;
  				for(var idx1 = 0; idx1 < cnt; idx1 ++){
  					var attrVal = listAttrValues[idx1];
  					if(attrVal.Checked){
  						attrInputList.push(attrVal.Id);
  					}
  				}
  			}
  		}
  		var tempImgs = self.tempImgs;
  		var tempImgsLength = tempImgs.length;
  		var tempImgIds = [];
  		if(tempImgsLength > 0){
  			for(var i = 0; i< tempImgsLength; i++){
  				var item = tempImgs[i];
  				tempImgIds.push(item.Id);
  			}
  		}
  		var tempImgData = {
  			tempImgIds : tempImgIds,
  			defaultImgId : self.imgDefaultId()
  		};
  		var attrData = JSON.stringify(attrInputList);
  		var imgData = JSON.stringify(tempImgData);
  		$.post(url, { productId : self.product.Id, attr: attrData, img : imgData}, function(data){
  			if(data > 0){
  				self.listImgs.removeAll();
  				if(tempImgsLength > 0){
  					for(var i = 0; i < tempImgsLength; i++){
  						var item = tempImgs[i];
  						self.listImgs.push(item);
  					}
  				}
  				$('.dz-image-preview').remove();
          ShowAlert('Cập nhật thông tin thành công!','success');
  			}
        else{
          ShowAlert('Có lỗi trong quá trình xử lý!','danger');
        }
  		});
  	}
}
