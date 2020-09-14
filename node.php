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

    function insertLast($v1, $v2, $f)
    {
        $new_node = new Node($f, $v1, $v2, null, null);

        if (is_null($this->head))
            $this->head = $new_node;
        else {
            $this->tail->next = $new_node;
            $new_node->previous = $this->tail;
        }
        $this->tail = $new_node;
    }

    function deleteFirst(){
        if(is_null($this->head))
            return null;
        else{
            $no = $this->head;
            $this->head = $this->head->next;
            if(!is_null($this->head))
                $this->head->previus = null;
            else
                $this->tail = null;
        }
    }

    function empty(){
        if(is_null($this->head)) return True;
        else return False;
    }

    function first()
    {
        return $this->head;
    }

    function last()
    {
        return $this->tail;
    }
}

class Search
{
    function amplitude($start, $end, $nodes, $graphs)
    {
        $l1 = new lista();
        $l2 = new lista();
        $visited = [];
        $l1->insertLast($start, 0, null);
        $l2->insertLast($start, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);
        $flag1 = false;
        while (is_null($l1->empty()) && $flag1 == False) {
            $atual = $l1->deleteFirst();
            if(is_null($this->atual))
                break;
            $ind = array_values($nodes)[$this->atual->value1];
            foreach (range(count($graphs[$ind]), sizeof($graphs)) as $i){
                
            }
        }
    }
}
