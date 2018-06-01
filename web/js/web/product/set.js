;
var product_set_ops = {
	init: function(){
		this.eventBind();
	},
	eventBind: function(){
		$(".save").click(function(){
			
			var btn_target = $(this);
			if(btn_target.hasClass("disabled")){
				common_ops.alert("正在处理，请不要重复提交");
				return;
			}
			var product =  $("input[name=product]").val();
			var pid = $("input[name=pid]").val();
			btn_target.addClass("disabled");

			var data = {
				product:product,
				pid:pid
			};
			$.ajax({
				url:common_ops.buildWebUrl("/product/set"),
				type:"POST",
				data:data,
				dataType:'json',
				success:function(res){
					btn_target.removeClass("disabled");
					var callback = null;
					if(res.code == 200){
						callback=function(){
							window.location.href = common_ops.buildWebUrl("/product/index");
						}
					}
					common_ops.alert(res.msg,callback);
				}
			});
		});

		
	}
};
$(document).ready(function(){
	product_set_ops.init();
});