<?php
/**
 * Created by PhpStorm.
 * User: Tiago Antunes
 * Date: 09/05/2019
 * Time: 17:08
 */
include_once'../views/LoginController.phtml';

class index
{

}

function checklogin($username,$password)
{
    if($username == $_SESSION['username'] && $password == $_SESSION['password'])
    {
        header('Location: GameView.phtml');
        exit();
    }
}