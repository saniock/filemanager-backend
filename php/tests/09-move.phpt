--TEST--
Basic operations
--FILE--
<?php

include_once dirname(__FILE__) . "/../CommandFileSystem.php";
$sandbox = realpath(__DIR__."/sandbox");

$api = new CommandFileSystem($sandbox);
$api->test = true;
$api->mv("D230604.txt", "sub1\\sub2");
$api->mv("sub1\\sub2", "");

?>
--EXPECTF--
move {!}/D230604.txt {!}/sub1/sub2
robocopy {!}/sub1/sub2 {!}/sub2 /e /move
