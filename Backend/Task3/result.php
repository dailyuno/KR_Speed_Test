<?php session_start(); ?>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Calibri;
    }

    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        padding: 20px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>
<h1>
    <?php
    if ($_SESSION['code'] === $_POST['code']) {
        echo 'correct';
    } else {
        echo 'incorrect';
    }
    ?>
</h1>