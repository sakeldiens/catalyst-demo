<?php
namespace Sample\Fs;

use Exception;

class Directory {

	private string $path;

	public function __construct(string $path) {
		$this->path = $path;
	}

	/**
	 * Checks whether the given path is a directory
	 * 
	 * @return bool
	 */
	public function exists(): bool {
		return is_dir($this->path);
	}

	/**
	 * Creates a new directory in the path specified
	 * 
	 * @param int Permissions needed to be set on path
	 * @return bool
	 * @throws Exception
	 */
	public function create($permissions = 0755): bool {
		if (!$this->exists()) {
			return mkdir($this->path, $permissions, true);
		}
		throw new Exception("Directory already exists: " . $this->path);
	}

	/**
	 * Deletes directory
	 * 
	 * @return bool
	 * @throws Exception
	 */
	public function delete(): bool {
		if ($this->exists()) {
			return rmdir($this->path);
		} 
		throw new Exception("Directory does not exist: " . $this->path);
	}

	/**
	 * List files and directories inside the specified path
	 * 
	 * @return array
	 * @throws Exception
	 */
	public function listContents(): array {
		if ($this->exists()) {
			return scandir($this->path);
		}
		throw new Exception("Directory does not exist: " . $this->path);
	}

	/**
	 * Returns the path of the directory
	 * 
	 * @return string
	 */
	public function path(): string {
		return $this->path;
	}

	/**
	 * Returns the name of the directory
	 * 
	 * @return string
	 */
	public function name(): string {
		return basename($this->path);
	}
}