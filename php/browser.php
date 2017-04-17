<?php
/**
 * Created by IntelliJ IDEA.
 * User: alejandrorioscalera
 * Date: 17/4/17
 * Time: 0:37
 */


/** @INSPECTOR **/

if ($_GET['lang'] == null || $_GET['text'] == null){

    header("Location: ?lang=null&text=null");

    return true;
}