<?php
namespace Sample\Fs;

class FileSystem {
    private Directory $root;

    public function __construct() {
        $this->root = new Directory("/");
    }

    public function root() {
        return $this->root;
    }

    public function addContentToRoot(Directory|File $contentItem) {
        $this->root->addContent($contentItem);
    }

    public function listRootContents() {
        return $this->root->listContents();
    }
}