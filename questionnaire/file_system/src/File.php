<?php
namespace Sample\Fs;

use Exception;

class File {

	// path+filename
	private string $filename;

	public function __construct(string $filename) {
		$this->filename = $filename;
	}

	/**
	 * Checks if the file exists
	 * 
	 * @return false Returns true if the file or directory specified by filename exists; false otherwise.
	 */
	public function exists(): bool {
		return file_exists($this->filename);
	}

	/**
	 * Reads entire file into a string
	 * 
	 * @return string|false Returns the read data or false on failure.
	 * @throws Exception
	 */ 
	public function read(): string|false {
		if ($this->exists()) {
			return file_get_contents($this->filename);
		}
		throw new Exception("Error reading file: " . $this->filename);
	}

	/**
	 * Writes a string to a file.
	 * 
	 * @param string 		Content
	 * @return int|false Returns the number of bytes that were written to the file, or false on failure. 
	 */ 
	public function write(string $content): int|false {
		return file_put_contents($this->filename, $content, FILE_APPEND | LOCK_EX);
	}

	/**
	 * Append content to existing file.
	 * 
	 * @param string 		Content
	 * @return int|false Returns the number of bytes that were written to the file, or false on failure. 
	 */
	public function append(string $content): int|false {
		return file_put_contents($this->filename, $content, FILE_APPEND | LOCK_EX);
	}

	/**
	 * Deletes a file
	 * 
	 * @return bool True if file was deleted successfully, false otherwise.
	 * @throws Exception
	 */
	public function delete(): bool {
		if ($this->exists()) {
			return unlink($this->filename);
		} 
		throw new Exception("Unable to delete file: " . $this->filename);
	}

	/**
	 * Returns the file size
	 * 
	 * @return int|false Size of the file in bytes, or false (and generates an error of level E_WARNING) in case of an error.
	 * @throws Exception
	 */
	public function size(): int|false {
		if ($this->exists()) {
			return filesize($this->filename);
		}
		throw new Exception("File does not exist: " . $this->filename);
	}

	/**
	 * Returns the base name of the file 
	 * 
	 * @return string
	 */
	public function name(): string {
		return basename($this->filename);
	}

	/**
	 * Returns the filename (path+filename)
	 * 
	 * @return string
	 */
	public function filename(): string {
		return $this->filename;
	}
}