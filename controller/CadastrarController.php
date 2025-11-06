<?php
    require('../conexao.php');
    require('../model/Aluno.php');
    session_start();

    $bd = Conexao::get();

    $usuarioExiste = false;
    $mensagemErro = '';
    $mensagemCadastro = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(!empty($_POST['nome']) && !empty($_POST['senha']) && !empty($_POST['dataNascimento']) && !empty($_POST['usuario'])){

            $query = $bd->prepare("SELECT * FROM aluno");
            $query->execute();
            $resultados = $query->fetchAll(PDO::FETCH_CLASS, Aluno::class);
            foreach($resultados as $aluno){
                if($aluno->nome_usuario == $_POST['usuario']){
                    $mensagemErro = 'nome de usuario ja existe';
                    $usuarioExiste = true;
                }
            }

            $senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $query = $bd->prepare("INSERT INTO aluno (nome,data_nascimento,nome_usuario,senha,sexo) VALUES (:nome, :data_nascimento, :nome_usuario, :senha, :sexo)");
            
            $query->bindParam(':nome', $_POST['nome']);
            $query->bindParam(':data_nascimento', $_POST['dataNascimento']);
            $query->bindParam(':nome_usuario', $_POST['usuario']);
            $query->bindParam(':senha', $senhaHash);
            $query->bindParam(':sexo', $_POST['sexo']);

            if(!$usuarioExiste){
                $query->execute();
                $mensagemCadastro = 'usuario cadastrado com sucesso';
            }
        }else{
            $mensagemErro = 'Erro!!! Nao deixe nenhum campo em nulo';
        
        }
    }
    if(!empty($_GET['voltarCadastrar'])){
        header('location: ../index.php');
    }

    require('../View/CadastrarAlunoView.php');
?>