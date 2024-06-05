<?php

use Sample\Fs\Directory;

/**
 * @BeforeMethods({"init"})
 * @Revs(1000)
 * @Iterations(5)
 */
class FileBenchmark {

   private static $dir;

   public function init() {
      $dir = "./testdata/dir1";
      self::$dir = new Directory($dir);
   }

   /**
    * @Subject
    */
   public function benchCreate() {
      self::$dir->create(100, 100);
   }

   /**
    * @Subject
    */
    public function benchListContents() {
      self::$dir->listContents(100, 100);
   }
}