<?php
use \app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/web/account/set.js",app\assets\WebAsset::className());
use app\common\services\UrlService;
?>		
<div class="row  border-bottom">
	<div class="col-lg-12">
		<div class="tab_title">
			<ul class="nav nav-pills">
								<li  class="current"  >
					<a href="<?=UrlService::bulidWebUrl("/account/index")?>">账户列表</a>
				</li>
							</ul>
		</div>
	</div>
</div>
<div class="row m-t  wrap_account_set">
	<div class="col-lg-12">
		<h2 class="text-center">账号设置</h2>
		<div class="form-horizontal m-t m-b">
			<div class="form-group">
				<label class="col-lg-2 control-label">登录名:</label>
				<div class="col-lg-10">
					<input type="text" name="login_name" class="form-control" placeholder="请输入登录名~~" value="<?= $info?$info['login_name']:'' ;?>">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">手机:</label>
				<div class="col-lg-10">
					<input type="text" name="mobile" class="form-control" placeholder="请输入手机~~" value="<?= $info?$info['mobile']:'' ;?>">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">用户类型:</label>
				<?php if($info?$info['user_type']:''):?>
				<div class="col-lg-10">
					<input name="user_type" id="admin" type="radio" value="1" <?php if($info['user_type'] == 1):?> checked <?php endif;?>/> 
					<label for="admin">管理员</label>
					<input name="user_type" id="user" type="radio" value="2" <?php if($info['user_type'] == 2 || $info['user_type']="" ):?> checked   <?php endif;?>/> 
					<label for="user">普通用户</label>
				</div>
			<?php else:?>
				<div class="col-lg-10">
					<input name="user_type" id="admin" type="radio" value="1"  checked /> 
					<label for="admin">管理员</label>
					<input name="user_type" id="user" type="radio" value="2" checked /> 
					<label for="user">普通用户</label>
				</div>
			<?php endif;?>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<label class="col-lg-2 control-label">登录密码:</label>
				<div class="col-lg-10">
					<input type="password" name="login_pwd" class="form-control"  autocomplete="new-password" placeholder="请输入登录密码~~" value="<?=$info?"******":'';?>">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group">
				<div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="id" value="<?=$info?$info['uid']:0;?>">
					<button class="btn btn-w-m btn-outline btn-primary save">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>





