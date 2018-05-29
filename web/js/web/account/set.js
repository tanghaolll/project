;
var account_set_ops = {
	init: function(){
		this.eventBind();
	},
	eventBind:function(){
		$(".wrap_account_set .save").click(function(){
			var btn_target = $(this);
			if(btn_target.hasClass("diaabled")){
				common_ops.alert("正在处理，请不要重复提交");
				return;
			}
			var login_name = $(".wrap_account_set input[name=login_name]").val();
			var mobile = $(".wrap_account_set input[name=mobile]").val();
			var user_type = $(".wrap_account_set input[name=user_type]:checked").val();
			var login_pwd =  $(".wrap_account_set input[name=login_pwd]").val();

			btn_target.addClass("disabled");

			var data = {
				login_name:login_name,
				mobile:mobile,
				user_type:user_type,
				login_pwd:login_pwd,
			};
			$.ajax({
				url:common_ops.buildWebUrl("/account/set"),
				type:"POST",
				data:data,
				dataType:'json',
				success:function(res){
					btn_target.removeClass("disabled");
					var callback = null;
					if(res.code == 200){
						callback=function(){
							window.location.href = common_ops.buildWebUrl("/account/index");
						}
					}
					common_ops.alert(res.msg,callback);
				}
			});
		});
	}
};

$(document).ready(function(){
		account_set_ops.init();
})