<?php

abstract class FileSystemItem {
    protected $name;
    protected $path;

    public function __construct($path) {
        $this->path = realpath($path);
        $this->name = basename($this->path);
    }

    public function getName() {
        return $this->name;
    }

    public function getPath() {
        return $this->path;
    }

    abstract public function printContents($indent = 0);
}

class FileItem extends FileSystemItem {
    public function printContents($indent = 0) {
        $indentation = str_repeat(' ', $indent * 2); // 2 spaces per indent
        echo $indentation . "File: " . htmlspecialchars($this->name) . "\n";
    }
}

class DirectoryItem extends FileSystemItem {
   private $items = [];

   public function __construct($path) {
       parent::__construct($path);
       $this->scanDirectory();
   }

   private function scanDirectory() {
       $files = scandir($this->path);

       foreach ($files as $file) {
           if ($file === '.' || $file === '..') {
               continue;
           }

           $fullPath = $this->path . DIRECTORY_SEPARATOR . $file;
           if (is_dir($fullPath)) {
               $this->items[] = new DirectoryItem($fullPath);
           } else {
               $this->items[] = new FileItem($fullPath);
           }
       }
   }

   public function printContents($indent = 0) {
       $indentation = str_repeat(' ', $indent * 2); // 2 spaces per indent
       echo $indentation . "Directory: " . htmlspecialchars($this->name) . "\n";
       foreach ($this->items as $item) {
           $item->printContents($indent + 1);
       }
   }
}

// Usage
try {
    $rootDir = '/Users/tharwat/Documents/UK/Catalyst/workspace/file_system'; // Change this to the desired directory
    $rootDirectoryItem = new DirectoryItem($rootDir);
    $rootDirectoryItem->printContents();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>