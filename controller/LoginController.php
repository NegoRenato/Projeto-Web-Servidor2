<?php
    require('../conexao.php');
    require('../model/Aluno.php');
    session_start();

    $bd = Conexao::get();

    $mensagemErro = "";
    $loginSucesso = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
            
            $query = $bd->prepare('SELECT nome_usuario,senha FROM aluno WHERE nome_usuario = :nome_usuario');
            $query->bindParam(':nome_usuario', $_POST['usuario']);
            $query->execute();
            $aluno = $query->fetchObject(Aluno::class);

            if ($aluno && password_verify($_POST['senha'], $aluno->senha)) {
                $loginSucesso = true;
                $_SESSION['usuario'] = $aluno->nome_usuario;
            }

            if ($loginSucesso) {
                $_SESSION['alunoLogado'] = true;
                $_SESSION['profLogado'] = false;
                header('Location: ./AlunoController.php');
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

    require('../View/LoginAlunoView.php');