<?php
$caminhoDoArquivo = $argv[1];
$hashEsperado = $argv[2];

if (!file_exists($caminhoDoArquivo)) {
    echo "Erro: O arquivo não existe.\n";
    exit(1);
}

// Lendo o conteúdo do arquivo
$conteudoDoArquivo = file_get_contents($caminhoDoArquivo);

// Gerando o hash MD5 do conteúdo do arquivo
$hashCalculado = md5($conteudoDoArquivo);

if ($hashCalculado === $hashEsperado) {
    echo "O arquivo é íntegro.\n";
} else {
    echo "O arquivo não é íntegro.\n";
    echo "Hash calculado: $hashCalculado\n";
    echo "Hash esperado: $hashEsperado\n";
}
?>
