<?php
class Node
{
    // var $father;
    function __constructor($father = null, $value1 = null, $value2 = null, $previous = null, $next = null)
    {
        $this->father   = $father;
        $this->value1   = $value1;
        $this->value2   = $value2;
        $this->previous = $previous;
        $this->next     = $next;
    }
}

class Lista
{
    var $head = null;
    var $tail = null;

    function insertLast($v1, $v2, $f){
        $new_node = new Node($f, $v1, $v2, null, null);

        if (is_null($this->head))
            $this->head = $new_node;
        else{
            $this->tail->next = $new_node;
            $new_node->previous = $this ->tail;
        }          
        $this->tail = $new_node;
    }

    function first(){
        return $this->head;
    }

    function last(){
        return $this->tail;
    }
}

class Search{
    function amplitude($origem, $destino){
        $l1 = new lista();
        $l2 = new lista();
    }
}
