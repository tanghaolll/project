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
   		$mix_kw = trim($this->get("mix_kw",""));
   		$query = Customer::find();
   		  if($mix_kw){
            
            $query->Where(['LIKE','cust_name','%'.$mix_kw.'%',false]);
        }
   		$list =$query->offset(($p-1) * $page_size)->limit($page_size)->orderBy(['cid'=>SORT_DESC])->all();

   	 	 return $this->render('index',[
            'list'=>$list,
            'pages' => [
                'total_count' => $count,
                'page_size' => $page_size,
                'total_page' =>$page_count,
                'p' => $p
            ],
            'mix_kw'=>$mix_kw

        ]);
   }
   public function actionSet(){

   	if(\Yii::$app->request->isGet){
   		$cid = intval($this->get("cid",""));
   		$info = [];
   		if($cid){
                $info = Customer::find()->where(['cid'=>$cid])->one();
            }
   		return $this->render('set',['info' =>$info]);
   	}
    $cid = intval($this->post("cid",""));
   	$cust_name = trim($this->post("cust_name",""));
   	$date_now = date("Y-m-d H:i:s");
   	 if(mb_strlen($cust_name,"utf-8") < 1){
            return $this->renderJson([],"客户名不能为空",-1);
        }
     $has_in = Customer::find()->where(['cust_name' => $cust_name])->andWhere(['!=','cid',$cid])->count();

      if($has_in){
            return $this->renderJson([],"客户名已存在",-1);
        }

      $cid = intval($this->post("cid",""));
     $info = Customer::find()->where(['cid'=>$cid])->one();
        if($info){
            $model_customer = $info;

        }else{
             $model_customer = new Customer();
             $model_customer->created_time = $date_now;

        }
	       $model_customer->cust_name = $cust_name;
	       $model_customer->save(0);
        return $this->renderJson([],"操作成功");
   
   }

   public function actionOps(){

   		if(!\Yii::$app->request->isPost){
            return $this->renderJson([],"系统繁忙请稍后再试",-1);
        }
        $cid = intval($this->post("cid",0));
        $act = trim($this->post("act",""));
        if(!$cid){
            return $this->renderJson([],"请选择要操作的账号",-1);
        }

        if(!in_array($act, ["remove"])){
            return $this->renderJson([],"操作有误请重试",-1);
        }
        $customer_info  = Customer::find()->where(['cid' => $cid])->one();
        if(!$customer_info){
            return $this->renderJson([],"操作有误请重试",-1);
        }
        switch ($act) {
            case 'remove':
				$customer_info->delete();
                break;
        }
        return $this->renderJson([],"操作成功");

   }
}
