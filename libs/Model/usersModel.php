<?php
class usersModel {
    
    /**
     * 添加用户
     */
    function addUser($name, $id, $password, $iphone, $userPic, $autograph) {
        $sql = 'INSERT INTO user(name, id, password, iphone, userPic, autograph) VALUES('.$name.','.$id.','.$password.','.$iphone.','.$userPic.','.$autograph.')';
        return $sql;
    }

    /**
     * 查询用户
     */
    function searchUser($id) {
        $sql = 'SELECT * FROM user WHERE id = '.$id;
        return $sql;
    }

}