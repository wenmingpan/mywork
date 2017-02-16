<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
/**
 * Description of Account
 *
 * @author Administrator
 */
class Account extends Controller{
    //put your code here
    public function index()
    {
        $users = Db::table('user')->select();
        $total = Db::table('user')->count();
        
        $this->assign('users',$users);
        $this->assign('total',$total);
        return view();
    }
    
    public function add()
    {
        return view();
    }
    
    public function doadd()
    {
        // 添加入库
        if (Request::instance()->isPost()) {
            $params = Request::instance()->param();

            $name = $params['name'];
            $email = $params['email'];
            $status = $params['status'];
            $data = [
                'name' => $name,
                'email' => $email,
                'status' => $status,
                'created_time' => time(),
                'updated_time' => time(),
                ];
            $res = Db::table('user')->insert($data);
//            $userid = Db::table('user')->getLastInsID();
            if($res) {     
                dwz_ajax_do(200, '添加成功', 'account');
            } else {
                dwz_ajax_do(300, '添加失败', 'account');
            }
        }
    }
    
}
