<?php

class FishGameEngine {
    private $_playerHand;
    private $_botHand;
    private $_playerPoints = 0;
    private $_botPoints = 0;
    private $_playerTurn = true;
    private $_deck;

    public function __construct(){
        $this->_deck = new Deck();
        $this->initHands(4);
    }

    private function initHands($startingCardCount) {
        $this->_playerHand = new Hand($this->_deck->dealCards($startingCardCount));
        $this->_botHand = new Hand($this->_deck->dealCards($startingCardCount));
    }

    public function getPlayerHand() {
        return $this->_playerHand->getHand();
    }

    public function addCardsToHand(array $cards) {
        if ($this->_playerTurn) {
            $this->_playerHand->addCardsToHand($cards);
        } else {
            $this->_botHand->addCardsToHand($cards);
        }
    }
        

    /**
     * Recebe uma carta, procura na mão por cartas com o mesmo valor
     * remove-as caso existam e retorna um vetor com as cartas removidas
     * @param Card $card
     * @return array
     */
    public function askForCard(Card $card) : array {
        if ($this->_playerTurn)
            return $this->_botHand->askCardsInHand($card);
        else
            return $this->_playerHand->askCardsInHand($card);
    }

    public function goFish() {
        $card = $this->_deck->dealCards(1)[0];
        if ($card == null)
            return;

        if ($this->_playerTurn) {
            $this->_playerHand->addCardsToHand([$card]);
        } else {
            $this->_botHand->addCardsToHand([$card]);
        }
    }

    public function changeCurrentPlayer() {
        $this->_playerTurn = !$this->_playerTurn;
    }

    public function countCardsInDeck()
    {
        //return $this->_deck->getCurrentDeckSize();
        //return count($this->_deck);
        return 'Teste';
    }

    
    public function getBotCardCount() {
        return count($this->_botHand->getHand());
    }

    public function makeBotPlay() {
        $arrayConta = [];
        $numCards = $this->getBotCardCount();
        $factorAmplificacao  = 5;
        $peso1 = (100/$numCards);

        foreach ($this->_botHand->getHand() as $cardInHand){
                if(array_key_exists((string)$cardInHand, $arrayConta)){
                    $arrayConta[(string)$cardInHand]++;
                }else {
                    $arrayConta[(string)$cardInHand] = 1;
                }
        }
        $roleta = [];
        $i = 0;
        $contaAnterior = 0;
        foreach ($arrayConta as $contaKey => $valueConta) {

            if($i == 0) {
                $roleta[$i] = $valueConta * $peso1 * $factorAmplificacao;
            } else{
                $roleta[$i] = ($valueConta * $peso1 * $factorAmplificacao) + $contaAnterior;
            }

            $contaAnterior += $valueConta * $peso1 * $factorAmplificacao;
            $i++;
        }
        $numRand = rand(0,$roleta[$i-1  ]);
        $iterator = 0;
        foreach($roleta as $item) {
            if($numRand < $item){
                if($iterator != 0){
                    if ($roleta[$iterator-1] > $numRand){
                        break;
                    }
                } else {
                    break;
                }
            }

            $iterator++;
        }

        if($iterator==0){
            $iterator=1;
        }
        $j = 0;
        foreach ($arrayConta as $key => $value) {
            if ($j == $iterator-1) {
                return $key;
            }
            $j++;
        }
        return -1;
    }
}