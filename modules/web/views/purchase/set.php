<?php
use app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppCssStatic("/plugins/select2/select2.min.css",app\assets\WebAsset::className());
StaticService::includeAppJsStatic("/plugins/select2/select2.min.js",app\assets\WebAsset::className());
StaticService::includeAppJsStatic("/js/web/purchase/set.js",app\assets\WebAsset::className());

?>
<div class="row  border-bottom">
	<div class="col-lg-12">
		<div class="tab_title">
			<ul class="nav nav-pills">
				<li  class="current"  >
					<a href="/web/account/index">采购单列表</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="row m-t  wrap_account_set">
	<div class="col-lg-12">
		<h2 class="text-center">采购单</h2>
		<div class="form-horizontal m-t m-b">
			<div class="form-group">
				<label class="col-lg-2 control-label">产品类型:</label>
				<div class="col-lg-10">
				
				<select id="product" class="form-control" style="width: 300px;">
					<?php foreach($product as $_item):?>
					  <option value="<?=$_item['product']?>"><?=$_item['product']?></option>
					 <?php endforeach;?>
				</select>
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">客户:</label>
				<div class="col-lg-10">
					<select id="customer" class="form-control" style="width: 300px;">
					  <?php foreach($cust as $_list):?>
					  <option value="<?=$_list['cust_name']?>"><?=$_list['cust_name']?></option>
					 <?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">单价:</label>
				<div class="col-lg-10">
					<input type="text" name="price" class="form-control" autocomplete="off" placeholder="请输入单价~~" value="test4">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">数量:</label>
				<div class="col-lg-10">
					<input type="text" name="number" class="form-control" placeholder="请输入数量~~" value="apanly@163.com">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">付款凭证:</label>
				<div class="col-lg-10">
					<input type="text" name="invoice" class="form-control" autocomplete="off" placeholder="请输入支付凭证~~" value="test4">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">时间:</label>
				<div class="col-lg-10">
					<input type="text" id="created_time" name="created_time" class="form-control" autocomplete="off" placeholder="请输入时间~~" value="">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">应付:</label>
				<div class="col-lg-10">
					<input type="text" name="total_price" class="form-control" autocomplete="off" placeholder="总价格为~~" value="test4" disabled>
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="id" value="13">
					<button class="btn btn-w-m btn-outline btn-primary save">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>





