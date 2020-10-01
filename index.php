<?php
include 'node.php';
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
$node = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "L", "M", "N", "O", "P", "R", "S", "T", "U", "V", "Z"];
$graph = [
    ["Z", "T", "S"], //A
    ["U", "P", "G", "F"], //B
    ["R", "P", "D"], //C
    ["M", "C"], //D
    ["H"], //E
    ["S", "B"], //F
    ["B"], //G
    ["U", "E"], //H
    ["V", "N"], //L
    ["T", "M"], //I
    ["L", "D"], //M
    ["I"], //N
    ["Z", "S"], //O
    ["R", "C", "B"], //P
    ["S", "P", "C"], //R
    ["R", "O", "F", "A"], //S
    ["L", "A"], //T
    ["V", "H", "B"], //U
    ["U", "I"], //V
    ["O", "A"] //Z
];

$sol = new Search();
$way = [];
$source = "A";
$destiny = "D";

$way = $sol->amplitude($source, $destiny, $node, $graph);
foreach (array_reverse($way) as $key) {
    echo "$key  ";
}
echo "<p>";

$way = $sol->depth($source, $destiny, $node, $graph);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
echo "<p>";

$way = $sol->depth_limit($source, $destiny, 2, $node, $graph);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
echo "<p>";

$way = $sol->depth_limit($source, $destiny, 3, $node, $graph);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
echo "<p>";

$way = $sol->depth_limit($source, $destiny, 4, $node, $graph);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
echo "<p>";

$way = $sol->iterative_deepening($source, $destiny, 4, $node, $graph);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
echo "<p>";

$way = $sol->bidirectional($source, $destiny, $node, $graph);
if (is_array($way)) {
    foreach (array_reverse($way) as $key) {
        echo "$key  ";
    }
} else {
    echo $way;
}
