<?php
class Node
{
    var $father;
    var $value1;
    var $value2;
    var $previous;
    var $next;

    function __construct($father, $value1, $value2, $previous, $next)
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
        if (is_null($this->head)) {
            $this->head = $new_node;
        } else {
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
            $node = $this->head;
            $this->head = $this->head->next;
            if (!is_null($this->head))
                $this->head->previus = null;
            else {
                $this->tail = null;
            }
            return $node;
        }
    }

    function deleteLast()
    {
        if (is_null($this->tail)) {
            return null;
        } else {
            $node = $this->tail;
            $this->tail = $this->tail->previus;
            if (!is_null($this->tail)) {
                $this->tail->next = null;
            } else {
                $this->head = null;
            }
            return $node;
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
        while (!is_null($atual->father)) {
            array_push($way, $atual->value1);
            $atual = $atual->father;
        }
        array_push($way, $atual->value1);
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
    function amplitude($start, $end, $node, $graph)
    {

        $l1 = new lista();
        $l2 = new lista();
        $visited = [];

        $l1->insertLast($start, 0, null);
        $l2->insertLast($start, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $atual = $l1->deleteFirst();
            if (is_object($atual) == 0) break;
            $ind = array_search($atual->value1, $node);
            echo "<p>";
            for ($i = 0; $i < sizeof($graph[$ind]); $i++) {
                $new = $graph[$ind][$i];
                // echo $new;
                // echo '<p>';
                $flag = True;
                for ($j = 0; $j < sizeof($visited); $j++) {
                    // echo $visited[$j][0];
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= ($atual->value2 + 1)) {
                            $flag = False;
                        } else {
                            $visited[$j][1] = $this->atual->value2 + 1;
                        }
                        break;
                    }
                }
                if ($flag) {
                    $l1->insertLast($new, $atual->value2 + 1, $atual);
                    $l2->insertLast($new, $atual->value2 + 1, $atual);
                    $row = [];
                    array_push($row, $new, $atual->value2 + 1);
                    array_push($visited, $row);
                    if ($new == $end) {
                        $way = [];
                        $way = $l2->showWay();
                        return $way;
                    }
                }
            }
        }
        return "Caminho não encontrado";
    }

    function depth($start, $end, $node, $graph)
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
        while (!is_null($l1->empty()) and $flag1 == False) {
            $atual = $l1->deleteLast();
            if (is_object($atual) == 0) break;
            $ind = array_search($atual->value1, $node);
            for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                $new = $graph[$ind][$i];
                $flag = True;

                for ($j = 0; $j < sizeof($visited); $j++) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= ($atual->value2 + 1)) {
                            $flag = False;
                        } else {
                            $visited[$j][1] = $this->atual->value2 + 1;
                        }
                        break;
                    }
                }
                if ($flag) {
                    $l1->insertLast($new, $atual->value2 + 1, $atual);
                    $l2->insertLast($new, $atual->value2 + 1, $atual);
                    $row = [];
                    array_push($row, $new, $atual->value2 + 1);
                    array_push($visited, $row);
                    echo $new;
                    echo $end;
                    echo "<p>";
                    if ($new == $end) {
                        $flag1 = True;
                    }
                }
            }
        }
        $way = [];
        if ($flag1) $way = $l2->showWay();
        else
            $way = "Caminho não encontrado";
        return $way;
    }
}
