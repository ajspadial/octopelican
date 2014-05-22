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

if (count($argv) < 2) {
  echo "Too few params. Need a file name to apply changes.";
  exit -1;
}
$filename = realpath($argv[1]);
echo "Parsing " . $filename . " ...\n";

$content = file_get_contents($filename);

$parts = explode('---', $content);

$header = explode("\n", $parts[1]);
$body = $parts[2];
$newHeader = "";

foreach ($header as $headline) {
	$newHeader .= rewriteHeader($headline, 'title:', 'Title:');
	$newHeader .= rewriteHeader($headline, 'date:', 'Date:');
	$newHeader .= rewriteHeader($headline, 'categories:', 'Tags:');
}

$newHeader .= "Category: Blog\n";
$newHeader .= "Author: Antonio Jesus Sanchez Padial\n";

echo $newHeader . $body;


