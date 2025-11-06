<?php
// Ativa a exibição de TODOS os erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Iniciando Teste...</h2>";

// 1. Vamos verificar se o arquivo autoload.php existe
$autoload_path = __DIR__ . '/vendor/autoload.php';
echo "Procurando autoload em: " . $autoload_path . "<br>";

if (!file_exists($autoload_path)) {
    die("<b>ERRO FATAL:</b> O arquivo <code>vendor/autoload.php</code> NÃO FOI ENCONTRADO. Você rodou 'composer install'?");
}

// 2. Se existe, vamos carregá-lo
require($autoload_path);
echo "Arquivo autoload.php carregado com sucesso!<br>";

// 3. Este é o teste final. O PHP consegue "ver" a classe agora?
// (Note o 'Pecee' com 'P' maiúsculo)
$nome_da_classe = 'Pecee\SimpleRouter\SimpleRouter';

if (class_exists($nome_da_classe)) {
    echo "<b>SUCESSO!</b> A classe <code>" . $nome_da_classe . "</code> FOI ENCONTRADA.";
} else {
    echo "<b>FALHA:</b> A classe <code>" . $nome_da_classe . "</code> NÃO FOI ENCONTRADA.<br>";
    echo "Isso significa que o pacote não está instalado ou o autoload do Composer está quebrado.<br>";
    echo "Tente rodar: <code>composer dump-autoload</code> e atualize a página.";
}

die("<br><br>--- Fim do Teste ---");