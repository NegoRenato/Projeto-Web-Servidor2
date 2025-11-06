<?php
    require("../vendor/autoload.php");
    session_start();
    if(empty($_SESSION['profLogado']) || $_SESSION['profLogado'] == false) {
        header('location: ./LoginProfController.php');
    }
    require('../View/ProfessorView.php');
    
    if (!isset($_SESSION['professores'])) {
        require('../Model/Professor.php');
        $_SESSION['professores'] = $Professores;
    }

    if(!empty($_GET['Logout'])){
        $_SESSION['alunoLogado'] = false;
        $_SESSION['profLogado'] = false;
        header('Location: ../index.php');
    }
?>