<?php
/**
 * 14、新的继承第3方类库，模型基类
 * User: Administrator
 * Date: 2018/2/12
 * Time: 21:10
 */

namespace core\lib;
use core\lib\conf;

class medooModel extends  \Medoo\Medoo{
    //初始化，继承pdo应该是就可以直接用手册中的pdo中的方法了
    public function __construct()
    {
        $option = conf::all('database');
        parent::__construct($option);

    }



}