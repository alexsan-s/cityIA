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

$start = "CASA DO FIGUREIRO";
$end = "SANTUARIO DIOCESANO DE SANTA TERESINHA";
$node = ["CASA DO FIGUREIRO", "CATEDRAL SAO FRANCISCO DE CHEGAS", "CRISTO REDENTOR", "DIOCESE DE TAUBATE", "HORTO MUNICIPAL", "MERCADO MUNICIPAL", "MIRANTE DO QUIRIRIM", "MUSEU DA IMAGEM E DO SOM DE TAUBATE", "MUSEU DA IMIGRACAO ITALIANA", "MUSEU DE HISTORIA NATURAL DE TAUBATE", "MUSEU MAZZAROPI", "MUSEU MONTEIRO LOBATO - SITIO DO PICA-PAU AMARELO", "PARQUE MUNICIPAL", "PARQUE MUNICIPAL JARDIM DAS NACOES", "PARQUE VALE DO ITAIM", "RELOGIO DA CTI", "SANTUARIO DIOCESANO DE SANTA TERESINHA", "SISTEMA EDUCACIONAL DE DESENVOLVIMENTO SOCIAL", "TEATRO METROPOLE"];
$graph = [
    ["CRISTO REDENTOR", "MERCADO MUNICIPAL", "SANTUARIO DIOCESANO DE SANTA TERESINHA"],
    ["DIOCESE DE TAUBATE", "MERCADO MUNICIPAL", "RELOGIO DA CTI", "SANTUARIO DIOCESANO DE SANTA TERESINHA", "TEATRO METROPOLE"],
    ["CASA DO FIGUREIRO", "HORTO MUNICIPAL", "MERCADO MUNICIPAL", "PARQUE VALE DO ITAIM"],
    ["CATEDRAL SAO FRANCISCO DE CHEGAS", "PARQUE MUNICIPAL JARDIM DAS NACOES", "RELOGIO DA CTI", "SANTUARIO DIOCESANO DE SANTA TERESINHA"],
    ["CRISTO REDENTOR", "MERCADO MUNICIPAL", "MUSEU DE HISTORIA NATURAL DE TAUBATE", "PARQUE MUNICIPAL"],
    ["CASA DO FIGUREIRO", "CATEDRAL SAO FRANCISCO DE CHEGAS", "CRISTO REDENTOR", "HORTO MUNICIPAL", "SANTUARIO DIOCESANO DE SANTA TERESINHA", "TEATRO METROPOLE"],
    ["MUSEU DA IMIGRACAO ITALIANA", "PARQUE MUNICIPAL JARDIM DAS NACOES"],
    ["MUSEU DE HISTORIA NATURAL DE TAUBATE", "SISTEMA EDUCACIONAL DE DESENVOLVIMENTO SOCIAL"],
    ["MIRANTE DO QUIRIRIM"],
    ["HORTO MUNICIPAL", "MUSEU DA IMAGEM E DO SOM DE TAUBATE"],
    ["PARQUE VALE DO ITAIM"],
    ["RELOGIO DA CTI"],
    ["HORTO MUNICIPAL", "PARQUE VALE DO ITAIM"],
    ["DIOCESE DE TAUBATE", "MIRANTE DO QUIRIRIM", "RELOGIO DA CTI"],
    ["CRISTO REDENTOR", "MUSEU MAZZAROPI", "PARQUE MUNICIPAL"],
    ["CATEDRAL SAO FRANCISCO DE CHEGAS", "DIOCESE DE TAUBATE", "MUSEU MONTEIRO LOBATO - SITIO DO PICA-PAU AMARELO", "PARQUE MUNICIPAL JARDIM DAS NACOES"],
    ["CASA DO FIGUREIRO", "CATEDRAL SAO FRANCISCO DE CHEGAS", "DIOCESE DE TAUBATE", "MERCADO MUNICIPAL"],
    ["MUSEU DA IMAGEM E DO SOM DE TAUBATE"],
    ["CATEDRAL SAO FRANCISCO DE CHEGAS", "MERCADO MUNICIPAL"],
];

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

echo amplitude($start, $end, $node, $graph);