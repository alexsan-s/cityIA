<?php
include 'node.php';
$nodes = ["PMJN", "MML", "DT", "SDST", "CSFC", "MIST", "MHNT", "CR", "PM", "PVI", "MM"];
/// $nodes = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "L", "M", "N", "O", "P", "R", "S", "T", "U", "V", "Z"];
$graphs = [
    ["MML", "DT"],
    ["PMJN", "DT", "CSFC"],
    ["PMJN", "MML", "CSFC", "SDST"],
    ["DT", "CSFC", "CR"],
    ["MML", "SDST", "MIST", "MHNT", "CR"],
    ["MHNT", "CSFC"],
    ["MIST", "PM"],
    ["SDST", "CSFC", "PVI"],
    ["MHNT", "PVI"],
    ["CR", "PM", "MM"],
    ["PVI"],
];
// $graphs = [
//     ["Z", "T", "S"], ["U", "P", "G", "F"], ["R", "P", "D"],
//     ["M", "C"], ["H"], ["S", "B"], ["B"], ["U", "E"], ["V", "N"],
//     ["T", "M"], ["L", "D"], ["I"], ["Z", "S"], ["R", "C", "B"],
//     ["S", "P", "C"], ["R", "O", "F", "A"], ["L", "A"],
//     ["V", "H", "B"], ["U", "I"], ["O", "A"]
// ];

$sol = new Search();
$way = [];
$source = "PMJN";
$detiny = "PVI";

$way = $sol->amplitude($source, $detiny, $nodes, $graphs);
foreach (array_reverse($way) as $key) {
    echo "$key  ";
}
