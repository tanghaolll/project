;
var purchase_index_ops = {
	init: function(){
		this.eventBind();
	},
	eventBind: function(){
		$(".search").click(function(){
			$(".wrap_search").submit();
		});
	}
};
$(document).ready(function(){
	purchase_index_ops.init();
});
