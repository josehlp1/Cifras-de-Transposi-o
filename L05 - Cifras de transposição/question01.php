<?php
function cifrar($texto, $numColunas) {
    $textoSemEspacos = str_replace(' ', '', $texto);
    $numLinhas = ceil(strlen($textoSemEspacos) / $numColunas);
    
    $matriz = [];
    $index = 0;
    
    for ($i = 0; $i < $numLinhas; $i++) {
        for ($j = 0; $j < $numColunas; $j++) {
            if ($index < strlen($textoSemEspacos)) {
                $matriz[$i][$j] = $textoSemEspacos[$index];
                $index++;
            } else {
                $matriz[$i][$j] = '';
            }
        }
    }
    
    $textoCifrado = '';
    for ($j = 0; $j < $numColunas; $j++) {
        for ($i = 0; $i < $numLinhas; $i++) {
            $textoCifrado .= $matriz[$i][$j];
        }
    }
    
    return $textoCifrado;
}

function decifrar($textoCifrado, $numColunas) {
    $numLinhas = ceil(strlen($textoCifrado) / $numColunas);
    
    $matriz = [];
    $index = 0;

    for ($j = 0; $j < $numColunas; $j++) {
        for ($i = 0; $i < $numLinhas; $i++) {
            if ($index < strlen($textoCifrado)) {
                $matriz[$i][$j] = $textoCifrado[$index];
                $index++;
            } else {
                $matriz[$i][$j] = '';
            }
        }
    }

    $textoDecifrado = '';
    for ($i = 0; $i < $numLinhas; $i++) {
        for ($j = 0; $j < $numColunas; $j++) {
            $textoDecifrado .= $matriz[$i][$j];
        }
    }

    return $textoDecifrado;
}

#Teste

echo "Digite o texto a ser cifrado/decifrado: ";
$texto = trim(fgets(STDIN));

echo "Digite o número de colunas: ";
$numColunas = (int)trim(fgets(STDIN));

echo "Deseja cifrar ou decifrar? (c/d): ";
$operacao = trim(fgets(STDIN));

if ($operacao === 'c') {
    $textoCifrado = cifrar($texto, $numColunas);
    echo "Texto cifrado: $textoCifrado\n";
} elseif ($operacao === 'd') {
    $textoDecifrado = decifrar($texto, $numColunas);
    echo "Texto decifrado: $textoDecifrado\n";
} else {
    echo "Operação não reconhecida.\n";
}
