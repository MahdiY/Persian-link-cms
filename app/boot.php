<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$db = include 'config.php';

$capsule->addConnection( $db );

$capsule->bootEloquent();