<?php
/**
 * 核心文件
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/12
 * Time: 13:44
 */

namespace core;

class Init{

    public static $classMap = [];    //用来储存已经加载好的类
    public $assign;

    public static function run(){
       $route = new \core\lib\route();  //5、引入路由类
        //o($route);

       //12、启动日志类
        \core\lib\log::init();
        //\core\lib\log::log('111','test'); //存日志

       //7、加载控制器
       $controller = $route->controller;
       $action = $route->action;
       $controllerFilePath = APP.'/controller/'.$controller.'Controller.php';          //文件路径
        //模块（/根目录下的app）/控制器/方法
       $class = '\\'.MODULE.'\controller\\'.$controller.'Controller';   //命名空间。所以反斜杠
       if(is_file($controllerFilePath)){
            include $controllerFilePath;
            $ctrl = new $class();
            $ctrl->$action();
           \core\lib\log::log('ctrl:'.$controller.'---------------'.'action:'.$action); //存日志
       }else{
            throw new \Exception('找不到控制器');
       }


    }

    //4、自动加载
    public static function load($class){

        //4.2、缓存中是否有
        if(isset(self::$classMap[$class])){
            return true;
        }else{
            //4.1、判断要加载的文件是否存在
            $className = str_replace('\\','/',$class);   //将反斜线，转换成正斜线
            $file = GEN.'/'.$className.'.php';          //文件路径
            if(is_file($file)){                         //不存在
                include $file;                          //包含
                self::$classMap[$class] = $className;   //缓存
            }else{
                return false;
            }
        }
    }

    //10、模板赋值传递数据
    public function assign($name,$value){
        $this->assign[$name] = $value;
    }

    //10、调模板
    public function display($file){

        $file = APP.'/views/'.$file;
        //是否是文件
        if(is_file($file)){
            //将传递的数据，放到视图文件中
            //extract($this->assign); //将一维数组打散，将数组中的每一个key变成一个单独的变量
            //include $file;          //包含

            //15、用类库的模板引擎
            $loader = new \Twig_Loader_Filesystem(APP.'/views/'); //传视图目录
            $twig = new \Twig_Environment($loader, array(
                'cache' => GEN.'/log/twig',    //文件缓存目录
                'debug' => DEBUG,              //入口文件中，自己定义的debug常量
            ));
            $template = $twig->loadTemplate('index.html');
            $template->display($this->assign ? $this->assign : '');  //模板赋值
        }


    }
}