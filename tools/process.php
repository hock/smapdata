<?php
$files = scandir(".");
natsort($files);
$short = <<<HTM
	<!DOCTYPE html>
	<html>
	<head>
		<title>Sourcemap User Generated Content Archive</title>
		<link rel="stylesheet" href="list.css">
	</head>

	<body>
	<div id="wrapper">
		<div id="overview">
		<h1>Sourcemap User Generated Content Archive</h1>
		
		<p>This page provides a simple interface to a github repository of the publicly shared supply chains produced for the sourcemap platform. Each entry provides links to the raw supply chain description (smap) file, a simple geodata file, and a link to view the entry in the Manifest supply chain viewer.</p>
		</div>
		
		<div id="listcontainer">
		<ul id="mlist">


	
HTM;

foreach($files as $file) {
	
	$strJsonFileContents = file_get_contents($file);

	$array = json_decode($strJsonFileContents, true);
	if(isset($array["supplychain"])) {
		$short .= "<li><div></div>".$array["supplychain"]["id"]." : ".$array["supplychain"]["attributes"]["title"]." [<a href=\"https://rawcdn.githack.com/hock/Manifest/d67cd9577e97286e0ed262d331a6e4553ab31980/index.html#".$array["supplychain"]["id"]."\">View in Manifest</a>] [<a href=\"https://github.com/hock/smapdata/blob/master/data/".$array["supplychain"]["id"].".json\">Source Data</a>] [<a href=\"https://github.com/hock/smapdata/blob/master/data/".$array["supplychain"]["id"].".geojson\">Geodata</a>]</li>";
	}
}

$short .= "	</ul></div></div></body></html>";

file_put_contents("list.html", $short);
echo $short;

?>