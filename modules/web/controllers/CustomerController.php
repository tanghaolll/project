<?php

namespace app\modules\web\controllers;

use yii\web\Controller;
use  app\modules\web\controllers\common\BaseController;
use app\models\Customer;

/**
 * Default controller for the `web` module
 */
class CustomerController extends BaseController
{
    
    public function __construct($id,$module,array $config = []){
        parent::__construct($id,$module,$config);
        $this->layout = "main";
    }
 	//账户列表
   public function actionIndex(){
   		$p = intval($this->get("p",1));
   		$page_size = 50;
   		$count = Customer::find()->count();
   		$page_count = ceil($count / $page_size);

   		$list = Customer::find()->offset(($p-1) * $page_size)->limit($page_size)->orderBy(['cid'=>SORT_DESC])->all();

   	 	 return $this->render('index',[
            'list'=>$list,
            'pages' => [
                'total_count' => $count,
                'page_size' => $page_size,
                'total_page' =>$page_count,
                'p' => $p
            ]

        ]);
   }
   public function actionSet(){

   	if(\Yii::$app->request->isGet){
   		return $this->render('set');
   	}
   	$cust_name = trim($this->post("cust_name",""));
   	$date_now = date("Y-m-d H:i:s");
   	 if(mb_strlen($cust_name,"utf-8") < 1){
            return $this->renderJson([],"客户名不能为空",-1);
        }
	    $model_customer = new Customer();
	    $model_customer->created_time = $date_now;
	    $model_customer->cust_name = $cust_name;
	    $model_customer->save(0);
        return $this->renderJson([],"操作成功");
   
   }
}
