<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        session_start();
        include_once "formdossier.php";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include_once "modelodedados.php";
        $emprestimo = new DossierEmprestimo($_POST['nome'],$_POST['despasas'],$_POST['credito'], $_POST['nprest']);
        $_SESSION['emprestimo'] = $emprestimo;
        include_once "vistadossier.php";
    }