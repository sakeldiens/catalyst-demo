<?php
require_once __DIR__ .'/vendor/autoload.php';

use Sample\Fs\File;
use Sample\Fs\Directory;
use Sample\Fs\FileSystem;

$fileSystem = new FileSystem();

$file1 = new File("testfile1.txt", "Test content of file1.");
$file2 = new File("testfile2.txt", "Test content of file2.");

$directory1 = new Directory("test-directory-1");
$directory2 = new Directory("test-directory-2");

$directory1->addContent($file1);
$directory2->addContent($file2);

$fileSystem->addContentToRoot($directory1);
$fileSystem->addContentToRoot($directory2);

echo "Root Contents:\n";
$rootContents = $fileSystem->listRootContents();
foreach ($rootContents as $contentName) {
	echo "- $contentName" . PHP_EOL;
}

// Prints the contents recursively
function printContents(array $contents, $indentCount = 0) {
	$indent = str_repeat(' ', $indentCount * 2);
	foreach ($contents as $name) {
		echo $indent . htmlspecialchars($name) . PHP_EOL;
		// echo "- $contentName\n";
	}
}

// public function printContents($indent = 0) {
// 	$indentation = str_repeat(' ', $indent * 2); // 2 spaces per indent
// 	echo $indentation . "Directory: " . htmlspecialchars($this->name) . PHP_EOL;
// 	foreach ($this->items as $item) {
// 		 $item->printContents($indent + 1);
// 	}
// }