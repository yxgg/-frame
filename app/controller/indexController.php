<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/12
 * Time: 20:31
 */

namespace app\controller;

//类名和方法名相同，会变成初始化方法。类名 + controller防止变成初始化方法

use app\model\yii_msgModel;

class indexController extends \core\Init{

    /**
     * 操作视图
     */
    public function index(){

        $this->assign('data','我好钟意你~');
        $this->display('test.html');
    }

    /**
     * 获取配置文件
     */
    public function getConf(){
        $tmp = \core\lib\conf::get('controller','route');   //单个
        $tmp1 = \core\lib\conf::all('route');                     //全部
        o($tmp,1);
        o($tmp1,1);
    }

    /**
     * pdo版操作数据库
     */
    public function pdoMysql(){
        //
        $model = new \core\lib\pdoModel();
        $sql = "select * from yii_msg";
        $res = $model->query($sql);
        o($res->fetchAll(),1);
    }

    /**
     * 第3方类库操作数据库
     */
    public function medooMysql(){
        //操作数据库
        $model = new yii_msgModel();
        $res = $model->delOne(11);
        o($res);
    }
}
