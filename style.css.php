<?php

header("Content-type:text/css; charset=UTF-8");
header("Cache-Control:must-revalidate");

$offset = 60 * 60 ;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s",time() + $offset) . " GMT";
header($ExpStr);

$path = getcwd();

// less compiler
require_once 'less.php/Less.php';

$less_files = array(
	$path . "/style.less" => ""
);

$options = array(
	//'compress' => true,
	"cache_dir" => $path . "/cache"
);

$css_file_name = Less_Cache::Get($less_files, $options);
echo file_get_contents($path . "/cache/" . $css_file_name);

?>