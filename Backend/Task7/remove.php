<?php
    require_once 'db.php';

    execute('DELETE FROM todo_list WHERE id = ?', array($_GET['id']));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;