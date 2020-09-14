<?php
include 'node.php';
$nodes = ["PMJN", "MML", "DT", "SDST", "CSFC", "MIST", "MHNT", "CR", "PM", "PVI", "MM"];
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
$sol = new Search();
$way = [];
$source = "aa";
$detiny = "aas";

$sol->amplitude($origem, $destino, $nodes, $graphs);

?>
