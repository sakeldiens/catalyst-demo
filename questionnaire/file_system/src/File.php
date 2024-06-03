<?php
namespace Sample\Fs;

class File {
   private string $name;
   private string $content;

   public function __construct(string $name, string $content = "") {
      $this->name = $name;
      $this->content = $content;
   }

   public function name() : string {
      return $this->name;
   }

   public function content(string $content = "") : string|null {
      if ($content === "") {
         return $this->content;
      }
      $this->content = $content;
   }

   public function __toString() : string {
      return "File: " . $this->name . PHP_EOL;
   }
}