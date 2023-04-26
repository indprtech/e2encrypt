<?php
require_once __DIR__ . '/vendor/autoload.php';
/* Declarations */
include "system/Core.php";
$core = new Core();
//Perform Security Checks
$core->securityChecks();
//Tests
$db = $core->library("db");

/// =========================Database=====================================
//Task : 1 : Done
// var_dump($db->list("SELECT * FROM testtb"));
//Task : 2 : Done
//print_r($db->add("testtb" , ['d1' => '1' , 'd2' => '1' , 'd4' => "SS"]));
//Task : 3 : Done
//$db->edit("testtb" , 3 , ['d1' => '2' , 'd2' => '1']);
//Task : 4 : Done
//$db->delete("testtb","id",0,['1','3']);
// ========================================================================

// =========================Controllers=====================================
//Task : 1 : Done
// include("src/Controllers/WelcomeController.php");
// $wc = new Welcome();
// $default = $wc->defaultController;
// $wc->$default();
// =========================================================================

$core->initApp();