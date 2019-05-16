<?php
/**
 * Created by PhpStorm.
 * User: Tiago Antunes
 * Date: 09/05/2019
 * Time: 17:08
 */

    session_start();
    $_SESSION['username'] = "username";
    $_SESSION['password'] = "password";
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        session_destroy();
        session_start();
        include_once'../views/HomeView.phtml';
    }

class index
{

}

class top10
{

}