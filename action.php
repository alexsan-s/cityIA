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

// $node = ["PMJN", "MML", "DT", "SDST", "CSFC", "MIST", "MHNT", "CR", "PM", "PVI", "MM"];
// $graph = [
//     ["DT", "MML"],
//     ["CSFC", "DT", "PMJN"],
//     ["CSFC", "MML", "PMJN", "SDST"],
//     ["CR", "CSFC", "DT"],
//     ["CR", "MHNT", "MIST", "MML", "SDST"],
//     ["CSFC", "MHNT"],
//     ["MIST", "PM"],
//     [ "CSFC","PVI", "SDST"],
//     ["MHNT", "PVI"],
//     ["CR", "MM", "PM"],
//     ["PVI"],
// ];
$node = ["A", "B", "C", "D", "E", "F", "G", "H", "P", "Q", "R", "S"];
$graph = [
    [], ["A"], ["A"], ["E", "C", "B"], ["R", "H"], ["G", "C"], [],
    ["Q", "P"], ["Q"], [], ["F"], ["P", "E", "D"]
];

$graph1 = [
    [[]],
    [["A", 65]],
    [["A", 55]],
    [["E", 20], ["C", 55], ["B", 62]],
    [["R", 55], ["H", 80]],
    [["G", 10], ["C", 20]],
    [[]],
    [["Q", 30], ["P", 12]],
    [["Q", 30]],
    [[]],
    [["F", 60]],
    [["P", 90], ["E", 69], ["D", 40]]
];

if (isset($_POST["amplitude"])) {
    $way = $sol->amplitude($source, $destiny, $node, $graph);
} else if (isset($_POST["depth"])) {
    $way = $sol->depth($source, $destiny, $node, $graph);
} else if (isset($_POST["depth_limit"])) {
    $way = $sol->depth_limit($source, $destiny, 4, $node, $graph);
} else if (isset($_POST["iterative_deepening"])) {
    $way = $sol->iterative_deepening($source, $destiny, 4, $node, $graph);
} else if (isset($_POST["bidirectional"])) {
    $way = $sol->bidirectional($source, $destiny, $node, $graph);
} else if (isset($_POST["unifor_cost"])) {
    $way = $sol->uniform_cost($source, $destiny, $node, $graph1);
    $temp = $way[0];
    $_SESSION['cost'] = "Custo do Caminho: " . $way[1];
    $way = $temp;
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

$newJsonString = json_encode($data);
file_put_contents('data.json', $newJsonString);
header("Location: index.php");
die();
