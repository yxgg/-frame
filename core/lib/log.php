<?php
/**
 * 12、日志基类
 * User: Administrator
 * Date: 2018/2/13
 * Time: 17:22
 */

namespace core\lib;
use core\lib\conf;
class log{

    public static $class;
    /*
     * 使用的是工厂模式的思想
     * 1、在初始化方法中，确定日志的存储方式（配置文件中写），读取配置文件，new 好存到属性中
     * 2、通过log方法，自动调用不同的类，进行写日志
     * */

    /**
     * 初始化，用来确定日志的存储方式（如 存数据库，存文件，存缓存）
     * core/lib/drive/log就是用来放日志的各种驱动的
     */
    public static function init(){
        $drive = conf::get('drive','log');  //读日志配置文件
        $class = '\core\lib\drive\log\\'.$drive;        //命名空间
        self::$class = new $class;                      //new 驱动类
    }

    /**
     *
     * @param $msg 要写入的信息
     * @param $file 生成日志的名字
     */
    public static function log($msg,$file = 'log'){
        //调用驱动中的log方法
        self::$class->log($msg,$file);
    }
}