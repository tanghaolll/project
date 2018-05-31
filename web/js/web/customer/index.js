;
var customer_index_ops = {
	init: function(){
		this.eventBind();
	},
	eventBind:function(){
		var that = this;
		$(".remove").click(function(){
		   that.ops("remove",$(this).attr("data"));
		});
		$(".search").click(function(){
			$(".wrap_search").submit();
		});

	},
	ops:function(act,cid){
		
		callback = {
			"ok":function(){
			$.ajax({
			url:common_ops.buildWebUrl("/customer/ops"),
			type:'POST',
			data: {
				act:act,
				cid:cid
			},
			dataType:'json',
			success:function(res){
				
				callback = null;
				if(res.code == 200){
					callback =function(){
					window.location.href = window.location.href; 	
					};
					
					}
				common_ops.alert(res.msg,callback);	
				}
			});
			},
			"cancel":function(){

			}
		};
		//confirm不是阻塞的，必须要callback
		common_ops.confirm((act == "remove")?"您确定删除吗?":"你确定恢复吗？",callback);
		
	}
};
$(document).ready(function(){
	customer_index_ops.init();
});