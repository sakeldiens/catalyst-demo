<?php
namespace Sample\Fs;

use Exception;

class Directory {
   private string $name;
   private array $contents;

   public function __construct($name) {
      $this->name = $name;
      $this->contents = [];
   }

   public function name() {
      return $this->name;
   }

   public function addContent(File|Directory $item): void {
      if (!($item instanceof File) && !($item instanceof Directory)) {
         throw new Exception("Invalid item type.");
      }
      $this->contents[] = $item;
   }

   public function isDir(): bool {
      return true === ($this instanceof Directory);
   }

   public function listContents(): array {
      $names = [];
      foreach ($this->contents as $item) {
         $names[] = $item->name();
      }
      return $names;
   }

   public function __toString(): string {
      return "Directory: " . $this->name . PHP_EOL;
   }
}