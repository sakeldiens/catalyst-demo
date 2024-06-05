<?php
namespace Sample\Fs;

use Exception;
use Sample\Fs\Directory;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertNotEmpty;

final class DirectoryTest extends TestCase {

	private Directory $dir;

	public function setUp(): void { /* Not really needed here */ }

	function testNameGetter() {
		$path = './';
		$this->dir = new Directory($path);
		$bname = basename($path);
		$this->assertEquals($bname, $this->dir->name());
	}

   function testPathGetter() {
		$path = './';
		$this->dir = new Directory($path);
		$this->assertEquals($path, $this->dir->path());
	}

   function testDirectoryExists() {
		$path = './';
		$this->assertDirectoryExists($path);

		$this->dir = new Directory($path);
		$exists = $this->dir->exists();
		$this->assertTrue($exists);
		$this->assertFalse(!$exists);
	}

	function testDirectoryNotExists() {
		$path = './nothinghere';
		$this->assertDirectoryDoesNotExist($path);

		$this->dir = new Directory($path);
		$notexists = $this->dir->exists();
		$this->assertFalse($notexists);
		$this->assertTrue(!$notexists);
	}

   function testCreateDirectory() {
      $this->dir = new Directory('./testdata/nowXYZ');
		$result = $this->dir->create();
		$this->assertTrue($result);

      if ($this->dir->exists()) {
         $this->dir->delete();
      }
   }

   function testCreateDirectoryThrowsAlreadyExistsException() {
      $this->dir = new Directory('./testdata/dir1');
      $this->expectException(Exception::class);
		$result = $this->dir->create();
   }

   function testDeleteDirectory() {
      $path = "./testdata/nowXYZ";
      $this->dir = new Directory($path);
		$result = $this->dir->create();
		$this->assertDirectoryExists($path);

		$result = $this->dir->delete();
		$this->assertTrue($result);
		
		$notexists = $this->dir->exists();
		$this->assertFalse($notexists);
		$this->assertTrue(!$notexists);
	}

	function testDeleteFileThrowsNotExistsException() {
		$this->dir = new Directory('./testdata/cantfindme');
		$this->expectException(Exception::class);
		$result = $this->dir->delete();
	}

   function testListDirectoryContents() {
      $this->dir = new Directory('./testdata/dir1');
      $contents = $this->dir->listContents();
      $this->assertNotEmpty($contents);
      $this->assertIsArray($contents);
      $this->assertContains('fil1.txt', $contents, "directory doesn't contain value as file1.txt") ;
      $this->assertContains('fil2.txt', $contents, "directory doesn't contain value as file2.txt") ;
   }

   function testListDirectoryContentsNotExistsException() {
      $this->dir = new Directory('./testdata/mehiding');
		$this->expectException(Exception::class);
		$cotents = $this->dir->listContents();
   }

   function tearDown(): void {
		unset($this->dir);
  	}
}