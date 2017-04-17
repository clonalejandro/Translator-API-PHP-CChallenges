<?php
/**
 * Created by IntelliJ IDEA.
 * User: alejandrorioscalera
 * Date: 15/4/17
 * Time: 22:53
 */


/** @IMPORTS **/

require __DIR__ . '../api/main.php';

require_once ("../config.php");

use clonalejandro\main;


/** @SMALL_CONSTRUCTORS **/

$lang = $_GET["lang"];
$text = $_GET['text'];


/** @REST **/

$translator = new main();

$translated = $translator -> translate($base, $lang, $text);


/** @RESULT **/

echo $translated;