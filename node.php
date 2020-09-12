<?php
class Node{
    // var $father;
    function __constructor($father, $value1, $value2, $previous, $next){
        $this->father   = $father;
        $this->value1   = $value1;
        $this->value2   = $value2;
        $this->previous = $previous;
        $this->next     = $next;
    }
}

class Lista{
    var $head;
    var $tail;
}