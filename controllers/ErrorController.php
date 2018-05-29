<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\common\components\BaseWebController;
use yii\web\Response;
use yii\log\FileTarget;

class ErrorController extends BaseWebController
{
  public function actionError(){
  	$this->layout = false;
  	 $error = \Yii::$app->errorHandler->exception;
   	//记录错误信息到文件或者数据库
    	$err_msg = '';
   	if($error){

   			$file = $error->getFile();
   			$line = $error->getLine();
   			$code = $error->getCode();
   			$message = $error->getMessage();

   			$log = new FileTarget();
   			$log->logFile = \Yii::$app->getRuntimePath()."/logs/err.log";
   			$err_msg = $message."[file:{$file}][line:{$line}][code:{$code}][url:{$_SERVER['REQUEST_URI']}][POST_DATA：".http_build_query($_POST)."]";
   			$log->messages[] = [
   				$err_msg,
   				1,
   				'application',
   				microtime(true)

   			];
   			$log->export();
		  }
 	// return $err_msg;
		  return $this->render("error",[$err_msg]);
	}
}
