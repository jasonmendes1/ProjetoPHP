<?php
/**
 * Created by PhpStorm.
 * User: Noone
 * Date: 23/05/2019
 * Time: 16:45
 */
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;

class GameController extends BaseController {

    function index()
    {
        //Create new game engine
        $game = new FishGameEngine();
        //\Tracy\Debugger::barDump($game);

        $game->

        return View::make('game.gui', ['game' => $game]);
    }
}