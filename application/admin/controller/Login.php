<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

/**
 * Description of Login
 *
 * @author matt
 */
class Login extends Controller{
    public function index()
    {
        return view('login');
    }

    //put your code here
    public function dologin()
    {
        // 添加入库
        if (Request::instance()->isPost()) {
            $params = Request::instance()->param();
            
            $name = $params['name'];
            $password = $params['password'];
            
            $user = Db::table('user')->where('name', $name)->find();
            $val_password = md5(md5($password.'admin').'admin');
            if ($val_password != $user['password']) {
                Loader::action('Login/index');
            }
            
            $this->redirect('Index/index');
        } else {
            Loader::action('Login/index');
        }
        
    }
}
