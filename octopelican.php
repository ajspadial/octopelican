<?php

function rewriteHeader($headline, $oldTag, $newTag) {
	if (strpos($headline, $oldTag) === 0) {
		$data = substr($headline, strlen($oldTag));
		$data = str_replace('"', '', $data);
		return $newTag . $data . "\n";
	}
	else {
		return NULL;
	}
}

function rewriteImage($url) {
	static $images = 0;

	return "![Image " . ++$images . "]($url)";
}

if (count($argv) < 2) {
  echo "Too few params. Need a file name to apply changes.";
  exit -1;
}

$filenames = array_slice($argv, 1);

foreach ($filenames as $target) {
	$filename = realpath($target);
	$content = file_get_contents($filename);

	$parts = explode('---', $content);

	$tokens = count($parts);

	$header = explode("\n", $parts[$tokens - 2]);
	$body = $parts[$tokens - 1];

	// 1. Process header
	$newHeader = "";

	foreach ($header as $headline) {
		$newHeader .= rewriteHeader($headline, 'title:', 'Title:');
		$newHeader .= rewriteHeader($headline, 'date:', 'Date:');
		$newHeader .= rewriteHeader($headline, 'categories:', 'Tags:');
	}

	$newHeader .= "Category: Blog\n";
	$newHeader .= "Author: Antonio Jesus Sanchez Padial\n";

	// 2. Process body
	
	// 2.1. Process images
	$body = preg_replace_callback("/{% img (http:\/\/[_A-Za-z0-9\.\/]+) %}/", function ($matches){  return rewriteImage($matches[1]);}, $body);

	file_put_contents($filename, $newHeader . $body);
}
