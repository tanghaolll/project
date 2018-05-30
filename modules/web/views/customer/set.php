<?php
use app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/web/customer/set.js",app\assets\WebAsset::className());
?>
<div class="row  border-bottom">
	<div class="col-lg-12">
		<div class="tab_title">
			<ul class="nav nav-pills">
								<li  class="current"  >
					<a href="<?=UrlService::bulidWebUrl("/customer/index");?>">客户列表</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="row m-t  wrap_qrcode_set">
	<div class="col-lg-12">
		<h2 class="text-center">增加客户</h2>
		<div class="form-horizontal m-t m-b">
			<div class="form-group">
				<label class="col-lg-2 control-label"> 客户名称:</label>
				<div class="col-lg-10">
					<input type="text" name="cust_name" class="form-control" placeholder="请输入客户名称~~" value="">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="id" value="2">
					<button class="btn btn-w-m btn-outline btn-primary save">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>


	


