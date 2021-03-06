<?php
class Node
{
    var $father;
    var $state;
    var $value1;
    var $value2;
    var $previous;
    var $next;

    function __construct($father, $state, $value1, $value2, $previous, $next)
    {
        $this->father   = $father;
        $this->state    = $state;
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

    function insertFirst($s, $v1, $v2, $f)
    {
        $new_node = new Node($f, $s, $v1, $v2, null, null);
        if (is_null($this->head)) {
            $this->tail = $new_node;
        } else {
            $new_node->next = $this->head;
            $this->head->previous = $new_node;
        }
        $this->head = $new_node;
    }

    function insertLast($s, $v1, $v2, $f)
    {
        $new_node = new Node($f, $s, $v1, $v2, null, null);
        if (is_null($this->head)) {
            $this->head = $new_node;
        } else {
            $this->tail->next = $new_node;
            $new_node->previous = $this->tail;
        }
        $this->tail = $new_node;
    }

    function insertPos_X($s, $v1, $v2, $f)
    {
        if (is_null($this->head)) {
            $this->insertFirst($s, $v1, $v2, $f);
        } else {
            $current = $this->head;
            while ($current->value1 < $v1) {
                $current = $current->next;
                if (is_null($current)) break;
            }
            if ($current == $this->head) {
                $this->insertFirst($s, $v1, $v2, $f);
            } else {
                if (is_null($current)) {
                    $this->insertLast($s, $v1, $v2, $f);
                } else {
                    $new_node = new Node($f, $s, $v1, $v2, null, null);
                    $tmp = $current->previous;
                    $tmp->next = $new_node;
                    $new_node->previous = $tmp;
                    $current->previous = $new_node;
                    $new_node->next = $current;
                }
            }
        }
    }

    function deleteFirst()
    {
        if (is_null($this->head))
            return null;
        else {
            $node = $this->head;
            $this->head = $this->head->next;
            if (!is_null($this->head))
                $this->head->previous = null;
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
            $this->tail = $this->tail->previous;
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
        $current = $this->tail;
        $way = [];
        while (!is_null($current->father)) {
            array_push($way, $current->value1);
            $current = $current->father;
        }
        array_push($way, $current->value1);
        return $way;
    }

    function showWay1($value)
    {
        $current = $this->head;
        while ($current->value1 != $value) {
            $current = $current->next;
        }
        $way = [];
        $current = $current->father;
        while (!is_null($current->father)) {
            array_push($way, $current->value1);
            $current = $current->father;
        }
        array_push($way, $current->value1);
        return $way;
    }

    function showWay2($s, $v1)
    {
        $current = $this->tail;
        while ($current->state != $s || $current->value1 != $v1) {
            $current = $current->previous;
        }
        $way = [];
        while (!is_null($current->father)) {
            array_push($way, $current->state);
            $current = $current->father;
        }
        array_push($way, $current->state);
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

        $l1->insertLast(null, $start, 0, null);
        $l2->insertLast(null, $start, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $current = $l1->deleteFirst();
            if (is_object($current) == 0) break;
            $ind = array_search($current->value1, $node);
            for ($i = 0; $i < sizeof($graph[$ind]); $i++) {
                $new = $graph[$ind][$i];
                $flag = True;
                for ($j = 0; $j < sizeof($visited); $j++) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= ($current->value2 + 1)) {
                            $flag = False;
                        } else {
                            $visited[$j][1] = $this->current->value2 + 1;
                        }
                        break;
                    }
                }
                if ($flag) {
                    $l1->insertLast(null, $new, $current->value2 + 1, $current);
                    $l2->insertLast(null, $new, $current->value2 + 1, $current);
                    $row = [];
                    array_push($row, $new, $current->value2 + 1);
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

        $l1->insertLast(null, $start, 0, null);
        $l2->insertLast(null, $start, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $current = $l1->deleteLast();
            if (is_object($current) == 0) break;
            $ind = array_search($current->value1, $node);
            for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                $new = $graph[$ind][$i];
                $flag = True;
                for ($j = sizeof($visited); $j >= 0; $j--) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= ($current->value2 + 1)) {
                            $flag = False;
                        } else {
                            $visited[$j][1] = $this->current->value2 + 1;
                        }
                        break;
                    }
                }
                if ($flag) {
                    $l1->insertLast(null, $new, $current->value2 + 1, $current);
                    $l2->insertLast(null, $new, $current->value2 + 1, $current);
                    $row = [];
                    array_push($row, $new, $current->value2 + 1);
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

    function depth_limit($start, $end, $limit, $node, $graph)
    {
        $l1 = new lista();
        $l2 = new lista();
        $visited = [];

        $l1->insertLast(null, $start, 0, null);
        $l2->insertLast(null, $start, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $current = $l1->deleteLast();
            if (is_object($current) == 0) break;
            if ($current->value2 < $limit) {
                $ind = array_search($current->value1, $node);
                for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                    $new = $graph[$ind][$i];
                    $flag = True;
                    for ($j = sizeof($visited); $j >= 0; $j--) {
                        if ($visited[$j][0] == $new) {
                            if ($visited[$j][1] <= ($current->value2 + 1)) {
                                $flag = False;
                            } else {
                                $visited[$j][1] = $this->current->value2 + 1;
                            }
                            break;
                        }
                    }
                    if ($flag) {
                        $l1->insertLast(null, $new, $current->value2 + 1, $current);
                        $l2->insertLast(null, $new, $current->value2 + 1, $current);
                        $row = [];
                        array_push($row, $new, $current->value2 + 1);
                        array_push($visited, $row);
                        if ($new == $end) {
                            $way = [];
                            $way = $l2->showWay();
                            return $way;
                        }
                    }
                }
            }
        }
        return "Caminho não encontrado";
    }

    function iterative_deepening($start, $end, $l_max, $node, $graph)
    {
        for ($l = 1; $l <= $l_max + 1; $l++) {
            $l1 = new lista();
            $l2 = new lista();
            $visited = [];

            $l1->insertLast(null, $start, 0, null);
            $l2->insertLast(null, $start, 0, null);
            $row = [];
            array_push($row, $start, 0);
            array_push($visited, $row);

            while (!is_null($l1->empty())) {
                $current = $l1->deleteLast();
                if (is_object($current) == 0) break;
                if ($current->value2 < $l) {
                    $ind = array_search($current->value1, $node);
                    for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                        $new = $graph[$ind][$i];
                        $flag = True;
                        for ($j = sizeof($visited); $j >= 0; $j--) {
                            if ($visited[$j][0] == $new) {
                                if ($visited[$j][1] <= ($current->value2 + 1)) {
                                    $flag = False;
                                } else {
                                    $visited[$j][1] = $this->current->value2 + 1;
                                }
                                break;
                            }
                        }
                        if ($flag) {
                            $l1->insertLast(null, $new, $current->value2 + 1, $current);
                            $l2->insertLast(null, $new, $current->value2 + 1, $current);
                            $row = [];
                            array_push($row, $new, $current->value2 + 1);
                            array_push($visited, $row);
                            if ($new == $end) {
                                $way = [];
                                $way = $l2->showWay();
                                return $way;
                            }
                        }
                    }
                }
            }
        }
        return "Caminho não encontrado";
    }

    function bidirectional($start, $end, $node, $graph)
    {
        $l1 = new lista();
        $l2 = new lista();
        $l3 = new lista();
        $l4 = new lista();
        $visited = [];

        $l1->insertLast(null, $start, 0, null);
        $l2->insertLast(null, $start, 0, null);
        $row = [];
        array_push($row, $start, 1);
        array_push($visited, $row);

        $l3->insertLast(null, $end, 0, null);
        $l4->insertLast(null, $end, 0, null);
        $row = [];
        array_push($row, $end, 2);
        array_push($visited, $row);

        while (True) {
            $flag1 = True;
            while ($flag1) {
                $current = $l1->deleteFirst();
                $ind = array_search($current->value1, $node);

                for ($i = 0; $i < sizeof($graph[$ind]); $i++) {
                    $new = $graph[$ind][$i];
                    $flag2 = True;
                    $flag3 = False;
                    for ($j = 0; $j < sizeof($visited); $j++) {
                        if ($visited[$j][0] == $new) {
                            if ($visited[$j][1] == 1) {
                                $flag2 = False;
                            } else {
                                $flag3 = True;
                            }
                            break;
                        }
                    }
                    if ($flag2) {
                        $l1->insertLast(null, $new, $current->value2 + 1, $current);
                        $l2->insertLast(null, $new, $current->value2 + 1, $current);
                        if ($flag3) {
                            $way = [];
                            $way = $l2->showWay();
                            $way = array_reverse($way);
                            foreach ($l4->showWay1($new) as $key) {
                                array_push($way, $key);
                            }
                            return $way;
                        } else {
                            $row = [];
                            array_push($row, $new, 1);
                            array_push($visited, $row);
                        }
                    }
                }
                if ($l1->empty() != True) {
                    $temp = $l1->first();
                    if ($temp->value2 == $current->value2)
                        $flag1 = True;
                    else $flag1 = False;
                }
            }

            $flag1 = True;
            while ($flag1) {
                $current = $l3->deleteFirst();
                if (is_object($current) == 0) break;
                $ind = array_search($current->value1, $node);

                for ($i = 0; $i < sizeof($graph[$ind]); $i++) {
                    $new = $graph[$ind][$i];
                    $flag2 = True;
                    $flag3 = False;
                    for ($j = 0; $j < sizeof($visited); $j++) {
                        if ($visited[$j][0] == $new) {
                            if ($visited[$j][1] == 2) {
                                $flag2 = False;
                            } else {
                                $flag3 = True;
                            }
                            break;
                        }
                    }
                    if ($flag2) {
                        $l3->insertLast(null, $new, $current->value2 + 1, $current);
                        $l4->insertLast(null, $new, $current->value2 + 1, $current);
                        if ($flag3) {
                            $way = [];
                            $way = $l4->showWay();
                            $way = array_reverse($way);
                            foreach ($l2->showWay1($new) as $key) {
                                array_push($way, $key);
                            }
                            return $way;
                        } else {
                            $row = [];
                            array_push($row, $new, 2);
                            array_push($visited, $row);
                        }
                    }
                }
                if ($l3->empty() != True) {
                    $temp = $l3->first();
                    if ($current->value2 == $temp->value2)
                        $flag1 = True;
                    else $flag1 = False;
                }
            }
        }
        return "Caminho não encontrado";
    }

    function uniform_cost($start, $end, $node, $graph)
    {
        $l1 = new lista();
        $l2 = new lista();
        $visited = [];
        $list = [];

        $l1->insertLast($start, 0, 0, null);
        $l2->insertLast($start, 0, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $current = $l1->deleteFirst();
            if ($current->state == $end) {
                $way = [];
                $way = $l2->showWay2($current->state, $current->value1);
                array_push($list, $way, $current->value2);
                return $list;
            }
            $ind = array_search($current->state, $node);
            for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                $new = $graph[$ind][$i][0];


                $v2 = $current->value2 + $graph[$ind][$i][1];
                $v1 = $v2;

                $flag1 = True;
                $flag2 = True;
                for ($j = sizeof($visited); $j >= 0; $j--) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= $v1) {
                            $flag1 = False;
                        } else {
                            $visited[$j][1] = $v1;
                            $flag2 = False;
                        }
                        break;
                    }
                }
                if ($flag1) {
                    $l1->insertPos_X($new, $v1, $v1, $current);
                    $l2->insertPos_X($new, $v1, $v1, $current);
                    if ($flag2) {
                        $row = [];
                        array_push($row, $new, $v1);
                        array_push($visited, $row);
                    }
                }
            }
        }
        return "Caminho não encontrado";
    }

    function greedy($start, $end, $node, $graph, $h)
    {
        $l1 = new lista();
        $l2 = new lista();
        $visited = [];
        $list = [];

        $l1->insertLast($start, 0, 0, null);
        $l2->insertLast($start, 0, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $current = $l1->deleteFirst();
            if ($current->state == $end) {
                $way = [];
                $way = $l2->showWay2($current->state, $current->value1);
                array_push($list, $way, $current->value2);
                return $list;
            }
            $ind = array_search($current->state, $node);
            for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                $new = $graph[$ind][$i][0];
                $ind1 = array_search($graph[$ind][$i][0], $node);


                $v2 = $current->value2 + $graph[$ind][$i][1];
                $v1 = $h[$ind1];

                $flag1 = True;
                $flag2 = True;
                for ($j = sizeof($visited); $j >= 0; $j--) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= $v1) {
                            $flag1 = False;
                        } else {
                            $visited[$j][1] = $v1;
                            $flag2 = False;
                        }
                        break;
                    }
                }
                if ($flag1) {
                    $l1->insertPos_X($new, $v1, $v2, $current);
                    $l2->insertPos_X($new, $v1, $v2, $current);
                    if ($flag2) {
                        $row = [];
                        array_push($row, $new, $v1);
                        array_push($visited, $row);
                    }
                }
            }
        }
        return "Caminho não encontrado";
    }

    function a_star($start, $end, $node, $graph, $h)
    {
        $l1 = new lista();
        $l2 = new lista();
        $visited = [];
        $list = [];

        $l1->insertLast($start, 0, 0, null);
        $l2->insertLast($start, 0, 0, null);
        $row = [];
        array_push($row, $start, 0);
        array_push($visited, $row);

        while (!is_null($l1->empty())) {
            $current = $l1->deleteFirst();
            if ($current->state == $end) {
                $way = [];
                $way = $l2->showWay2($current->state, $current->value1);
                array_push($list, $way, $current->value2);
                return $list;
            }
            $ind = array_search($current->state, $node);
            for ($i = sizeof($graph[$ind]) - 1; $i >= 0; $i--) {
                $new = $graph[$ind][$i][0];
                $ind1 = array_search($graph[$ind][$i][0], $node);


                $v2 = $current->value2 + $graph[$ind][$i][1];
                $v1 = $v2 + $h[$ind1];

                $flag1 = True;
                $flag2 = True;
                for ($j = sizeof($visited); $j >= 0; $j--) {
                    if ($visited[$j][0] == $new) {
                        if ($visited[$j][1] <= $v1) {
                            $flag1 = False;
                        } else {
                            $visited[$j][1] = $v1;
                            $flag2 = False;
                        }
                        break;
                    }
                }
                if ($flag1) {
                    $l1->insertPos_X($new, $v1, $v2, $current);
                    $l2->insertPos_X($new, $v1, $v2, $current);
                    if ($flag2) {
                        $row = [];
                        array_push($row, $new, $v1);
                        array_push($visited, $row);
                    }
                }
            }
        }
        return "Caminho não encontrado";
    }
}
