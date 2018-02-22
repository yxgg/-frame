<?php
/**
 * 公共函数库
 * User: Administrator
 * Date: 2018/2/12
 * Time: 13:38
 */

/* 打印数组或字符串
* @param string $value 要打印的变量
* @param int $now  不填是die的功能
*/
function o($value='',$now=0)
{
    if ($now == 0) {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        exit;
    } elseif ($now == 1) {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}