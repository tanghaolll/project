<?php

namespace app\modules\web\controllers;

use yii\web\Controller;
use  app\modules\web\controllers\common\BaseController;
use app\models\Product;

/**
 * Default controller for the `web` module
 */
class ProductController extends BaseController
{
    
    public function __construct($id,$module,array $config = []){
        parent::__construct($id,$module,$config);
        $this->layout = "main";
    }
 	//账户列表
   public function actionIndex(){
   		$p = intval($this->get("p",1));
   		$page_size = 50;
   		$count = Product::find()->count();
   		$page_count = ceil($count / $page_size);
   		$mix_kw = trim($this->get("mix_kw",""));
   		$query = Product::find();
   		  if($mix_kw){
            
            $query->Where(['LIKE','product','%'.$mix_kw.'%',false]);
        }
   		$list =$query->offset(($p-1) * $page_size)->limit($page_size)->orderBy(['pid'=>SORT_DESC])->all();

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
   		$pid = intval($this->get("pid",""));
   		$info = [];
   		if($pid){
                $info = Product::find()->where(['pid'=>$pid])->one();
            }
   		return $this->render('set',['info' =>$info]);
   	}
   	$product = trim($this->post("product",""));
   	$date_now = date("Y-m-d H:i:s");
     $pid = intval($this->post("pid",""));
   	 if(mb_strlen($product,"utf-8") < 1){
            return $this->renderJson([],"产品名称不能为空",-1);
        }
     $has_in = Product::find()->where(['product' => $product])->andWhere(['!=','pid',$pid])->count();

      if($has_in){
            return $this->renderJson([],"产品名称已存在",-1);
        }
     
     $info = Product::find()->where(['pid'=>$pid])->one();

        if($info){
            $model_product = $info;
            $model_product->updated_time = $date_now;
        }else{
             $model_product = new Product();
             $model_product->created_time = $date_now;

        }
  	    $model_product->product = $product;
  	    $model_product->save(0);
        return $this->renderJson([],"操作成功");
   
   }

   public function actionOps(){

   		if(!\Yii::$app->request->isPost){
            return $this->renderJson([],"系统繁忙请稍后再试",-1);
        }
        $pid = intval($this->post("pid",0));
        $act = trim($this->post("act",""));
        if(!$pid){
            return $this->renderJson([],"请选择要操作的账号",-1);
        }

        if(!in_array($act, ["remove"])){
            return $this->renderJson([],"操作有误请重试",-1);
        }
        $product_info  = Product::find()->where(['pid' => $pid])->one();
        if(!$product_info){
            return $this->renderJson([],"操作有误请重试",-1);
        }
        switch ($act) {
            case 'remove':
				$product_info->delete();
                break;
        }
        return $this->renderJson([],"操作成功");

   }
}
