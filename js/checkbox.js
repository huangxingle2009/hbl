/**
 * È«Ñ¡²å¼þ
 */
(function($){
	
	$.fn.extend({
		
		checkAll:function(Option){
			
			var defaults={
				'chkname':'chk',
				'callback':function(){}
			};
			settings=$.extend(defaults,Option);
			items=$("input[name='"+settings.chkname+"']");
			
			
			return this.each(function(){
				
				$(this).click(function(){
					items.each(function(){
						$(this).attr("checked",!$(this).attr("checked"))
					})
					
					settings.callback(11);
				})
				
			})
		}
	});
	
})(jQuery)