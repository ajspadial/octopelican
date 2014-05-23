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

$filenames = array_slice($argv, 1);

foreach ($filenames as $target) {
	$filename = realpath($target);
	$content = file_get_contents($filename);

	$parts = explode('---', $content);

	$tokens = count($parts);

	$header = explode("\n", $parts[$tokens - 2]);
	$body = $parts[$tokens - 1];

	$newHeader = "";

	foreach ($header as $headline) {
		$newHeader .= rewriteHeader($headline, 'Title:', 'Title:');
		$newHeader .= rewriteHeader($headline, 'date:', 'Date:');
		$newHeader .= rewriteHeader($headline, 'categories:', 'Tags:');
	}

	$newHeader .= "Category: Blog\n";
	$newHeader .= "Author: Antonio Jesus Sanchez Padial\n";

	file_put_contents($filename, $newHeader . $body);
}
