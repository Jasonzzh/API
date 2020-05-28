<?php
require_once('./libs/Controller/commentController.php');
class userController {

    public $conn, $postParams;

    public function init() {
        $this->conn = new commentController();
        $this->postParams = $this->conn->connect();
    }

    /**
     * 注册用户
     * name、id、password、iphone、userPic、autograph
     */
    public function registerUser() {
        $this->init();
        $postParams = json_decode($this->postParams);
        if (!isset($postParams->id)) {
            $this->errPrint('用户id不能为空！');
        } else if (!isset($postParams->name)) {
            $this->errPrint('用户名不能为空！');
        } else if (!isset($postParams->password)) {
            $this->errPrint('密码不能为空！');
        } else {
            $name = $postParams->name;
            $id = $postParams->id;
            $password = $postParams->password;
            $iphone = $postParams->iphone;
            $userPic = $postParams->userPic;
            $autograph = $postParams->autograph;
            $sql = M('users')->searchUser($id);
            $result = M('mysql')->query($this->conn->conn, $sql);
            if (sizeof($result)) {
                $this->errPrint('用户id已经被占用！');
            } else {
                $sql = M('users')->addUser($name, $id, $password, $iphone, $userPic, $autograph);
                $result = M('mysql')->query($this->conn->conn, $sql);
                $response = array('code' => 200,'msg' => '操作成功!','data' => $result);
                print json_encode($response);
            }
        }
    }

    /**
     * 异常输出
     */
    public function errPrint($msg) {
        $response = array('code' => 400,'msg' => $msg);
        print json_encode($response);
    }

}