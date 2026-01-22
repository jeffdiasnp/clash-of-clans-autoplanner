<?php
// Caminhos dos arquivos
$jsonFile = __DIR__ . '/../clash-of-clans-data/output/raw.json';
$dbFile = __DIR__ . '/../database.sqlite';

// Lê o JSON
// Lê e decodifica o JSON
$json = file_get_contents($jsonFile);
$data = json_decode($json, true);

if (!$data) {
    die("Erro ao ler ou decodificar o arquivo JSON\n");
}

// Imprime os cabeçalhos de primeiro nível
echo "Chaves de primeiro nível:\n";
print_r(array_keys($data));

// Tenta imprimir um resumo dos dados de cada chave
foreach ($data as $key => $value) {
    echo "\nResumo da chave '$key':\n";
    if (is_array($value)) {
        if (isset($value[0])) {
            // Se for uma lista, mostra as chaves do primeiro item
            print_r(array_keys($value[0]));
        } else {
            // Se for um objeto associativo
            print_r(array_keys($value));
        }
    } else {
        echo gettype($value) . "\n";
    }
}

// Opcional: imprime um exemplo de item de cada lista
foreach ($data as $key => $value) {
    if (is_array($value) && isset($value[0])) {
        echo "\nExemplo de item em '$key':\n";
        print_r($value[0]);
    }
}
echo "\n--- Fim da análise do JSON ---\n";
