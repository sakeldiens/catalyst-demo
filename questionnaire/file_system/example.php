<?php
require_once __DIR__ .'/vendor/autoload.php';

use Sample\Fs\File;
use Sample\Fs\Directory;

try {
	// 1. Example of how to use files..
	// ---------------------------------

   $file = new File('./testdata/file9.txt');

   if ($file->exists()) {
		echo "File content: " . $file->read();
   } else {
		$file->write("Hello, World!");
   }

   $file->append("\nThis row was appended to the file.");
   echo "File size: " . $file->size();
   $file->delete();

   // 2. Example of how to use directories..
	// --------------------------------------

   $dir = new Directory("./testdata/dir2");
   if (!$dir->exists()) {
		$dir->create();
   }

   $contents = $dir->listContents();
   foreach ($contents as $item) {
		echo $item . PHP_EOL;
   }
	// remove directory
   $dir->delete();

} catch (Exception $e) {
   echo "Error: " . $e->getMessage() . PHP_EOL;
}