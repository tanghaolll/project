<?php
namespace app\modules\web\controllers\common;
use app\common\components\BaseWebController;
use app\models\User;
use app\common\services\UrlService;
use Yii;
class BaseController extends BaseWebController
{
	
	public $allowAllAction = [
		"/"
	];


	 public function beforeAction($action){

	 	$is_login = $this->checkLoginStatus();

	 	if(in_array($action->getUniqueId(), $this->allowAllAction)){
	 		return true;
	 	}
		if(!$is_login){
			if(\Yii::$app->request->isAjax){
				$this->renderJson([],"未登录，请先登陆",-302);
			}else{
				$this->redirect(UrlService::bulidWwwUrl("/"));
			}
			return false;
		}
		return true;

	 }

	 public function roel_mobile () {
		$cookies = Yii::$app->request->cookies;
		$language = $cookies->get('user', '');
		$login_pwd = substr($language, 0,32);
		$uid = substr($language, -1,1);
		$user = User::find()->where(['login_pwd'=> $login_pwd,'uid'=>$uid ])->asArray()->one();
		
		 return $user['mobile'];	 
	}
	 public function roel_name () {
		$cookies = Yii::$app->request->cookies;
		$language = $cookies->get('user', '');
		$login_pwd = substr($language, 0,32);
		$uid = substr($language, -1,1);
		$user = User::find()->where(['login_pwd'=> $login_pwd,'uid'=>$uid ])->asArray()->one();
		
		 return $user['login_name'];	 
	}
	 public function roel_status () {
		$cookies = Yii::$app->request->cookies;
		$language = $cookies->get('user', '');
		$login_pwd = substr($language, 0,32);
		$uid = substr($language, -1,1);
		$user = User::find()->where(['login_pwd'=> $login_pwd,'uid'=>$uid ])->asArray()->one();
		
		 return $user['status'];	 
	}
	 public function checkLoginStatus(){
		$auth_cookie = $this->getCookie('user',"");
		if(!$auth_cookie){
			return false;
		}
		$uid = substr($auth_cookie, -1);
		$user_info = User::find()->where(['uid' => $uid])->one();
		if(!$user_info || $user_info['status'] == 0){
			return false;
		}
		return true;
	}
}