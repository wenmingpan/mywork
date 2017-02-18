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
    
    public function delete()
    {
        $params = Request::instance()->param();
        $id = $params['id'];
        
        // 执行删除
        $result = Db::table('user')->where('id', $id)->delete();
        if($result) {
            dwz_ajax_do(200, '删除成功', 'account', '');
        } else {
            dwz_ajax_do(300, '删除失败', 'account', '');
        }
    }
    
    public function edit()
    {
        // 添加入库
        if (Request::instance()->isPost()) {
            $params = Request::instance()->param();

            $id = $params['id'];
            $name = $params['name'];
            $email = $params['email'];
            $status = $params['status'];
            $data = [
                'name' => $name,
                'email' => $email,
                'status' => $status,
                'updated_time' => time(),
                ];
            $updated = Db::table('user')
                    ->where('id', $id)
                    ->update($data);

            if($updated) {     
                dwz_ajax_do(200, '修改成功', 'account');
            } else {
                dwz_ajax_do(300, '修改失败', 'account');
            }
        }
        
        $params = Request::instance()->param();
        $id = $params['id'];
        $user = Db::table('user')->where('id', $id)->find();
        
        $this->assign('user',$user);
        return view();
    }
}
