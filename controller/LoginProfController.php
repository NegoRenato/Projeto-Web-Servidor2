<?php
    require('../conexao.php');
    require('../model/Professor.php');
    session_start();

    $bd = Conexao::get();

    $mensagemErro = "";
    $loginSucesso = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
            
            $query = $bd->prepare('SELECT nome_usuario,senha FROM professor WHERE nome_usuario = :nome_usuario');
            $query->bindParam(':nome_usuario', $_POST['usuario']);
            $query->execute();
            $professor = $query->fetchObject(Professor::class);

            if ($professor && password_verify($_POST['senha'], $professor->senha)) {
                $loginSucesso = true;
            }
            
            if ($loginSucesso) {
                $_SESSION['alunoLogado'] = false;
                $_SESSION['profLogado'] = true;
                header('Location: ./ProfController.php');
                exit();
            } else {
                $mensagem_erro = "Nome de usuário ou senha inválido!";
            }

        } else {
            $mensagem_erro = "Por favor, preencha todos os campos.";
        }
    }

    if(!empty($_GET['voltarLogin'])){
        header('location: ../index.php');
    }

    require('../View/LoginProfView.php');