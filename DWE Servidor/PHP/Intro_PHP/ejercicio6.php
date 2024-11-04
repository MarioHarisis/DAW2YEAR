<?php

$totalPlayer1 = 0;
$totalPlayer2 = 0;
$a = 1;
while ($a <= 2) {
    for ($i = 0; $i < 3; $i++) {
        $dado = rand(1, 6);
        echo "<img src='./ejercicios/dados/$dado.jpg' width='100' height='100'>\n";
        if ($a == 1) {
            $totalPlayer1 += $dado;
        } else {
            $totalPlayer2 += $dado;
        }
    }
    $a++;
    echo "<br>";
}

echo "Total puntos player 1: " . $totalPlayer1;
echo "<br>";
echo "Total puntos player 2: " . $totalPlayer2;
echo "<br>";
if ($totalPlayer1 > $totalPlayer2) {
    echo "PLAYER 1 WINS!!";
} else if ($totalPlayer1 == $totalPlayer2) {
    echo "EMPATE!!";
} else {
    echo "PLAYER 2 WINS!!";
}
