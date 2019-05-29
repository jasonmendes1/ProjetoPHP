<?php
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
        \Tracy\Debugger::barDump($game);

        $card = new Card(7);
        $result = $game->askForCard($card);
        //\Tracy\Debugger::barDumb($result, "Carta Pedida");

        return View::make('game.gui', ['game' => $game]);
    }
}