<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName@methodActionName
 ****************************************************************************/

Router::get('/',			    'HomeController/index');
Router::get('home/',		    'HomeController/index');
Router::get('home/index',	    'HomeController/index');
Router::get('home/start',	    'HomeController/start');
Router::get('home/about',	    'HomeController/about');
Router::get('game/gui',         'GameController/index');
                                 /*Login / Register */
Router::get('home/login',       'LoginController/login');

Router::get('user/index',       'UserController/index');
Router::get('user/create',      'UserController/create');
Router::get('user/show',        'UserController/show');
Router::get('user/edit',        'UserController/edit');

Router::resource('user', 'UserController');




















/************** End of URLEncoder Routing Rules ************************************/