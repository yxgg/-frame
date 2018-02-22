<?php
/**
 * 9、老的继承pdo的，模型基类。
 * User: Administrator
 * Date: 2018/2/12
 * Time: 21:10
 */

namespace core\lib;
use core\lib\conf;

class pdoModel extends \PDO{
    //初始化，继承pdo应该是就可以直接用手册中的pdo中的方法了
    public function __construct()
    {

        $con = conf::all('db');  //一次加载多个配置文件

        try{
            parent::__construct($con['dns'], $con['username'], $con['passwd']);
        }catch (\PDOException $e){
            o($e->getMessage());
        }

    }



}