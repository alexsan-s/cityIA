<?php
    include 'note.php';

    class Index{
        var $nodes = ["PMJN", "MML", "DT", "SDST", "CSFC", "MIST", "MHNT", "CR", "PM", "PVI", "MM"];
        var $graphs = [
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
        var $sol = new Node();
        var $way = [];
        var $source = "";
        var $detiny = "";
    }