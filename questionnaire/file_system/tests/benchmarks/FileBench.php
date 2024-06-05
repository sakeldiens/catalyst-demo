<?php

use Sample\Fs\File;

/**
 * @BeforeMethods({"init"})
 * @Revs(1000)
 * @Iterations(5)
 */
class FileBenchmark {

   private static $file;

   public function init() {
      $filename = "./testdata/dir1/fil1.txt";
      self::$file = new File($filename);
   }

   /**
    * @Subject
    */
   public function benchRead() {
      self::$file->read(100, 100);
   }

   /**
    * @Subject
    */
   public function benchWrite() {
      self::$file->write(100, 100);
   }

   /**
    * @Subject
    */
   public function benchAppend() {
      self::$file->append(100, 100);
   }

   /**
    * @Subject
    */
   public function benchSize() {
      self::$file->size(100, 100);
   }
}