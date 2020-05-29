<?php
require_once('./libs/Controller/commonController.php');

class userController {

    public $common;

    public function init() {
        $this->common = new commonController();
        $this->common->connect();
    }

    /**
     * 注册用户
     * name、id、password、iphone、userPic、autograph
     */
    public function registerUser() {
        $this->init();
        $postParams = json_decode($this->common->postParams);
        if (empty($postParams->id)) {
            $this->common->errPrint('用户id不能为空！');
        } else if (empty($postParams->name)) {
            $this->common->errPrint('用户名不能为空！');
        } else if (empty($postParams->password)) {
            $this->common->errPrint('密码不能为空！');
        } else {
            $name = $postParams->name;
            $id = $postParams->id;
            $password = $postParams->password;
            $iphone = $postParams->iphone;
            $userPic = $postParams->userPic;
            $autograph = $postParams->autograph;
            $sql = M('users')->searchUser($id);
            $result = M('mysql')->query($this->common->conn, $sql);
            if (sizeof($result)) {
                $this->common->errPrint('用户id已经被占用！');
            } else {
                $sql = M('users')->addUser($name, $id, $password, $iphone, $userPic, $autograph);
                $result = M('mysql')->query($this->common->conn, $sql);
                $response = array('code' => 200,'msg' => '操作成功!','data' => $result);
                print json_encode($response);
            }
        }
    }

}