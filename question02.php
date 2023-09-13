<?php

function cifrar($texto, $numTrilhos) {
    $textoSemEspacos = str_replace(' ', '', $texto);
    $trilhos = array_fill(0, $numTrilhos, '');
    
    $i = 0;
    $inc = 1;
    foreach (str_split($textoSemEspacos) as $char) {
        $trilhos[$i] .= $char;
        if ($i == 0) {
            $inc = 1;
        } elseif ($i == $numTrilhos - 1) {
            $inc = -1;
        }
        $i += $inc;
    }
    
    return implode('', $trilhos);
}

function decifrar($textoCifrado, $numTrilhos) {
    $trilhos = array_fill(0, $numTrilhos, '');
    $trilhoComprimentos = array_fill(0, $numTrilhos, 0);

    $i = 0;
    $inc = 1;
    foreach (str_split($textoCifrado) as $_) {
        $trilhoComprimentos[$i] += 1;
        if ($i == 0) {
            $inc = 1;
        } elseif ($i == $numTrilhos - 1) {
            $inc = -1;
        }
        $i += $inc;
    }

    $index = 0;
    for ($i = 0; $i < $numTrilhos; $i++) {
        $trilhos[$i] = substr($textoCifrado, $index, $trilhoComprimentos[$i]);
        $index += $trilhoComprimentos[$i];
    }

    $textoDecifrado = '';
    $i = 0;
    $inc = 1;
    while ($index > 0) {
        $textoDecifrado .= $trilhos[$i][0];
        $trilhos[$i] = substr($trilhos[$i], 1);
        $index -= 1;
        
        if ($i == 0) {
            $inc = 1;
        } elseif ($i == $numTrilhos - 1) {
            $inc = -1;
        }
        $i += $inc;
    }
    
    return $textoDecifrado;
}

#Teste

echo "Digite o texto a ser cifrado/decifrado: ";
$texto = trim(fgets(STDIN));

echo "Digite o número de trilhos: ";
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

