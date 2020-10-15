<?php
session_start();
unset($_SESSION['cost']);
unset($_SESSION['way']);

include 'node.php';

$jsonString = file_get_contents('data.json');

$sol = new Search();


$_SESSION['source'] = $_POST['source'];
$_SESSION['destiny'] = $_POST['destiny'];

$data = json_decode($jsonString, true);


$source =  trim($_POST['source']);
$destiny = trim($_POST['destiny']);

$way = [];
$ids = array();

$node = [
    "CDF", "CSFDC", "CR", "DDT", "HM", "MM", "MDQ",
    "MDIEDSDT", "MDII", "MDHNDT", "MMA", "MMLSDPPA", "PM",
    "PMJDN", "PVDI", "RDC", "SDDST", "SEDDS", "TM"
];
$graph = [
    ["CR", "MM", "SDDST"],
    ["DDT", "MM", "RDC", "SDDST", "TM"],
    ["CDF", "HM", "MM", "PVDI"],
    ["CSFDC", "PMJDN", "RDC", "SDDST"],
    ["CR", "MM", "MDHNDT", "PM"],
    ["CDF", "CSFDC", "CR", "HM", "SDDST", "TM"],
    ["MDII", "PMJDN"],
    ["MDHNDT", "SEDDS"],
    ["MDQ"],
    ["HM", "MDIEDSDT"],
    ["PVDI"],
    ["RDC"],
    ["HM", "PVDI"],
    ["DDT", "MDQ", "RDC"],
    ["CR", "MMA", "PM"],
    ["CSFDC", "DDT", "MMLSDPPA", "PMJDN"],
    ["CDF", "CSFDC", "DDT", "MM"],
    ["MDIEDSDT"],
    ["CSFDC", "MM"],
];

$graph1 = [
    [["CR", 521], ["MM", 1003], ["SDDST", 995]],
    [["DDT", 858], ["MM", 244], ["RDC", 963], ["SDDST", 765], ["TM", 65]],
    [["CDF", 565], ["HM", 2300], ["MM", 1020], ["PVDI", 1029]],
    [["CSFDC", 880], ["PMJDN", 1029], ["RDC", 704], ["SDDST", 169]],
    [["CR", 2300], ["MM", 2014], ["MDHNDT", 270], ["PM", 2007]],
    [["CDF", 1003], ["CSFDC", 244], ["CR", 1020], ["HM", 2014], ["SDDST", 876], ["TM", 234]],
    [["MDII", 466], ["PMJDN", 5062]],
    [["MDHNDT", 115], ["SEDDS", 1021]],
    [["MDQ", 466]],
    [["HM", 270], ["MDIEDSDT", 115]],
    [["PVDI", 1004]],
    [["RDC", 429]],
    [["HM", 2007], ["PVDI", 71]],
    [["DDT", 1029], ["MDQ", 5062], ["RDC", 1015]],
    [["CR", 1029], ["MMA", 1004], ["PM", 71]],
    [["CSFDC", 963], ["DDT", 704], ["MMLSDPPA", 429], ["PMJDN", 1015]],
    [["CDF", 995], ["CSFDC", 765], ["DDT", 169], ["MM", 876]],
    [["MDIEDSDT", 1021]],
    [["CSFDC", 65], ["MM", 234]],
];

// $h = [
//     366, 0, 160, 242, 161, 178, 77, 151, 226, 244,
//     241, 234
// ];

if (isset($_POST["amplitude"])) {
    echo $source;
    echo "<p>";
    print_r($destiny);
    echo "<p>";
    print_r($node);
    echo "<p>";
    print_r($graph);
    echo "<p>";
    $way = $sol->amplitude($source, $destiny, $node, $graph);
    print_r($way);
} else if (isset($_POST["depth"])) {
    $way = $sol->depth($source, $destiny, $node, $graph);
} else if (isset($_POST["depth_limit"])) {
    $way = $sol->depth_limit($source, $destiny, 4, $node, $graph);
} else if (isset($_POST["iterative_deepening"])) {
    $way = $sol->iterative_deepening($source, $destiny, 4, $node, $graph);
} else if (isset($_POST["bidirectional"])) {
    $way = $sol->bidirectional($source, $destiny, $node, $graph);
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
    $_SESSION['way'] .= "Caminho:";
} else {
    $_SESSION['way'] = $way;
}


foreach ($data as $key => $entry) {
    for ($i = 0; $i < sizeof($entry); $i++) {
        $data[$key][$i]['color'] = "#0FA8FA";
    }
}
if (is_array($way)) {
    foreach ($data as $key => $entry) {
        if ($key == "nodes") {
            for ($j = 0; $j < sizeof($way); $j++) {
                echo $way[$j];
                for ($i = 0; $i < sizeof($entry); $i++) {
                    if ($data[$key][$i]['id'] == $way[$j]) {
                        array_push($ids, $data[$key][$i]['id']);
                        $_SESSION['way'] .= ' ' . $data[$key][$i]['label'] . ' -';
                        $data[$key][$i]['color'] = "#24FA0F";
                    }
                }
            }
        }
        if ($key == "edges") {
            for ($i = 0; $i < sizeof($entry); $i++) {
                for ($j = sizeof($ids) - 1; $j >= 0; $j--) {
                    $temp = $j;
                    $temp--;
                    if (
                        $data[$key][$i]['source'] == $ids[$j] && $data[$key][$i]['target'] == $ids[$temp]
                        || $data[$key][$i]['source'] == $ids[$temp] && $data[$key][$i]['target'] == $ids[$j]
                    ) {
                        $data[$key][$i]['color'] = "#24FA0F";
                        break;
                    } else {
                        $data[$key][$i]['color'] = "#0FA8FA";
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
