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
    	$list = User::find()->orderBy(['uid' => SORT_DESC])->all();


        return $this->render('index',[
            'list'=>$list
        ]);
    }


    //账户添加or编辑
    public function actionSet()
    {
        if(\Yii::$app->request->isGet){
            return $this->render('set');
        }
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
        $has_in = User::find()->where(['login_name' => $login_name])->count();
        if($has_in){
            return $this->renderJson([],"用户名已存在",-1);
        }

        $model_user = new User();
        $model_user->login_name = $login_name;
        $model_user->mobile = $mobile;
        $model_user->login_pwd = md5($login_pwd);
        $model_user->user_type = $user_type;
        $model_user->updated_time = $date_now;
        $model_user->created_time = $date_now;
        $model_user->save(0);
        return $this->renderJson([],"操作成功");

    }
}
