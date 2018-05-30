<?php
use app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/web/account/index.js",app\assets\WebAsset::className());
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
<div class="row">
	<div class="col-lg-12">
		<form class="form-inline wrap_search">
			<div class="row m-t p-w-m">
                <div class="form-group">
                    <select name="status" class="form-control inline">
                        <option value="-1"  <?php if($search_conditions['status'] == -1):?>selected <?php endif;?>>请选择状态</option>
                             <option value="1" <?php if($search_conditions['status'] == 1):?>selected <?php endif;?> >正常</option>
                             <option value="0"  <?php if($search_conditions['status'] == 0):?>selected <?php endif;?>>已删除</option>
                    </select>
                </div>

				<div class="form-group">
					<div class="input-group">
						<input type="text" name="mix_kw" placeholder="请输入姓名或者手机号码" class="form-control" value="<?=$search_conditions['mix_kw'];?>">
                        <input type="hidden" name="p" value="1">
						<span class="input-group-btn">
                            <button type="button" class="btn btn-primary search">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
					</div>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-lg-12">
					<a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?= UrlService::bulidWwwUrl("account/set");?>">
						<i class="fa fa-plus"></i>账号
					</a>
				</div>
			</div>
		</form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>序号</th>
                <th>姓名</th>
                <th>手机</th>
                <th>用户类型</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $_item):?>
                <tr>
                    <td><?= $_item['uid'];?></td>
                    <td><?= $_item['login_name'];?></td>
                    <td><?= $_item['mobile'];?></td>
                    <?php if($_item['user_type'] == 1): ?>
                        <td>管理员</td>
                    <?php else:?>
                        <td>用户</td>
                    <?php endif;?>
                    <td>
                        <a class="m-l" href="<?= UrlService::bulidWebUrl("/account/set",["uid" => $_item['uid']])?>">
                            <i class="fa fa-edit fa-lg"></i>
                        </a>
                    <?php if($_item['status']):?>
                        <a class="m-l remove" href="javascript:void(0);" data="<?=$_item['uid'];?>">
                            <i class="fa fa-trash fa-lg"></i>
                        </a>
                    <?php else:?>
                        <a class="m-l recover" href="javascript:void(0);" data="<?=$_item['uid'];?>">
                            <i class="fa fa-rotate-left fa-lg"></i>
                        </a>
                    <?php endif;?>
                    </td>
                </tr> 
                <?php endforeach; ?>   
            </tbody>
        </table>
	<div class="row">
	   <div class="col-lg-12">
		<span class="pagination_count" style="line-height: 40px;">共<?=$pages['total_count'];?>条记录 | 每页<?=$pages['page_size'];?>条</span>
		<ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
			<?php for($_page = 1; $_page <= $pages['total_page']; $_page++): ?>
                <?php if($_page == $pages['p']):?>
                     <li class="active">
                        <a href="<?= UrlService::bulidNullUrl();?>"><?=$_page;?></a>
                    </li>
                <?php else:?>
                     <li >
                        <a href="<?= UrlService::bulidWebUrl("/account/index",['p' => $_page]);?>"><?=$_page;?></a>
                    </li>
                <?php endif;?>
                   
        <?php endfor;?>
        </ul>
	   </div>
    </div>	
    </div>
</div>




