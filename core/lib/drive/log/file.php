<?php
/**
 * 驱动方式：以文件形式存储
 * User: Administrator
 * Date: 2018/2/13
 * Time: 17:26
 */

namespace core\lib\drive\log;

use core\lib\conf;

class file{
    public $path;   //日志的存储位置

    public function __construct()
    {
        $con = conf::get('option','log');
        $this->path = $con['path'];
    }

    /**
     * 工厂模式的思想。在配置文件中选择驱动方式。在不同的驱动中写各自逻辑
     * 如果需要添加驱动文件，直接加个驱动文件和在日志的配置文件修改下就可以
     * @param $message
     * @param string $file 存的日志，叫什么名称
     */
    public function log($message,$file = 'log'){
        /**
         * 1、确定存储文件的目录，是否存在。不存在新建
         * 2、写入日志
         */

        if(!is_dir($this->path.date('YmdH'))){
            mkdir($this->path.date('YmdH'),'0777',true);
        }

        return file_put_contents($this->path.date('YmdH').'/'.$file.'.php',date('Y-m-d H:i:s').json_encode($message).PHP_EOL,FILE_APPEND);  //有时候会传数组，所以用json压下
    }
}


