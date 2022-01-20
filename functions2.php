<?php

// Creamos 2 tableros, uno que guarde el valor de cada casilla (por defecto será 0) y otro que guarde si esa celda está cubierta o no (por defecto sera true)
function crearTableros(&$tablero, &$cubierto) {
    for ($f = 0; $f < BOARD_SIZE; $f++) {
        $tablero[$f] = array();
        for ($c = 0; $c < BOARD_SIZE; $c++) {
            $tablero[$f][$c] = 0;
        }
    }
    minarTablero($tablero);

    for ($f = 0; $f < BOARD_SIZE; $f++) {
        $cubierto[$f] = array();
        for ($c = 0; $c < BOARD_SIZE; $c++) {
            $cubierto[$f][$c] = true;
        }
    }
}

// Llenamos de minas el tablero generando una posición aleatoria dentro de este y comprobando que no haya ya una mina colocada ahi
function minarTablero(&$tablero) {
    for ($i = 0; $i < MINAS; $i++) {
        $encontrado = false;
        while (!$encontrado) {
            $aleatX = rand(0, BOARD_SIZE - 1);
            $aleatY = rand(0, BOARD_SIZE - 1);
            if ($tablero[$aleatX][$aleatY] != 9) {
                $tablero[$aleatX][$aleatY] = 9;
                $encontrado = true;
                celdasAdyacentesMina($tablero, $aleatX, $aleatY);
            }
        }
    }
}

// Cuando colocamos una mina, todas las celdas adyacentes a esta sumarán en 1 su valor
// Para recorrer las celdas adyacentes, acotamos entre la fila previa y posterior y la columna previa y posterior a la casilla introducida
// Hemos de tener cuidado de no salirnos de los limites del tablero, por ello si no hay una fila/columna previa o posterior a la actual cogeremos la 0 y BOARD_SIZE-1, respectivamente
function celdasAdyacentesMina(&$tablero, $x, $y) {
    $filaPrev = max(0, $x - 1);
    $filaPost = min(BOARD_SIZE - 1, $x + 1);
    $colPrev = max(0, $y - 1);
    $colPost = min(BOARD_SIZE - 1, $y + 1);
    for ($f = $filaPrev; $f <= $filaPost; $f++) {
        for ($c = $colPrev; $c <= $colPost; $c++) {
            if ($tablero[$f][$c] != $tablero[$x][$y] && $tablero[$f][$c] != 9) {
                $tablero[$f][$c]++;
            }
        }
    }
}

// Si la casilla introducida esta cubierta, la descubrimos
// Si el valor de esa casilla es 0 (no tiene minas adyacentes) comprobamos sus celdas adyacentes y descubrimos recursivamente las que no tengan minas
function comprobarMinasAdyac($tablero, &$cubierto, $x, $y) {
    if ($cubierto[$x][$y]) {
        $cubierto[$x][$y] = false;
        if ($tablero[$x][$y] == 0) {
            $filaPrev = max(0, $x - 1);
            $filaPost = min(BOARD_SIZE - 1, $x + 1);
            $colPrev = max(0, $y - 1);
            $colPost = min(BOARD_SIZE - 1, $y + 1);
            for ($f = $filaPrev; $f <= $filaPost; $f++) {
                for ($c = $colPrev; $c <= $colPost; $c++) {
                    if ($tablero[$f][$c] != 9) {
                        comprobarMinasAdyac($tablero, $cubierto, $f, $c);
                    }
                }
            }
        }
    }
}

// En caso de haber obtenido un resultado, se desvelarán todas las minas del tablero
function descubrirMinas($tablero, &$cubierto) {
    for ($f = 0; $f < BOARD_SIZE; $f++) {
        for ($c = 0; $c < BOARD_SIZE; $c++) {
            if ($tablero[$f][$c] == 9) {
                $cubierto[$f][$c] = false;
            }
        }
    }
}

// Filtramos a un array las casillas descubiertas hasta el momento y devolvemos la longitud del array
function celdasDescubiertasT($cubierto) {
    $valoresCub = array_merge(...$cubierto);
    $arrDescub = array_filter($valoresCub, function ($v) {
        return !$v;
    });
    return count($arrDescub);
}

// Si el jugador ha descubierto una mina, perderá y se devolverá un -1
// Si el total de celdas descubiertas es igual a la cantidad de celdas sin minas, entonces el jugador habrá ganado y se devolverá un 1
function hayResultado($tablero, &$cubierto, $x, $y) {
    if ($tablero[$x][$y] == 9) {
        descubrirMinas($tablero, $cubierto);
        return -1;
    } else {
        if (celdasDescubiertasT($cubierto) == pow(BOARD_SIZE, 2) - MINAS) {
            descubrirMinas($tablero, $cubierto);
            return 1;
        }
    }
}
