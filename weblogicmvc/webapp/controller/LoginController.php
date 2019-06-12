<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;


class LoginController extends BaseController{

    function login()
    {
        $login = new LoginController();
        \Tracy\Debugger::barDump($login);

        return View::make('home.login', ['login' => $login]);

        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    
    /*
    function register()
    {
        $register = new LoginController();
        \Tracy\Debugger::barDump($register);
        return View::make('home.register', ['register' => $register]);
        
    }
    */
}