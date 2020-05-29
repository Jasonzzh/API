<?php
class aboutMeModel {

    function findAllData() {
        $sql = "select * from aboutMe";
        return $sql;
    }
}