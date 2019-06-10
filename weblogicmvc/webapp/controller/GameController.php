<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;

class GameController extends BaseController {

    
    public function index()
    {
        //Create new game engine
        $game = new FishGameEngine();
        \Tracy\Debugger::barDump($game);
        /*$card = new Card(7);
        $result = $game->askForCard($card);*/
        Session::set('game', $game);
        Session::set('buscarCartasAoDeck',false);
        Session::set('Cartapedida', true);
        //\Tracy\Debugger::barDumb($result, "Carta Pedida");
        return View::make('game.gui');
    }

    public function askcard($id){
        $game = Session::get('game');
        $cardtemp = new Card($id);
        $cards = $game->askForCard($cardtemp);
        if(!empty($cards))
        {
            $game->addCardsToHand($cards);
            if($game->showturn() == true)
            {
                if(GoFishHandEvaluator::checkFish($game->getPlayerHandNotArray()) == true)
                {
                    $game->addPointPlayer();
                    $game->removeCardPlayer($cardtemp);
                }
            }
            else{
                if(GoFishHandEvaluator::checkFish($game->getBotHandNotArray()) == true)
                {
                    $game->addPointBot();
                    $game->removeCardBot($cardtemp);
                }
            }
        }
        else
        {
            Session::set('buscarCartasAoDeck', true); 
        }
        return View::make('game.gui');
    }

    public function botTellCard()
    {
        $game = Session::get('game'); 
        $cartamandada = $game->makeBotPlay();
        \Tracy\Debugger::barDump($cartamandada);
        return View::make('game.gui', ['cartapedidabot' => $cartamandada]);
    }

    public function takeCardFromDeck()
    {
        $game = Session::get('game');
        if($game->countCardsInDeck() > 0)
        {
            $game->goFish();
            $game->changeCurrentPlayer();
        }
        Session::set('buscarCartasAoDeck',false);
        //$game->changeCurrentPlayer();
        $this->botJoga();
        return View::make('game.gui');
    }

    public function botJoga(){
        $game = Session::get('game');
        do{
            $buscarcartadeck = true;
            $cartaPedidaPeloBot = $game->makeBotPlay();
            Session::set('Cartapedida',$cartaPedidaPeloBot);
            //$this->buscarCartaAoPlayer($cartaPedidaPeloBot);
            $playerhand = $game->getPlayerHand();
            $bothand = $game->getBotHand();
            foreach($playerhand as $card)
            {
                if($card->getValue() == $cartaPedidaPeloBot)
                {
                    $playerhand->removeCardsByValue($card);
                    $bothand->addCardsToHand($card);                
                    $buscarcartadeck = false;
                }
            }
        }while($buscarcartadeck = false);
        if($game->countCardsInDeck() > 0)
        {
            $game->goFish();
            $game->changeCurrentPlayer();
        }
        \Tracy\Debugger::barDump($cartaPedidaPeloBot);
    }

    public function buscarCartaAoPlayer($numcard)
    {
        $game = Session::get('game');
        $playerhand = $game->getPlayerHand();
        $bothand = $game->getBotHand();
        foreach($playerhand as $card)
        {
            if($card->getValue() == $numcard)
            {
                $bothand->addCardsToHand($card);
                $playerhand->removeCardsByValue($card);
            }
        }
    }
}