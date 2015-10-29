// warning, success, info, danger
function ShowAlert(message, type){
	$('#alert-' + type).find('.message').html(message);
	$('#alert-' + type).fadeIn().delay(5000).fadeOut();
}
function formatPrice(event, obj){
	var value = $(obj).val();
	value = value.replace(/,+/g, '');
	var valueFormat = formatPriceString(value);
	$(obj).val(valueFormat);
}
function removeCommas(str){
	var result = str.replace(/,+/g, '');
	return result;
}
function validatePriceKeycode(event){
	var code = event.keyCode;
	if((code >= 48 && code <= 57) || (code >= 96 && code <= 105) || code == 190 || code == 110 || code == 8 || code == 46 ){
  		return true;
	}
	else{
		event.preventDefault();
	}
}
function formatPriceString(str){
	if(str > 0)
	{
		var result = "";
		var strSpl = str.split('.');
		if(strSpl.length > 0){
			var leftPart = strSpl[0];
			var length = leftPart.length;
			var hops = 3;
			var loopCnt = Math.ceil(length / hops);
			if(loopCnt > 0){
				for(var i = 1; i <= loopCnt; i ++){
					var startIdx = length - i * hops;
					var endIndex = startIdx + hops;
					startIdx = Math.max(startIdx, 0);
					var subStr = leftPart.substring(startIdx, endIndex);
					if(i == 1)
					{
						result = subStr + result;
					}
					else{
						result = subStr + "," + result;
					}
				}
			}
		}
		if(strSpl.length > 1){
			result += "." + strSpl[1];
		}
		return result;
	}
	return 0;
}
function truncateString(str, maxLength){
	var result = "";
	if (str.length > maxLength) {
        result = str.substring(0, maxLength) + "...";
    }
    else{
    	result = str;
    }
    return result;
}