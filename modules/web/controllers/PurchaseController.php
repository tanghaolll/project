<?php

namespace app\modules\web\controllers;

use yii\web\Controller;
use  app\modules\web\controllers\common\BaseController;
use app\models\Purchase;
/**
 * Default controller for the `web` module
 */
class PurchaseController extends BaseController
{
    
    public function __construct($id,$module,array $config = []){
        parent::__construct($id,$module,$config);
        $this->layout = "main";
    }
 	//账户列表
    public function actionIndex()
    {  
        $p = intval($this->get("p",1));
        $page_size = 50;
        $count = Purchase::find()->count();
        $page_count = ceil($count / $page_size);
        $mix_kw = trim($this->get("mix_kw",""));
         $id = $danhao = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $query = Purchase::find();
          if($mix_kw){
            
            $query->Where(['LIKE','sin_num','%'.$mix_kw.'%',false]);
        }
       
        $list =$query->offset(($p-1) * $page_size)->limit($page_size)->orderBy(['oid'=>SORT_DESC])->all();
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
     public function actionSet()
    {
       
        return $this->render('set');

       }
}
