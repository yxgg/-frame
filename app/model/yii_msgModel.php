<?php
/**
 * 模型类
 * User: Administrator
 * Date: 2018/2/13
 * Time: 22:52
 */

namespace app\model;
use core\lib\medooModel;

class yii_msgModel extends medooModel{

    //思路：给medoo类库中的方法，封装一遍


    public $table = 'yii_msg';

    //【查全部】
    public function lists(){
        return $this->select($this->table,'*');
    }

    //【查单条】
    public function getOne($id){
        return $this->get($this->table,'*',['id'=>$id]);
    }

    //【更新1条】
    public function setOne($id,$data){
        //$last_user_id = $model->insert("yii_msg", ["msg" => "测试",]);
        return $this->update($this->table,$data,['id'=>$id]);
    }

    //【删除1条】
    public function delOne($id){
        return $this->delete($this->table, ['id'=>$id]);
    }
}