<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Wind\WindCalculator;

$wind = new WindCalculator();
$q = $wind->calculate('II', 'II', 0.8);

echo "Obciążenie wiatrem: $q kN/m²";
