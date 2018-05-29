<?php
use app\common\services\UrlService;
?>

<!DOCTYPE HTML>
<html>
<head>
<title>后台登录</title>
<!-- Custom Theme files -->
<link href="<?= UrlService::bulidWwwUrl("css/style.css");?>" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="后台登录" />

</head>
<body>
<!--header start here-->
<div class="login-form">
			<div class="top-login">
				<span><img src="<?= UrlService::bulidWwwUrl("images/group.png");?>" alt=""/></span>
			</div>
			<h1>登录</h1>
			<div class="login-top">
			<form action="<?= UrlService::bulidWwwUrl("");?>" method="post">
				<div class="login-ic">
					<i ></i>
					<input type="text" name="login_name" value="用户" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'User name';}"/>
					<div class="clear"> </div>
				</div>
				<div class="login-ic">
					<i class="icon"></i>
					<input type="password"  name="login_pwd" value="密码" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'password';}"/>
					<div class="clear"> </div>
				</div>
			
				<div class="log-bwn">
					<input type="submit"  value="Login" >
				</div>
				</form>
			</div>
			<p class="copy">© 2016 xxxxxxxxxxx  <a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
</div>		
<!--header start here-->
</body>
</html>