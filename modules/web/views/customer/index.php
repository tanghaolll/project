<?php
use app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/web/customer/index.js",app\assets\WebAsset::className());
?>
<div class="row  border-bottom">
	<div class="col-lg-12">
		<div class="tab_title">
			<ul class="nav nav-pills">
				<li  class="current"  >
					<a href="<?=UrlService::bulidWebUrl("/customer/index")?>">客户列表</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="form-group"  style="width: 250px;">
                        <div class="input-group">
                            <input type="text" name="mix_kw" placeholder="请输入姓名" class="form-control" value="<?=$mix_kw;?>">
                            <input type="hidden" name="p" value="<?=$pages['p']?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary search">
                                    <i class="fa fa-search"></i>搜索
                                </button>
                            </span>
                        </div>
            </div>
        </form>
        <div class="row m-t">
            <div class="col-lg-12">
                <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?=UrlService::bulidWebUrl("/customer/set")?>">
                    <i class="fa fa-plus"></i>添加客户
                </a>
            </div>
        </div>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>客户ID</th>
                <th>客户名称</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            	<?php foreach($list as $_item):?>
                <tr>
                    <td><?=$_item['cid'];?></td>
                    <td><?=$_item['cust_name'];?></td>
                    <td><?=$_item['created_time'];?></td>
                    <td>
                        <a class="m-l" href="<?=UrlService::bulidWebUrl("/customer/set",["cid" => $_item['cid']])?>">
                            <i class="fa fa-edit fa-lg"></i>
                        </a>
                        <a class="m-l remove" href="javascript:void(0);" data="<?=$_item['cid'];?>">
                            <i class="fa fa-trash fa-lg"></i>
                        </a>
                    </td>
                </tr> 
                <?php endforeach;?>        
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
                    <?php if($mix_kw):?>
                     <li >
                        <a href="<?= UrlService::bulidWebUrl("/customer/index",['p' => $_page,'mix_kw'=>$mix_kw]);?>"><?=$_page;?></a>
                    </li>
                    <?php else:?>
                        <li >
                        <a href="<?= UrlService::bulidWebUrl("/customer/index",['p' => $_page]);?>"><?=$_page;?></a>
                    </li> 
                    <?php endif;?>
                <?php endif;?>  
       			 <?php endfor;?>
	</div>
</div>	</div>
</div>




