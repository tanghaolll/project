<?php

namespace app\modules\web\controllers;

use yii\web\Controller;
use  app\modules\web\controllers\common\BaseController;
use app\models\User;
/**
 * Default controller for the `web` module
 */
class AccountController extends BaseController
{
    
    public function __construct($id,$module,array $config = []){
        parent::__construct($id,$module,$config);
        $this->layout = "main";
    }
 	//账户列表
    public function actionIndex()
    {
        $status = intval($this->get("status",-1));

        $mix_kw = trim($this->get("mix_kw",""));
        $p = intval($this->get("p",1));

        $query = User::find();
        if($status > -1){
          
           $query->andWhere(['status' => $status]);
        
        }

        if($mix_kw){
            $where_logname = ['LIKE','login_name','%'.$mix_kw.'%',false]; 
            $where_mobile = ['LIKE','mobile','%'.$mix_kw.'%',false];
            $query->andWhere(['OR',$where_logname,$where_mobile]);
        }
        $page_size = 50;
        $total_res_count = $query->count();
        $total_page = ceil($total_res_count / $page_size);

    	$list = $query->orderBy(['uid' => SORT_DESC])->offset(($p-1) * $page_size)->limit($page_size)->all();

        
        return $this->render('index',[
            'list'=>$list,
            'search_conditions' => [
                'mix_kw' => $mix_kw,
                'status' => $status,
                'p' => $p
            ],
            'pages' => [
                'total_count' => $total_res_count,
                'page_size' => $page_size,
                'total_page' =>$total_page,
                'p' => $p
            ]
            
        ]);
    }


    //账户添加or编辑
    public function actionSet()
    {
        if(\Yii::$app->request->isGet){
            $id = intval($this->get("uid",0));
            $info = [];
            if($id){
                $info = User::find()->where(['uid'=>$id])->one();
                
            }
            return $this->render('set',['info'=>$info]);
        }
        $id = intval($this->post("id",0));
    	$login_name = trim($this->post("login_name"));
        $mobile = trim($this->post("mobile"));
        $user_type = trim($this->post("user_type"));
        $login_pwd = trim($this->post("login_pwd"));
        $date_now = date("Y-m-d H:i:s");
        if(mb_strlen($login_name,"utf-8") < 1){
            return $this->renderJson([],"请输入符合规范的登陆名",-1);
        }
        if(mb_strlen($login_pwd,"utf-8") < 1){
            return $this->renderJson([],"请输入符合规范的密码",-1);
        }
        $has_in = User::find()->where(['login_name' => $login_name])->andWhere(['!=','uid',$id])->count();
        if($has_in){
            return $this->renderJson([],"用户名已存在",-1);
        }
        $info = User::find()->where(['uid'=>$id])->one();

        if($info){
            $model_user = $info;
        }else{
             $model_user = new User();
             $model_user->created_time = $date_now;

        }
       
        $model_user->login_name = $login_name;
        $model_user->mobile = $mobile;
        if($login_pwd != "******"){
            $model_user->login_pwd = md5($login_pwd);
        } 
        $model_user->user_type = $user_type;
        $model_user->updated_time = $date_now;
        $model_user->save(0);
        return $this->renderJson([],"操作成功");

    }

    //恢复和删除
    public function actionOps(){
        if(!\Yii::$app->request->isPost){
            return $this->renderJson([],"系统繁忙请稍后再试",-1);
        }
        $uid = intval($this->post("uid",0));
        $act = trim($this->post("act",""));
        if(!$uid){
            return $this->renderJson([],"请选择要操作的账号",-1);
        }

        if(!in_array($act, ["remove","recover"])){
            return $this->renderJson([],"操作有误请重试",-1);
        }
        $user_info  = User::find()->where(['uid' => $uid])->one();

        if(!$user_info){
            return $this->renderJson([],"操作有误请重试",-1);
        }
        switch ($act) {
            case 'remove':
                $user_info->status = 0;
                break;
            
           case 'recover':
                $user_info->status = 1;
                break;
        }
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);
        return $this->renderJson([],"操作成功");
    }
}
