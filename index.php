<?php
require_once __DIR__ . '/vendor/autoload.php';
/* Declarations */
include "system/Core.php";
$core = new Core();
//Perform Security Checks
$core->securityChecks();
//Init App
$core->initApp();