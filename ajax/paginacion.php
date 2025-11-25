<?php

function paginate($reload, $page, $tpages, $adjacents) {
    $prevlabel = "&lsaquo; Anterior";
    $nextlabel = "Siguiente &rsaquo;";
    $out = "<ul class='pagination pagination-large'>";
    // anterior
    if ($page == 1) {
        $out .= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
    } elseif ($page == 2) {
        // $out .= "<li><span><a href='" . $reload . "'>$prevlabel</a></span></li>";
        $out .= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
    } else {
        // $out .= "<li><span><a href='" . $reload . "?page=" . ($page - 1) . "'>$prevlabel</a></span></li>";
        $out .= "<li><span><a href='javascript:void(0);' onclick='load(" . ($page - 1) . ")'>$prevlabel</a></span></li>";
    }
    // primer
    if ($page > ($adjacents + 1)) {
        // $out .= "<li><a href='" . $reload . "'>1</a></li>";
        $out .= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
    }
    // interval
    if ($page > ($adjacents + 2)) {
        $out .= "<li><a>...</a></li>";
    }
    // paginas
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out .= "<li class='active'><span><a>$i</a></span></li>";
        } elseif ($i == 1) {
            $out .= "<li><span><a href='" . $reload . "'>$i</a></span></li>";
        } else {
            $out .= "<li><span><a href='" . $reload . "?page=" . $i . "'>$i</a></span></li>";
        }
    }
    // intervalos
    if ($page < ($tpages - $adjacents - 1)) {
        $out .= "<li><a>...</a></li>";
    }
    // ultimo
    if ($page < ($tpages - $adjacents)) {
        // $out .= "<li><a href='" . $reload . "?page=" . $tpages . "'>" . $tpages . "</a></li>";
        $out .= "<li><a href='javascript:void(0);' onclick='load(" . $tpages . ")'>" . $tpages . "</a></li>";
    }
    // siguiente
    if ($page < $tpages) {
        // $out .= "<li><span><a href='" . $reload . "?page=" . ($page + 1) . "'>$nextlabel</a></span></li>";
        $out .= "<li><span><a href='javascript:void(0);' onclick='load(" . ($page + 1) . ")'>$nextlabel</a></span></li>";
    } else {
        $out .= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
    }
    $out .= "</ul>";
    return $out;
}