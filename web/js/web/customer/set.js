;
var customer_set_ops = {
	init: function(){
		this.eventBind();
	},
	eventBind: function(){
		$(".save").click(function(){
			
			var btn_target = $(this);
			if(btn_target.hasClass("diaabled")){
				common_ops.alert("正在处理，请不要重复提交");
				return;
			}
			var cust_name =  $("input[name=cust_name]").val();
			btn_target.addClass("disabled");

			var data = {
				cust_name:cust_name
			};
			$.ajax({
				url:common_ops.buildWebUrl("/customer/set"),
				type:"POST",
				data:data,
				dataType:'json',
				success:function(res){
					btn_target.removeClass("disabled");
					var callback = null;
					if(res.code == 200){
						callback=function(){
							window.location.href = common_ops.buildWebUrl("/customer/index");
						}
					}
					common_ops.alert(res.msg,callback);
				}
			});
		});
	}
};
$(document).ready(function(){
	customer_set_ops.init();
});