<?php
    require_once 'vendor/autoload.php';
    use Carbon\Carbon;
    class DossierEmprestimo
    {
        public $data;
        public $nome;
        public $despesas;
        public $credito;
        public $numprestacoes;
        public $planopagamento;

        public function __contructor($nome, $desp, $cred, $numprest)
        {
            $this->nome = $nome;
            $this->data = Carbon::Now();
            $this->despesas = $desp;
            $this->credito = $cred;
            $this->numprestacoes = $numprest;
        }
    }