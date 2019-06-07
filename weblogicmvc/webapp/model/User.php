<?php

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 17-05-2016
 * Time: 14:16
 */
class User extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('nome'),
        array('username'),
        array('password'),
        array('email'),
        array('datanasc'),
    );


}
