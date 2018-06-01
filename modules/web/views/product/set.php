<?php
use app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/web/product/set.js",app\assets\WebAsset::className());
?>
<div class="row  border-bottom">
	<div class="col-lg-12">
		<div class="tab_title">
			<ul class="nav nav-pills">
								<li  class="current"  >
					<a href="<?=UrlService::bulidWebUrl("/product/index");?>">产品列表</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="row m-t  wrap_qrcode_set">
	<div class="col-lg-12">
		<h2 class="text-center">增加产品</h2>
		<div class="form-horizontal m-t m-b">
			<div class="form-group">
				<label class="col-lg-2 control-label"> 产品名称:</label>
				<div class="col-lg-10">
					<input type="text" name="product" class="form-control" placeholder="请输入产品名称~~" value="<?=$info?$info['product']:"";?>">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="pid" value="<?=$info?$info['pid']:0;?>">
					<button class="btn btn-w-m btn-outline btn-primary save">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>


	


