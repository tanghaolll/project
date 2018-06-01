;
var purchase_set_ops={
	init:function(){
		this.eventBind();
	},
	eventBind:function(){
		laydate.render({
		  elem: '#created_time' //指定元素
		});
		$('#product').select2();
		$('#customer').select2();
		$(".save").click(function(){
			var created_time = $("input[name=created_time]").val();
			
		});
		 
	}
		
};
$(document).ready(function(){
	purchase_set_ops.init();
})

	
