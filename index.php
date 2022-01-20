<?php

require "vendor/autoload.php";

include 'functions2.php';

use eftec\bladeone\bladeone;

$Views = __DIR__ . '\Views';
$Cache = __DIR__ . '\Cache';

$Blade = new BladeOne($Views, $Cache);

session_start();

define("PATH_WIN_AUDIO", "\public\assets\audio\audio1.mp3");
define("PATH_LOSE_AUDIO", "\public\assets\audio\audio2.mp3");
define("PATH_PIC", "\public\assets\img\bomb.png");
define("BOARD_SIZE", 8);
define("MINAS", 10);
$post = filter_input_array(INPUT_POST);

if (empty($post)) {
    $tablero = array();
    $cubierto = array();
    crearTableros($tablero, $cubierto);
    $_SESSION['tablero'] = $tablero;
    $_SESSION['cubierto'] = $cubierto;
    
    echo $Blade->run('board');
    
} else {

    $tablero = $_SESSION['tablero'];
    $cubierto = $_SESSION['cubierto'];
    $result["descub"] = array();

    $XUsuario = filter_input(INPUT_POST, 'x');
    $YUsuario = filter_input(INPUT_POST, 'y');

    comprobarMinasAdyac($tablero, $cubierto, $XUsuario, $YUsuario);
    
    // Si hay un resultado, se asignará a $result["gameRes"]
    $resultado = hayResultado($tablero, $cubierto, $XUsuario, $YUsuario);
    if ($resultado != null) {
        $result["gameRes"] = $resultado;
    }

    // Asignamos a $result["descub"] un array conformado por uno o varios arrays que representan las casillas desubiertas durante el proceso
    // Estos arrays estarán formados por 3 valores: la fila, la columna y el valor de la casilla descubierta
    for ($f = 0; $f < BOARD_SIZE; $f++) {
        for ($c = 0; $c < BOARD_SIZE; $c++) {
            if (!$cubierto[$f][$c]) {
                $result["descub"][] = [$f, $c, $tablero[$f][$c]];
            }
        }
    }
    $_SESSION['cubierto'] = $cubierto;
    
    header('Content-type: application/json');
    echo json_encode($result);
}
