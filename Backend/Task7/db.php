<?php

$db = new \PDO('mysql:host=127.0.0.1;dbname=20190826kr_speed_test07;charset=utf8', 'root', 'w8gupk', array(
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING
));

function execute($sql, $params = []) {
    global $db;

    $pstmt = $db->prepare($sql);
    $pstmt->execute($params);
    return $pstmt;
}

function fetch($sql, $params = []) {
    global $db;

    $pstmt = execute($sql, $params);
    return $pstmt->fetch();
}

function fetchAll($sql, $params = []) {
    global $db;

    $pstmt = execute($sql, $params);
    return $pstmt->fetchAll();
}