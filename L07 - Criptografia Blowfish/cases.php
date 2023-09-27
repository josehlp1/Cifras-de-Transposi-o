<?php

$key = "ABCDE";
$method = 'bf-ecb';

function encrypt($text, $method, $key, $iv = null) {
    return openssl_encrypt($text, $method, $key, OPENSSL_RAW_DATA, $iv);
}

function decrypt($cipherText, $method, $key, $iv = null) {
    return openssl_decrypt($cipherText, $method, $key, OPENSSL_RAW_DATA, $iv);
}

// Caso 1
$text = "FURB";
$ciphertext = encrypt($text, $method, $key);
echo "Caso 1:\n";
echo "1.1. " . bin2hex($ciphertext) . "\n";
echo "1.2. " . strlen(bin2hex($ciphertext)) . "\n";

// Caso 2
$text = "COMPUTADOR";
$ciphertext = encrypt($text, $method, $key);
echo "Caso 2:\n";
echo "2.1. " . bin2hex($ciphertext) . "\n";
echo "2.2. " . strlen(bin2hex($ciphertext)) . "\n";

// Caso 3
$text = "SABONETE";
$ciphertext = encrypt($text, $method, $key);
echo "Caso 3:\n";
echo "3.1. " . bin2hex($ciphertext) . "\n";
echo "3.2. " . strlen(bin2hex($ciphertext)) . "\n";

// Caso 4
$text = "SABONETESABONETESABONETE";
$ciphertext = encrypt($text, $method, $key);
echo "Caso 4:\n";
echo "4.1. " . bin2hex($ciphertext) . "\n";
echo "4.2. " . strlen(bin2hex($ciphertext)) . "\n";

// Caso 5 - Usando CBC
$methodCBC = 'bf-cbc';
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($methodCBC));
$text = "FURB";
$ciphertext = encrypt($text, $methodCBC, $key, $iv);
echo "Caso 5:\n";
echo "5.1. " . bin2hex($ciphertext) . "\n";

// Caso 6 - Especificando um IV
$text = "FURB";
$iv = pack('C*', 1, 1, 2, 2, 3, 3, 4, 4);
$ciphertext = encrypt($text, $methodCBC, $key, $iv);
echo "Caso 6:\n";
echo "6.1. " . bin2hex($ciphertext) . "\n";

// Caso 7
$text = "SABONETESABONETESABONETE";
$ciphertext = encrypt($text, $methodCBC, $key, $iv);
echo "Caso 7:\n";
echo "7.1. " . bin2hex($ciphertext) . "\n";

// Caso 8 - Usando um IV diferente
$ivDifferent = pack('C*', 10, 20, 30, 40, 50, 60, 70, 80);
$ciphertextDifferent = encrypt($text, $methodCBC, $key, $ivDifferent);
echo "Caso 8:\n";
echo "8.1. " . bin2hex($ciphertextDifferent) . "\n";

// Compare o texto cifrado com o que foi obtido no caso 7 e apresente uma conclusão.
echo "Comparação entre os Casos 7 e 8:\n";
if (bin2hex($ciphertext) === bin2hex($ciphertextDifferent)) {
    echo "Conclusão: O texto cifrado é o mesmo nos dois casos.\n";
} else {
    echo "Conclusão: O texto cifrado é diferente nos dois casos.\n";
}

// Caso 9 - Tente decifrar com uma chave diferente
$wrongKey = "11111";
$decryptedText = decrypt($ciphertext, $method, $wrongKey);
echo "Caso 9:\n";
if ($decryptedText === false) {
    echo "A decifração falhou com a chave incorreta.\n";
} else {
    echo "Texto decifrado com a chave incorreta: $decryptedText\n";
}

// Caso 10 - Criptografar um arquivo PDF
$pdfPath = './L07 - Criptografia Blowfish.pdf'; // Substitua pelo caminho real do seu arquivo PDF
if (file_exists($pdfPath)) {
    $pdfContent = file_get_contents($pdfPath);
    $encryptedPDF = encrypt($pdfContent, $method, $key);
    file_put_contents('saida.bin', $encryptedPDF);
    echo "Caso 10:\n";
    echo "10.1. " . filesize('saida.bin') . "\n";
} else {
    echo "Caso 10: O arquivo PDF não foi encontrado no caminho especificado.\n";
}

// Caso 11 - Decifrar o arquivo saida.bin
if (file_exists('saida.bin')) {
    $encryptedContent = file_get_contents('saida.bin');
    $decryptedPDF = decrypt($encryptedContent, $method, $key);
    file_put_contents('decriptografado.pdf', $decryptedPDF);
    // Tente abrir o arquivo.
    echo "Caso 11: O arquivo foi decifrado e salvo como decriptografado.pdf\n";
} else {
    echo "Caso 11: O arquivo saida.bin não foi encontrado.\n";
}