<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
/**
 * Description of Role
 *
 * @author Administrator
 */
class Role extends Controller {
    //put your code here
    public function index()
    {
        $roles = Db::table('role')->select();
        $total = Db::table('role')->count();
        
        $this->assign('roles',$roles);
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
            $status = $params['status'];
            $result = Db::table('role')->where('name',$name)->find();
            if ($result) {
                dwz_ajax_do(300, '已存在', 'role');
            }
            $data = ['name' => $name,
                    'status' => $status,
                    'created_time' => time(),
                    'updated_time' => time(),
                ];
            $res = Db::table('role')->insert($data);
            if($res) {
                dwz_ajax_do(200, '添加成功', 'role');
            } else {
                dwz_ajax_do(300, '添加失败', 'role');
            }
        }
    }
    
    public function delete()
    {
        $params = Request::instance()->param();
        $id = $params['id'];
        
        // 执行删除
        $result = Db::table('role')->where('id', $id)->delete();
        if($result) {
            dwz_ajax_do(200, '删除成功', 'role', '');
        } else {
            dwz_ajax_do(300, '删除失败', 'role', '');
        }
    }
    
    public function edit()
    {
        // 添加入库
        if (Request::instance()->isPost()) {
            $params = Request::instance()->param();

            $id = $params['id'];
            $name = $params['name'];
            $status = $params['status'];
            
            $data = [
                'name' => $name,
                'status' => $status,
                'updated_time' => time(),
                ];
            $updated = Db::table('role')
                    ->where('id', $id)
                    ->update($data);

            if($updated) {     
                dwz_ajax_do(200, '修改成功', 'role');
            } else {
                dwz_ajax_do(300, '修改失败', 'role');
            }
        }
        
        $params = Request::instance()->param();
        $id = $params['id'];
        $role = Db::table('role')->where('id', $id)->find();
        
        $this->assign('role',$role);
        return view();
    }
}
