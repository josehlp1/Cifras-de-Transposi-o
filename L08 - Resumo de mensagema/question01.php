<?php
$caminhoDoArquivo = $argv[1];

if (!file_exists($caminhoDoArquivo)) {
    echo "Erro: O arquivo não existe.\n";
    exit(1);
}

$conteudoDoArquivo = file_get_contents($caminhoDoArquivo);

$hash = md5($conteudoDoArquivo);

echo "MD5 do arquivo: $hash\n";
?>
