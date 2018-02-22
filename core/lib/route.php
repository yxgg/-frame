<?php
/**
 * 6、路由基类
 * User: Administrator
 * Date: 2018/2/12
 * Time: 13:52
 */

namespace core\lib;
use core\lib\conf;
class Route{

    /**
     * 这俩为啥不用静态属性。
     * 因为用静态的话，在new这个类，变成对象后就不可以使用这俩属性了（如 run()）
     */
    public $controller;
    public $action;

    public  function __construct(){

        /* 1、隐藏入口文件 index.php（nginx在配置文件中修改）
         * 3、返回对应的控制器和方法（都存在属性中了）
         * 2、获取url参数
         * */

        //如果存在，并且不是斜线。就解析url
        if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/'){
            $patharr = explode('/',trim($_SERVER['REQUEST_URI'],'/'));

            //处理非正常情况，如 只输入了一个index
            if(isset($patharr[0])){         //控制器存在
                $this->controller = $patharr[0];
            }
            unset($patharr[0]);
            if(isset($patharr[1])){         //方法存在
                $this->action = $patharr[1];
                unset($patharr[1]);
            }else{
                $this->action = conf::get('action','route');
            }

            //处理url上带的参数。多余的部分转换为get
            $count = count($patharr) + 2;
            $i = 2;
            while($i < $count){
                unset($_GET['s']);
                //如果key+1是奇数，就代表有值(数组没有越界)。否则就直接跳出循环了
                if(isset($patharr[$i + 1])){
                    $_GET[$patharr[$i]] = $patharr[$i + 1];
                }

                $i = $i + 2;
            }

        }else{
            //否则就是index控制器，index方法
            $this->controller = conf::get('controller','route');
            $this->action = conf::get('action','route');
        }

//        o($this->ctrl,1);
//        o($this->action,1);
    }
}