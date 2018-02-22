<?php
/**
 * 11、加载配置文件基类
 * User: Administrator
 * Date: 2018/2/13
 * Time: 15:37
 */

namespace core\lib;
class conf{

    public static $conf = [];


    /**
     * 加载配置会经常用到，所以写个方法
     * @param $name 要加载的配置名称
     * @param $file 要加载的配置文件
     */
    public static function get($name,$file){
        //3、属性中有无该配置项的缓存，有就直接返回缓存
        if(isset(self::$conf[$file])){
            return self::$conf[$file][$name];
        }else{
            //echo 1; //测试 是否重复加载了

            //1、判断配置文件是否存在，存在则包含（就是include读取）
            $filePath = CORE.'/confing/'.$file.'.php';
            if(is_file($filePath)){
                $conf = include $filePath;
                //2、判断配置项是否存在，存在就缓存给属性并返回
                if(isset($conf[$name])){
                    self::$conf[$file] = $conf;     //以文件名为key
                    return $conf[$name];
                }else{
                    throw new \Exception('没有'.$name.'配置项');
                }
            }else{
                throw new \Exception('没有'.$filePath.'配置文件');
            }
        }
    }

    /**
     * 加载所有配置文件
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function all($file){
        if(isset(self::$conf[$file])){
            return self::$conf[$file];
        }else{
            //echo 1; //测试 是否重复加载了
            $filePath = CORE.'/confing/'.$file.'.php';
            if(is_file($filePath)){
                $conf = include $filePath;
                self::$conf[$file] = $conf; //就这不一样，把整个文件返回去，就不用判断了
                return $conf;
            }else{
                throw new \Exception('没有'.$filePath.'配置文件');
            }
        }
    }

}