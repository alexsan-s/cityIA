<?php
$json = file_get_contents("./data.json");
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($jsonIterator as $key => $val) {
    // if (is_array($val)) {
    //     echo "$key:<p>";
    // } else {
    //     echo "$key => $val\n";
    // }
    if ($key = "nodes") {
        if ($val = "n0") {
            $val = "n1";
            echo $val;
            break;
        }
    }
}
