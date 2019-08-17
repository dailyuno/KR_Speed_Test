<?php
    require_once 'db.php';

    execute('INSERT INTO todo_list (title) VALUES (?)', array($_POST['title']));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;