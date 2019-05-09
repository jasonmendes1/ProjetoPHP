<?php
/**
 * Created by PhpStorm.
 * User: Tiago Antunes
 * Date: 11/04/2019
 * Time: 17:26
 */
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;

class PlanoController extends BaseController
{
    public function index(){
        return View::make('plano.index');
    }

    public function show(){
        $nome = POST::get('nome');
        $despesa = POST::get('desp');
        $credito = POST::get('credito');
        $numPrest = POST::get('numPrest');

        $de = new DossierEmprestimo($nome,$despesa,$credito,$numPrest);
    }
}