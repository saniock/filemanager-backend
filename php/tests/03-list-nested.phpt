--TEST--
Basic operations
--FILE--
<?php

if (!function_exists("listlog")){
	function listlog($data, $level){
		foreach ($data as $key => $value){
			echo $level.$value["value"].", ".$value["type"].", ".$value["size"].", ".$value["id"]."/n";
			if (isset($value["data"]))
				listlog($value["data"], $level."- ");
		}
	}
}

include_once dirname(__FILE__) . "/../CommandFileSystem.php";
include_once dirname(__FILE__) . "/../PHPFileSystem.php";
include_once dirname(__FILE__) . "/../FlyFileSystem.php";

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;

$sandbox = realpath(__DIR__."/sandbox");

$api = new CommandFileSystem($sandbox);
$api->test = true;

$data = $api->ls("/", true);
listlog($data,"");

$api = new PHPFileSystem($sandbox);
$api->test = true;

$data = $api->ls("/", true);
listlog($data,"");

$filesystem = new Filesystem(new Adapter($sandbox));
$api = new LocalFlyFileSystem($filesystem, $sandbox);
$api->test = true;

$data = $api->ls("/", true);
listlog($data,"");

?>
--EXPECTF--
List {!}/
List {!}/sub1/
List {!}/sub1/sub2/
sub1, folder, 0, sub1
- sub2, folder, 0, sub1/sub2
- - LICENSE, , 1067, sub1/sub2/LICENSE
- - README.md, text, 28368, sub1/sub2/README.md
- - zalgo.js, code, 53, sub1/sub2/zalgo.js
- Makefile, , 532, sub1/Makefile
D230604.txt, text, 6, D230604.txt
D231019.txt, text, 6, D231019.txt
D231440.txt, text, 6, D231440.txt
D234028.txt, text, 6, D234028.txt
D236850.txt, text, 6, D236850.txt
D242865.txt, text, 6, D242865.txt
D260541.txt, text, 6, D260541.txt
E223016.txt, text, 6, E223016.txt
List {!}/
List {!}/sub1/
List {!}/sub1/sub2/
sub1, folder, 0, sub1
- sub2, folder, 0, sub1/sub2
- - LICENSE, , 1067, sub1/sub2/LICENSE
- - README.md, text, 28368, sub1/sub2/README.md
- - zalgo.js, code, 53, sub1/sub2/zalgo.js
- Makefile, , 532, sub1/Makefile
D230604.txt, text, 6, D230604.txt
D231019.txt, text, 6, D231019.txt
D231440.txt, text, 6, D231440.txt
D234028.txt, text, 6, D234028.txt
D236850.txt, text, 6, D236850.txt
D242865.txt, text, 6, D242865.txt
D260541.txt, text, 6, D260541.txt
E223016.txt, text, 6, E223016.txt
List {!}/
List {!}/sub1/
List {!}/sub1/sub2/
sub1, folder, 0, sub1
- sub2, folder, 0, sub1\sub2
- - LICENSE, , 1067, sub1\sub2\LICENSE
- - README.md, text, 28368, sub1\sub2\README.md
- - zalgo.js, code, 53, sub1\sub2\zalgo.js
- Makefile, , 532, sub1\Makefile
D230604.txt, text, 6, D230604.txt
D231019.txt, text, 6, D231019.txt
D231440.txt, text, 6, D231440.txt
D234028.txt, text, 6, D234028.txt
D236850.txt, text, 6, D236850.txt
D242865.txt, text, 6, D242865.txt
D260541.txt, text, 6, D260541.txt
E223016.txt, text, 6, E223016.txt
