<?php

function vigenere_encrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    
    $keyIndex = 0;
    $keyLength = strlen($key);
    $textLength = strlen($text);
    $encryptedText = "";

    for ($i = 0; $i < $textLength; $i++) {
        if ($text[$i] != ' ') {
            $textCharCode = ord($text[$i]) - ord('A');
            $keyCharCode = ord($key[$keyIndex]) - ord('A');
            
            $newCharCode = ($textCharCode + $keyCharCode) % 26;
            $encryptedText .= chr($newCharCode + ord('A'));
            
            $keyIndex = ($keyIndex + 1) % $keyLength;
        } else {
            $encryptedText .= ' ';
        }
    }

    return $encryptedText;
}

function vigenere_decrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    
    $keyIndex = 0;
    $keyLength = strlen($key);
    $textLength = strlen($text);
    $decryptedText = "";

    for ($i = 0; $i < $textLength; $i++) {
        if ($text[$i] != ' ') {
            $textCharCode = ord($text[$i]) - ord('A');
            $keyCharCode = ord($key[$keyIndex]) - ord('A');
            
            $newCharCode = ($textCharCode - $keyCharCode + 26) % 26;
            $decryptedText .= chr($newCharCode + ord('A'));
            
            $keyIndex = ($keyIndex + 1) % $keyLength;
        } else {
            $decryptedText .= ' ';
        }
    }

    return $decryptedText;
}

#Teste

echo "Digite o texto a ser cifrado/decifrado: ";
$text = trim(fgets(STDIN));

echo "Chave: (key): ";
$key = (int)trim(fgets(STDIN));

echo "Operação (c/d): ";
$operacao = trim(fgets(STDIN));

if ($operacao === 'c') {
    $encryptedText = vigenere_encrypt($text, $key);
    echo "Texto cifrado: $encryptedText\n";
} elseif ($operacao === 'd') {
    $decryptedText = vigenere_decrypt($text, $key);
    echo "Texto decifrado: $decryptedText\n";
} else {
    echo "Operação não reconhecida.\n";
}