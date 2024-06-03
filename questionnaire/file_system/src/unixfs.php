<?php

class FileSystemItem {
    protected $name;
    protected $path;

    public function __construct($path) {
        $this->path = $path;
        $this->name = basename($path);
    }

    public function getName() {
        return $this->name;
    }

    public function getPath() {
        return $this->path;
    }

    public function isDirectory() {
        return is_dir($this->path);
    }

    public function isFile() {
        return is_file($this->path);
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

  public function getItems() {
      return $this->items;
  }

  public function printContents($indent = 0) {
      $indentation = str_repeat(' ', $indent * 4); // 4 spaces per indent
      echo $indentation . "Directory: " . htmlspecialchars($this->name) . "\n";
      foreach ($this->items as $item) {
          if ($item->isDirectory()) {
              $item->printContents($indent + 1);
          } else {
              echo str_repeat(' ', ($indent + 1) * 4) . "File: " . htmlspecialchars($item->getName()) . "\n";
          }
      }
  }
}

class FileItem extends FileSystemItem {
   public function printContents($indent = 0) {
       $indentation = str_repeat(' ', $indent * 4); // 4 spaces per indent
       echo $indentation . "File: " . htmlspecialchars($this->name) . "\n";
   }
}

// Usage
try {
   $rootDir = './'; // Change this to the desired directory
   $rootDirectoryItem = new DirectoryItem($rootDir);
   $rootDirectoryItem->printContents();
} catch (Exception $e) {
   echo "Error: " . $e->getMessage();
}

?>