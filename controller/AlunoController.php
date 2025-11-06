<?php
    require("../vendor/autoload.php");
    session_start();

    if(empty($_SESSION['alunoLogado']) || $_SESSION['alunoLogado'] == false) {
        header('location: ./LoginController.php');
    }
    if(!empty($_GET['Logout'])){
        $_SESSION['alunoLogado'] = false;
        $_SESSION['profLogado'] = false;
        header('Location: ../index.php');
    }

     require('../View/AlunoView.php');