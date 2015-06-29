<?php
error_reporting(E_ALL);
ini_set('display_error',1);

/* Autoloaders are soooo nice :) */
require_once 'GetterSetter.php';
require_once 'Localization.php';
require_once 'Sensors.php';
require_once 'Robot.php';
require_once 'Movement.php';

$config = [
    // Probability adjustment that we are right
    'pHit' => 0.6,
    // Probability adjustment that we are wrong
    'pMiss' => 0.2,
    // Representation of our world. Assume a corridor  with five doors, two green and three red.
    'world' => ['green', 'red', 'red', 'green', 'green'],
    // That what the system is thinking where it is.
    'probabilityMatrix' => [0, 1, 0, 0, 0],
//    'probabilityMatrix' => [0.2, 0.2, 0.2, 0.2, 0.2],
    'biasMatrix' => [ // todo Move to extra class and assure that the sum of the biasMatrix can not exceed 1.0
        'over' => 0.1,  // Chance that we overshoot slightly
        'under' => 0.1, // Chance that we undershoot shoot slightly
        'exact' => 0.8  // Chance that we hit our new position on the first try
    ]
];

$moveProgram = [1, 1];

// Let's build us a robot :)
$robot = new Robot($config);
$robot->setSensor( new Sensors([]) )
    ->setLocalization( new Localization([]) )
    ->setMovement(new Movement($config['biasMatrix']));

foreach ($robot->getSensor() as $i => $sensorData) {
    $robot->sense($sensorData);
    $robot->move($moveProgram[$i]);
}
$robot->showWorld();






