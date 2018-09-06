<?php

use App\Classes\iNonce;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$config = include 'config.php';

$capsule->addConnection($config);

$capsule->bootEloquent();

iNonce::setSalt($config['salt']);