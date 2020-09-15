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

    function deleteFirst()
    {
        if (is_null($this->head))
            return null;
        else {
            $no = $this->head;
            $this->head = $this->head->next;
            if (!is_null($this->head))
                $this->head->previus = null;
            else{
                $this->tail = null;
            }
            return $no;
        }
    }

    function empty()
    {
        if (is_null($this->head)) return True;
        else return False;
    }

    function showWay()
    {
        $atual = $this->tail;
        $way = [];
        while (!is_null($this->atual->father)) {
            array_push($way, $this->atual->value1);
            $this->atual = $this->atual->father;
        }
        array_push($way, $this->atual->value1);
        return $way;
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
        $flag1 = False;
        while (!is_null($l1->empty()) && $flag1 == False) {
            $atual = $l1->deleteFirst();
            print_r($atual);
            if (is_null($this->atual)) {
                echo "Vazio<p>";
                break;
            }
            $ind = array_values($nodes)[$atual->value1];
            print_r($ind);
            for ($i = 0; $i < sizeof($graphs); $i++) {
                $new = $graphs[$ind][$i];
                $flag = True;

                for ($j = 0; $j < sizeof($graphs); $j++) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= ($this->atual->value2 + 1)) {
                            $flag = False;
                        } else {
                            $visited[$j][1] = $this->atual->value2 + 1;
                        }
                        break;
                    }
                }
                if ($flag) {
                    echo "ei<p>";
                    $l1->insertLast($this->new, $this->atual->value2 + 1, $this->atual);
                    $l2->insertLast($this->new, $this->atual->value2 + 1, $this->atual);
                    $row = [];
                    array_push($row, $new, $this->atual->value2 + 1);
                    array_push($visited, $row);
                    if ($new == $end) {
                        $flag1 = True;
                    }
                }
            }
        }
        $way = [];
        if ($flag1) {
            $way = $l2->showWay();
        } else {
            $way = "Caminho não encontrado";
        }
        return $way;
    }
}
