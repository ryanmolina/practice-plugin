jQuery(function(){
	// Second API call upon changing base currency
	var fromCurrency = jQuery('.convertFrom').find('option:selected').text();
	var toCurrency = jQuery('.convertTo').find('option:selected').text();
	
	jQuery.get('https://min-api.cryptocompare.com/data/price?fsym='+fromCurrency+'&tsyms='+toCurrency, function(newData){
		let toCurrencyValue = newData[toCurrency];
		let fromCurrencyValue = jQuery('#input').val();
		jQuery('#output').val(toCurrencyValue * fromCurrencyValue);
	});
	
  jQuery("#input").bind('keyup mouseup', function () {
		jQuery.get('https://min-api.cryptocompare.com/data/price?fsym='+fromCurrency+'&tsyms='+toCurrency, function(newData){
  		let toCurrencyValue = newData[toCurrency];
  		let fromCurrencyValue = jQuery('#input').val();
  		if (fromCurrencyValue > 0) {
  		  jQuery('#output').val((toCurrencyValue * fromCurrencyValue));
  		} else {
  		  jQuery('#output').val(0);
  		}
		});
  });
  
  jQuery("#output").bind('keyup mouseup', function () {
		jQuery.get('https://min-api.cryptocompare.com/data/price?fsym='+fromCurrency+'&tsyms='+toCurrency, function(newData){
  		let toCurrencyValue = newData[toCurrency];
  		let fromCurrencyValue = jQuery('#output').val();
  		if (toCurrencyValue > 0) {
  		  jQuery('#input').val((fromCurrencyValue/toCurrencyValue));
  		} else {
  		  jQuery('#input').val(0);
  		}
		});
  });
  
	jQuery('.convertFrom').change(function(){
		fromCurrency = jQuery(this).find("option:selected").text();
		jQuery.get('https://min-api.cryptocompare.com/data/price?fsym='+fromCurrency+'&tsyms='+toCurrency, function(newData){
  		let toCurrencyValue = newData[toCurrency];
  		let fromCurrencyValue = jQuery('#input').val();
  		jQuery('#output').val(toCurrencyValue * fromCurrencyValue);
		});
	});
	
	jQuery('.convertTo').change(function(){
		toCurrency = jQuery(this).find("option:selected").text();
		jQuery.get('https://min-api.cryptocompare.com/data/price?fsym='+fromCurrency+'&tsyms='+toCurrency, function(newData){
  		let toCurrencyValue = newData[toCurrency];
  		let fromCurrencyValue = jQuery('#input').val();
  		jQuery('#output').val(toCurrencyValue * fromCurrencyValue);
		});
	});

});