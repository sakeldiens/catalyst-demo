<?php
namespace Sample\Fs;

use Exception;
use Sample\Fs\File;
use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase {

	private File $file;

	public function setUp(): void { /* Not really needed here */ }

	function testNameGetter() {
		$filename = './testdata/test1.txt';
		$file = new File($filename);
		$bname = basename($filename);
		$this->assertEquals($bname, $file->name());
	}

	function testFilenameGetter() {
		$filename = './testdata/test1.txt';
		$file = new File($filename);
		$this->assertEquals($filename, $file->filename());
	}

	function testFileExists() {
		$filename = './testdata/test1.txt';
		$this->assertFileExists($filename);

		$file = new File($filename);
		$exists = $file->exists();
		$this->assertTrue($exists);
		$this->assertFalse(!$exists);
	}

	function testFileNotExists() {
		$filename = './uvw753one.txt';
		$this->assertFileDoesNotExist($filename);

		$file = new File($filename);
		$notexists = $file->exists();
		$this->assertFalse($notexists);
		$this->assertTrue(!$notexists);
	}

	function testReadFile() {
		$file = new File('./testdata/test1.txt');
		$contents = $file->read();
		$this->assertIsString($contents);
		$this->assertNotEmpty($contents);
	}

	function testReadFileFails() {
		self::markTestIncomplete("This test has not been implemented yet.");
	}

	function testReadFileFThrowsException() {
		$file = new File('./ab1-cd2-efg3.txt');
		$this->expectException(Exception::class);
		$contents = $file->read();
	}

	function testWriteFile() {
		$file = new File('./cloud9.txt');
		$result = $file->write("PHPUnit writing a line of text.");
		$this->assertNotEmpty($result);
		$this->assertIsInt($result);
	}

	function testWriteFileFails() {
		self::markTestIncomplete("This test has not been implemented yet.");
	}

	function testFileAppend() {
		$file = new File('./testdata/test1.txt');
		$result = $file->append("PHPUnit appending a line of text.");
		$this->assertNotEmpty($result);
		$this->assertIsInt($result);
	}

	function testDeleteFile() {
		$file = new File('./cloud9.txt');
		$result = $file->delete();
		$this->assertTrue($result);
		
		$notexists = $file->exists();
		$this->assertFalse($notexists);
		$this->assertTrue(!$notexists);
	}

	function testDeleteFileFails() {
		self::markTestIncomplete("This test has not been implemented yet.");
	}

	function testDeleteFileThrowsException() {
		$file = new File('./abc-xyz.txt');
		$this->expectException(Exception::class);
		$result = $file->delete();
	}

	function testGetFileSize() {
		$file = new File('./testdata/test1.txt');
		$size = $file->size();
		$this->assertNotEmpty($size);
		$this->assertIsInt($size);
	}

	function testtestGetFileSizeFails() {
		self::markTestIncomplete("This test has not been implemented yet.");
	}

	function testGetFileSizeThrowsException() {
		$file = new File('./abc-xyz.txt');
		$this->expectException(Exception::class);
		$result = $file->size();
	}

	function tearDown(): void {
		$this->file = null;
  	}
}