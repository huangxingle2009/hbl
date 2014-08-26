/**
 * 表单验证类插件
 */
(function($){
	
	$.fn.extend({
		validate:function(Option){
			var defaults={
				'rule':{
					'email':''
					
				},
				'msg':{
					'email_msg':'邮箱规则不正确'
				}
				
				
			};
			settings=$.extend(defaults,Option);
			return this.each(function(){
				var arr;
			
				$(this).find("input").each(function(){
					ruleClass=$(this).attr("class");
					if(ruleClass.indexOf("|")!=-1){  //判断规则里面是否与|隔开，如果是表示有多个验证规则
						arr=rule.split("|");
						for(i=0;i<arr.length;i++){
							
						}
					}else{
						if(settings.rule.hasOwnProperty(ruleClass)){ //判断default里面是否拥有某一个属性
							
							if(ruleClass=="email"){
								/**
								 * <p>邮箱不能以 - _ .以及其它特殊字符开头和结束</p> 
									<p>邮箱域名结尾为2~5个字母，比如cn、com、name</p> 
								 */
								reg=/^[0-9a-zA-Z]+[-_\.0-9a-zA-Z]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,5}$/;
								if(!reg.test($(this).val())){
									$(this).tooltip(
											
										{ content: "邮箱格式不正确!" },
										{position:{ my: "left+15 center", at: "right center" }}
									
									);
									$(this).tooltip( "open" );
								}
							}
							
						}else{
							
						}
					}
				})
				
			})
		}
	});
	
})(jQuery)