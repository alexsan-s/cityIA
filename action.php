<?php
session_start();
unset($_SESSION['way']);
include 'node.php';
$jsonString = file_get_contents('data.json');
$data = json_decode($jsonString, true);

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
$_SESSION['source'] = $_POST['source'];
$_SESSION['destiny'] = $_POST['destiny'];
$sol = new Search();
$way = [];
$source = $_POST['source'];
$destiny = $_POST['destiny'];

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
}
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        $_SESSION['way'] .= "$key ";
    }
} else {
    $_SESSION['way'] = $way;
}
$ids = array();

if (is_array($way)) {
    foreach ($data as $key => $entry) {
        if ($key == "nodes") {
            for ($i = 0; $i < sizeof($entry); $i++) {
                for ($j = 0; $j < sizeof($way); $j++) {
                    if ($data[$key][$i]['label'] == $way[$j]) {;
                        array_push($ids, $data[$key][$i]['id']);
                        $data[$key][$i]['color'] = "#00f";
                        break;
                    } else {
                        $data[$key][$i]['color'] = "#eee";
                    }
                }
            }
        }
        // print_r($ids);
        // echo "<p>";
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
                    // echo $data[$key][$i]['source'];
                }
            }
        }
    }
}

// echo "Corrigido<p>";

$newJsonString = json_encode($data);
file_put_contents('data.json', $newJsonString);
header("Location: index.php");
die();
