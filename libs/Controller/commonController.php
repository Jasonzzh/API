<?php
class commonController {

    public $conn, $postParams;

    /**
     * 数据库连接、参数获取方法
     */

    public function connect() {
        require_once('./config/config.php');
        $this->conn = M('mysql')->connect($config);
        $this->postParams = isset($GLOBALS['HTTP_RAW_POST_DATA'])?$GLOBALS['HTTP_RAW_POST_DATA']:file_get_contents("php://input");
    }

    /**
     * 异常输出方法
     */
    public function errPrint($msg) {
        $response = array('code' => 400,'msg' => $msg);
        print json_encode($response);
    }
    
}