<?php

session_start();

if (isset($_POST['reiniciar'])) {
    session_unset();
    session_destroy();
    header("Location: inicio.php");
    exit();
}

$_SESSION['jugador1'] = $_GET['nombre1'];
$_SESSION['jugador2'] = $_GET['nombre2'];
$_SESSION['jugador3'] = $_GET['nombre3'];

$jugadores_numeros = array(
    $_SESSION['jugador1'] => 1,
    $_SESSION['jugador2'] => 2,
    $_SESSION['jugador3'] => 3
);


$_SESSION['turno'] = isset($_SESSION['turno']) ? $_SESSION['turno'] : $_SESSION['jugador1'];

$_SESSION['tiradas'] = isset($_SESSION['tiradas']) ? $_SESSION['tiradas'] : [
    $_SESSION['jugador1'] => 0,
    $_SESSION['jugador2'] => 0,
    $_SESSION['jugador3'] => 0
];

$total_avanzado = isset($_SESSION['total_avanzado']) ? $_SESSION['total_avanzado'] : [];
$avanzar = '';
$jugador_actual = $_SESSION['jugador1'];
$_SESSION['posiciones'] = "";

if (isset($_POST['dado'])) {
    $jugador_actual = $_POST['jugador_actual'];
    $avanzar = $_POST['dado'];
    $total_avanzado[$jugador_actual] = isset($total_avanzado[$jugador_actual]) ? $total_avanzado[$jugador_actual] + $avanzar : $avanzar;
    $_SESSION['posiciones'] = $total_avanzado;
    $_SESSION['tiradas'][$jugador_actual]++;

    if ($jugador_actual === $_SESSION['jugador1']) {
        $_SESSION['turno'] = $_SESSION['jugador2'];
    } elseif ($jugador_actual === $_SESSION['jugador2']) {
        $_SESSION['turno'] = $_SESSION['jugador3'];
    } else {
        $_SESSION['turno'] = $_SESSION['jugador1'];
    }

    $_SESSION['total_avanzado'] = $total_avanzado;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url(./fondos.webp);
            background-repeat: no-repeat;
            background-size: cover;
        }

        table,
        td,
        tr {
            border: solid 2px black;
            text-align: center;
        }

        .fichas-jugadores {
            margin-bottom: 20px;
        }

        .ficha-jugador {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid white;
            margin-bottom: 10px;
        }

        .jugador1 {
            background-color: black;
        }

        .jugador2 {
            background-color: blue;
        }

        .jugador3 {
            background-color: red;
        }

        .jugador-actual {
            box-shadow: 0 0 15px 7px blue;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>SERPIENTES Y ESCALERAS</h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3 formulario">
                <?php
                ?>
                <form action="#" method="post">
                    <?php echo "<h4> Turno de: " . $_SESSION['turno'];
                    "</h4>" ?>
                    <br><br>
                    <div>
                        <label for="contador">NO. DE TIRADAS</label>
                        <input type="number" value="<?php echo $_SESSION['tiradas'][$jugador_actual]; ?>" readonly>
                    </div><br>
                    <div>
                        <label for="dado">DADO</label><br>
                        <input type="number" name="dado" value="<?php echo rand(1, 12); ?>" readonly>
                    </div>
                    <input type="hidden" name="jugador_actual" value="<?php echo $_SESSION['turno']; ?>">
                    <button type="submit">LANZAR</button>
                </form>

                <?php
                if (isset($_SESSION['posiciones']) && $_SESSION['posiciones'] != "" ) {
                    $jugador_actual = $_POST['jugador_actual'] ?? $_SESSION['turno'];
                    if ($_SESSION['posiciones'][$jugador_actual] > 0) {
                        $posicion_actual = $_SESSION['posiciones'][$jugador_actual];
                        if ($posicion_actual == 6) {
                            $_SESSION['posiciones'][$jugador_actual] = 25;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 6 y ahora subió a la casilla No. 25 </h4>";
                        } elseif ($posicion_actual == 20) {
                            $_SESSION['posiciones'][$jugador_actual] = 40;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 20 y ahora subió a la casilla No. 40 </h4>";
                        } elseif ($posicion_actual == 34) {
                            $_SESSION['posiciones'][$jugador_actual] = 9;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 34 y ahora bajó a la casilla No. 9 </h4>";
                        } elseif ($posicion_actual == 59) {
                            $_SESSION['posiciones'][$jugador_actual] = 24;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 59 y ahora bajó a la casilla No. 24 </h4>";
                        } elseif ($posicion_actual == 55) {
                            $_SESSION['posiciones'][$jugador_actual] = 85;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 55 y ahora subió a la casilla No. 85 </h4>";
                        } elseif ($posicion_actual == 87) {
                            $_SESSION['posiciones'][$jugador_actual] = 52;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 87 y ahora bajo a la casilla No. 52 </h4>";
                        } elseif ($posicion_actual == 62) {
                            $_SESSION['posiciones'][$jugador_actual] = 81;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 62 y ahora subió a la casilla No. 81 </h4>";
                        } elseif ($posicion_actual == 99) {
                            $_SESSION['posiciones'][$jugador_actual] = 64;
                            echo "<h4 class='text-white text-justify'> ".$jugador_actual. " cayó en la casilla No. 99 y ahora bajó a la casilla No. 64 </h4>";
                        } elseif ($posicion_actual >= 100) {
                            $_SESSION['posiciones'][$jugador_actual] = 100;
                            ?>
                            <form action="#" method="post" id="formulario">
                                <h4>FELICIDADES! HAZ GANADO <?php echo $jugador_actual; ?></h4>
                                <input type="hidden" value="LO HAZ LOGRADO" name="reiniciar">
                                <button type="submit" id="boton">REINICIAR </button>
                            </form>
                            <?php
                            $_SESSION['total_avanzado'] = $total_avanzado;
                            session_regenerate_id();
                        } else {

                            echo "<br><br>". $jugador_actual. " Avanzo: " . $avanzar . " casillas";
                        }
                    }
                }
                ?>
            </div>
            <div class="col-2 jugadores">
                <div class="fichas-jugadores">
                    <?php echo $_SESSION['jugador1'] . "<br>"; ?>
                    <div class="ficha-jugador jugador1"></div>
                    <?php echo $_SESSION['jugador2'] . "<br>"; ?>
                    <div class="ficha-jugador jugador2"></div>
                    <?php echo $_SESSION['jugador3'] . "<br>"; ?>
                    <div class="ficha-jugador jugador3"></div>
                </div>
                <?php
                ?>
            </div>
            <div class="col-7">
                <?php
                $fila_columas = 10;
                $contador = 100;
                $colores = ['green', 'yellow', 'white', 'brown'];
                ?>
                
                <img src="escalera.png"
                    style="z-index: 2; position: absolute; width: 50px; height: 175px; margin-top: 36%; margin-left: 1%; ">
                <img src="escalera.png"
                    style="z-index: 2; position: absolute; width: 50px; height: 300px; margin-top: 5%; margin-left: 25%; transform: rotate(-8deg) ">
                <img src="escalera.png"
                    style="z-index: 2; position: absolute; width: 50px; height: 220px; margin-top: 40%; margin-left: 25%; transform: rotate(-8deg) ">
                <img src="escalera.png"
                    style="z-index: 2; position: absolute; width: 50px; height: 240px; margin-top: 5%; margin-left: 3%; transform: rotate(-15deg) ">
                <img src="serpiente.png"
                    style="z-index: 2; position: absolute; width: 150px; height: 255px; margin-top: 35%; margin-left: 33%;">
                <img src="serpiente.png"
                    style="z-index: 2; position: absolute; width: 170px; height: 280px; margin-top: 23%; margin-left: 6%; ">
                <img src="serpiente.png"
                    style="z-index: 2; position: absolute; width: 170px; height: 300px; margin-top: 5%; margin-left: 32%; ">
                <img src="serpiente.png"
                    style="z-index: 2; position: absolute; width: 170px; height: 300px; margin-top: 0%; margin-left: 6%; ">
                <?php
                echo "<table style='z-index: 1;' >";

                for ($i = 0; $i < $fila_columas; $i++) {
                    $a = 9;
                    echo "<tr>";
                    for ($j = 0; $j < $fila_columas; $j++) {
                        $color = rand(0, count($colores) - 1);
                        $color_elegido = $colores[$color];

                        if ($i % 2 != 0) {
                            $contador2 = $contador - ($a - $j);
                            $casilla = $contador2;
                        } else {
                            $casilla = $contador;
                        }

                        $ficha_mostrada = '';
                        if (($_SESSION['posiciones']) != '') {
                            foreach ($_SESSION['posiciones'] as $jugador => $posicion) {

                                if ($posicion == $casilla) {
                                    $numero_jugador = $jugadores_numeros[$jugador];
                                    $clase_jugador = 'jugador' . $numero_jugador;
                                    $ficha_mostrada = "<div style='z-index: 2;' class='ficha-jugador $clase_jugador'></div>";
                                }
                            }
                        }

                        if ($ficha_mostrada != '') {
                            echo "<td style='width: 70px; height: 70px; background-color: $color_elegido;' class='jugador-actual'>$ficha_mostrada</td>";
                        } else {
                            echo "<td style=' width: 70px; height: 70px; background-color: $color_elegido;'><h3>$casilla</h3></td>";
                        }
                        $a--;
                        $contador--;
                    }
                    echo "</tr>";
                }

                echo "</table>";

                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>