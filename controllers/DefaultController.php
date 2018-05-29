<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\common\components\BaseWebController;
use yii\web\Response;
use app\models\User;
use app\common\services\UrlService;

class DefaultController extends BaseWebController
{
   public function actionIndex(){
    
    if(\Yii::$app->request->isGet){
    	$this->layout = false;
    	return $this->render("index");
    }
    $login_name = trim($this->post("login_name",""));
    $login_pwd = trim($this->post("login_pwd",""));
    $auth_pwd = md5($login_pwd);
    if(!$login_name || !$login_pwd){
    	return "<script>alert('请输入正确的用户名和密码-1');window.location.href='/'</script>";
    }
    $user_info = User::find()->where(['login_name' => $login_name])->one();
   		if(!$user_info){
   			return  "<script>alert('请输入正确的用户名和密码-2');window.location.href='/'</script>";
   		}
   	if( $auth_pwd !== $user_info['login_pwd']){
   		return  "<script>alert('请输入正确的用户名和密码-3');window.location.href='/'</script>";
   	}
   	//保存登陆态
   	//uid+pwd
   	$auth_token =$user_info['login_pwd'].$user_info['user_type'].$user_info['uid'];
   	$this->setCookie("user",$auth_token);	
    return $this->redirect(UrlService::bulidWebUrl("/account"));
   }

   public function actionLogout(){
   	$this->removeCookie("user");
   	return $this->redirect(UrlService::bulidwwwUrl("/"));
   }

}
