<?php
include 'node.php';
// $nodes = ["PMJN", "MML", "DT", "SDST", "CSFC", "MIST", "MHNT", "CR", "PM", "PVI", "MM"];
$nodes = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "L", "M", "N", "O", "P", "R", "S", "T", "U", "V", "Z"];
// $graphs = [
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
$graphs = [
    ["Z", "T", "S"], ["U", "P", "G", "F"], ["R", "P", "D"],
    ["M", "C"], ["H"], ["S", "B"], ["B"], ["U", "E"], ["V", "N"],
    ["T", "M"], ["L", "D"], ["I"], ["Z", "S"], ["R", "C", "B"],
    ["S", "P", "C"], ["R", "O", "F", "A"], ["L", "A"],
    ["V", "H", "B"], ["U", "I"], ["O", "A"]
];

$sol = new Search();
$way = [];
$source = "A";
$detiny = "D";

$way = $sol->amplitude($source, $detiny, $nodes, $graphs);
foreach (array_reverse($way) as $key) {
    echo "$key  ";
}
echo "<p>";

$way = $sol->depth($source, $destiny, $nodes, $graphs);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
