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
}
