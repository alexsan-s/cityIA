<?php
include 'node.php';

session_start();
unset($_SESSION['way']);
unset($_SESSION['cost']);

$sol = new Search();


$_SESSION['source'] = $_POST['source'];
$_SESSION['destiny'] = $_POST['destiny'];

$jsonString = file_get_contents('data.json');
$data = json_decode($jsonString, true);


$source = $_SESSION['source'];
$destiny = $_SESSION['destiny'];
$way = [];
$ids = array();

$node = ["CASA DO FIGUREIRO", "CATEDRAL SAO FRANCISCO DE CHEGAS", "CRISTO REDENTOR", "DIOCESE DE TAUBATE", "HORTO MUNICIPAL", "MERCADO MUNICIPAL", "MIRANTE DO QUIRIRIM", "MUSEU DA IMAGEM E DO SOM DE TAUBATE", "MUSEU DA IMIGRACAO ITALIANA", "MUSEU DE HISTORIA NATURAL DE TAUBATE", "MUSEU MAZZAROPI", "MUSEU MONTEIRO LOBATO - SITIO DO PICA-PAU AMARELO", "PARQUE MUNICIPAL", "PARQUE MUNICIPAL JARDIM DAS NACOES", "PARQUE VALE DO ITAIM", "RELOGIO DA CTI", "SANTUARIO DIOCESANO DE SANTA TERESINHA", "SISTEMA EDUCACIONAL DE DESENVOLVIMENTO SOCIAL", "TEATRO METROPOLE"];
$graph = [
    ["CRISTO REDENTOR", "MERCADO MUNICIPAL", "SANTUARIO DIOCESANO DE SANTA TERESINHA"],
    ["DIOCESE DE TAUBATE", "MERCADO MUNICIPAL", "RELOGIO DA CTI", "SANTUARIO DIOCESANO DE SANTA TERESINHA", "TEATRO METROPOLE"],
    ["CASA DO FIGUREIRO", "HORTO MUNICIPAL", "MERCADO MUNICIPAL", "PARQUE VALE DO ITAIM"],
    ["CATEDRAL SAO FRANCISCO DE CHEGAS", "PARQUE MUNICIPAL JARDIM DAS NACOES", "RELOGIO DA CTI", "SANTUARIO DIOCESANO DE SANTA TERESINHA"],
    ["CRISTO REDENTOR", "MERCADO MUNICIPAL", "MUSEU DE HISTORIA NATURAL DE TAUBATE", "PARQUE MUNICIPAL"],
    ["CASA DO FIGUREIRO", "CATEDRAL SAO FRANCISCO DE CHEGAS", "CRISTO REDENTOR", "HORTO MUNICIPAL", "SANTUARIO DIOCESANO DE SANTA TERESINHA", "TEATRO METROPOLE"],
    ["MUSEU DA IMIGRACAO ITALIANA", "PARQUE MUNICIPAL JARDIM DAS NACOES"],
    ["MUSEU DE HISTORIA NATURAL DE TAUBATE", "SISTEMA EDUCACIONAL DE DESENVOLVIMENTO SOCIAL"],
    ["MIRANTE DO QUIRIRIM"],
    ["HORTO MUNICIPAL", "MUSEU DA IMAGEM E DO SOM DE TAUBATE"],
    ["PARQUE VALE DO ITAIM"],
    ["RELOGIO DA CTI"],
    ["HORTO MUNICIPAL", "PARQUE VALE DO ITAIM"],
    ["DIOCESE DE TAUBATE", "MIRANTE DO QUIRIRIM", "RELOGIO DA CTI"],
    ["CRISTO REDENTOR", "MUSEU MAZZAROPI", "PARQUE MUNICIPAL"],
    ["CATEDRAL SAO FRANCISCO DE CHEGAS", "DIOCESE DE TAUBATE", "MUSEU MONTEIRO LOBATO - SITIO DO PICA-PAU AMARELO", "PARQUE MUNICIPAL JARDIM DAS NACOES"],
    ["CASA DO FIGUREIRO", "CATEDRAL SAO FRANCISCO DE CHEGAS", "DIOCESE DE TAUBATE", "MERCADO MUNICIPAL"],
    ["MUSEU DA IMAGEM E DO SOM DE TAUBATE"],
    ["CATEDRAL SAO FRANCISCO DE CHEGAS", "MERCADO MUNICIPAL"],
];

$graph1 = [
    [["CRISTO REDENTOR", 521], ["MERCADO MUNICIPAL", 1003], ["SANTUARIO DIOCESANO DE SANTA TERESINHA", 995]],
    [["DIOCESE DE TAUBATE", 858], ["MERCADO MUNICIPAL", 244], ["RELOGIO DA CTI", 963], ["SANTUARIO DIOCESANO DE SANTA TERESINHA", 765], ["TEATRO METROPOLE", 65]],
    [["CASA DO FIGUREIRO", 565], ["HORTO MUNICIPAL", 2300], ["MERCADO MUNICIPAL", 1020], ["PARQUE VALE DO ITAIM", 1029]],
    [["CATEDRAL SAO FRANCISCO DE CHEGAS", 880], ["PARQUE MUNICIPAL JARDIM DAS NACOES", 1029], ["RELOGIO DA CTI", 704], ["SANTUARIO DIOCESANO DE SANTA TERESINHA", 169]],
    [["CRISTO REDENTOR", 2300], ["MERCADO MUNICIPAL", 2014], ["MUSEU DE HISTORIA NATURAL DE TAUBATE", 270], ["PARQUE MUNICIPAL", 2007]],
    [["CASA DO FIGUREIRO", 1003], ["CATEDRAL SAO FRANCISCO DE CHEGAS", 244], ["CRISTO REDENTOR", 1020], ["HORTO MUNICIPAL", 2014], ["SANTUARIO DIOCESANO DE SANTA TERESINHA", 876], ["TEATRO METROPOLE", 234]],
    [["MUSEU DA IMIGRACAO ITALIANA", 466], ["PARQUE MUNICIPAL JARDIM DAS NACOES", 5062]],
    [["MUSEU DE HISTORIA NATURAL DE TAUBATE", 115], ["SISTEMA EDUCACIONAL DE DESENVOLVIMENTO SOCIAL", 1021]],
    [["MIRANTE DO QUIRIRIM", 466]],
    [["HORTO MUNICIPAL", 270], ["MUSEU DA IMAGEM E DO SOM DE TAUBATE", 115]],
    [["PARQUE VALE DO ITAIM", 1004]],
    [["RELOGIO DA CTI", 429]],
    [["HORTO MUNICIPAL", 2007], ["PARQUE VALE DO ITAIM", 71]],
    [["DIOCESE DE TAUBATE", 1029], ["MIRANTE DO QUIRIRIM", 5062], ["RELOGIO DA CTI", 1015]],
    [["CRISTO REDENTOR", 1029], ["MUSEU MAZZAROPI", 1004], ["PARQUE MUNICIPAL", 71]],
    [["CATEDRAL SAO FRANCISCO DE CHEGAS", 963], ["DIOCESE DE TAUBATE", 704], ["MUSEU MONTEIRO LOBATO - SITIO DO PICA-PAU AMARELO", 429], ["PARQUE MUNICIPAL JARDIM DAS NACOES", 1015]],
    [["CASA DO FIGUREIRO", 995], ["CATEDRAL SAO FRANCISCO DE CHEGAS", 765], ["DIOCESE DE TAUBATE", 169], ["MERCADO MUNICIPAL", 876]],
    [["MUSEU DA IMAGEM E DO SOM DE TAUBATE", 1021]],
    [["CATEDRAL SAO FRANCISCO DE CHEGAS", 65], ["MERCADO MUNICIPAL", 234]],
];
// $node = ["A", "B", "C", "D", "E", "F", "G", "H", "P", "Q", "R", "S"];
// $graph = [
//     [], ["A"], ["A"], ["E", "C", "B"], ["R", "H"], ["G", "C"], [],
//     ["Q", "P"], ["Q"], [], ["F"], ["P", "E", "D"]
// ];

// $graph1 = [
//     [[]],
//     [["A", 65]],
//     [["A", 55]],
//     [["E", 20], ["C", 55], ["B", 62]],
//     [["R", 55], ["H", 80]],
//     [["G", 10], ["C", 20]],
//     [[]],
//     [["Q", 30], ["P", 12]],
//     [["Q", 30]],
//     [[]],
//     [["F", 60]],
//     [["P", 90], ["E", 69], ["D", 40]]
// ];

// $h = [
//     366, 0, 160, 242, 161, 178, 77, 151, 226, 244,
//     241, 234
// ];

if (isset($_POST["amplitude"])) {
    $way = $sol->amplitude($source, $destiny, $node, $graph);
    print_r($way);
} else if (isset($_POST["depth"])) {
    $way = $sol->depth($source, $destiny, $node, $graph);
} else if (isset($_POST["depth_limit"])) {
    $way = $sol->depth_limit($source, $destiny, 4, $node, $graph);
} else if (isset($_POST["iterative_deepening"])) {
    $way = $sol->iterative_deepening($source, $destiny, 4, $node, $graph);
} else if (isset($_POST["bidirectional"])) {
    $temp = $sol->bidirectional($source, $destiny, $node, $graph);
} else if (isset($_POST["unifor_cost"])) {
    $temp = $sol->uniform_cost($source, $destiny, $node, $graph1);
    $way = $temp[0];
    $_SESSION['cost'] = "Custo do Caminho: " . $temp[1];
} else if (isset($_POST["greedy"])) {
    $temp = $sol->greedy($source, $destiny, $node, $graph1, $h);
    $way = $temp[0];
    $_SESSION['cost'] = "Custo do Caminho: " . $temp[1];
} else if (isset($_POST["a_star"])) {
    $temp = $sol->a_star($source, $destiny, $node, $graph1, $h);
    $way = $temp[0];
    $_SESSION['cost'] = "Custo do Caminho: " . $temp[1];
}

if (is_array($way)) {
    $_SESSION['way'] .= "Caminho: ";
    foreach (array_reverse($way) as $key) {
        $_SESSION['way'] .= "$key ";
    }
} else {
    $_SESSION['way'] = $way;
}


foreach ($data as $key => $entry) {
    for ($i = 0; $i < sizeof($entry); $i++) {
        $data[$key][$i]['color'] = "#eee";
    }
}
if (is_array($way)) {
    foreach ($data as $key => $entry) {
        if ($key == "nodes") {
            for ($j = 0; $j < sizeof($way); $j++) {
                for ($i = 0; $i < sizeof($entry); $i++) {
                    if ($data[$key][$i]['label'] == $way[$j]) {
                        array_push($ids, $data[$key][$i]['id']);
                        $data[$key][$i]['color'] = "#00f";
                    }
                }
            }
        }
        if ($key == "edges") {
            for ($i = 0; $i < sizeof($entry); $i++) {
                for ($j = sizeof($ids) - 1; $j >= 0; $j--) {
                    $temp = $j;
                    $temp--;
                    if ($data[$key][$i]['source'] == $ids[$j] && $data[$key][$i]['target'] == $ids[$temp]) {
                        $data[$key][$i]['color'] = "#00f";
                        break;
                    } else {
                        $data[$key][$i]['color'] = "#eee";
                    }
                }
            }
        }
    }
}

// $newJsonString = json_encode($data);
// file_put_contents('data.json', $newJsonString);
// header("Location: index.php");
// die();
