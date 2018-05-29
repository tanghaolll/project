<?php
namespace app\common\services;

use yii\helpers\Url;

//构造连接
class UrlService {

	//构建web所有链接
	public static function bulidWebUrl($path,$params = []){
		$domain_conf = \Yii::$app->params['domain'];
		$path = Url::toRoute(array_merge([$path],$params));
		return $domain_conf['web'].$path;
	}
	
	//构建官网的链接
	public static function bulidWwwUrl($path,$params = []){
		$domain_conf = \Yii::$app->params['domain'];
		$path = Url::toRoute(array_merge([$path],$params));
		return $domain_conf['www'].$path;

	}
	//空链接
	public static function bulidNullUrl(){

		return "javascript:void(0);";                                                                                
	}
	//
	public static function bulidPicUrl($bucket,$image_key){

		$domain_conf = \Yii::$app->params['domain'];
		$upload_conf = \Yii::$app->params['upload'];
		return $domain_conf['www'].$upload_conf[$bucket]."/".$image_key;
	}

}