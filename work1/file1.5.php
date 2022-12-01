<?php
$bmw = [
    'model' => 'X5',
    'speed' => 120,
    'doors' => 5,
    'year' => 2015
];

$toyota = [
    'model' => 'RAV4',
    'speed' => 100,
    'doors' => 4,
    'year' => 2019
];

$opel = [
    'model' => 'Vectra',
    'speed' => 100,
    'doors' => 4,
    'year' => 2020
];

$cars = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];

foreach ($cars as $name => $car) {
    echo "CAR $name<br>";
    echo "{$car['model']} {$car['speed']} {$car['doors']} {$car['year']}<br><br>";
}