<?php namespace Filebase\Support;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as FS;

/**
 * The filesystem controls the files
 * and diretories of Filebase
 * 
 * Filesystem uses 
 * @see https://flysystem.thephpleague.com/docs/
 * 
 */
class Filesystem
{

    /**
     * Filesystem property
     * 
     * @var League\Flysystem\Filesystem
     */
    public $filesystem;

    /**
     * Filesystem starter
     * 
     * @param string $path
     */
    public function __construct($path)
    {
        $this->filesystem = new FS((new Local($path)));
    }

    /**
     * Read a specific file
     * 
     * @param string $path
     */
    public function read($path)
    {
        return $this->filesystem->read($path);
    }

    /**
     * Check if a file exist
     * 
     * @param string $path
     * @return boolean
     */
    public function has($path)
    {
        return $this->filesystem->has($path);
    }

    /**
     * Write to a specific file and
     * create one if non-exists
     * 
     * @param string $path
     * @param string $data
     */
    public function write($path, $data = '')
    {
        return $this->filesystem->write($path, $data);
    }

    /**
     * delete spceific file
     * 
     * @param string $path
     */
    public function delete($path)
    {
        return $this->filesystem->delete($path);
    }

    /**
     * Get all folders within directory
     * 
     * @param string $path
     */
    public function folders($path = '')
    {
        $items = $this->filesystem->listContents($path);

        $folder = [];
        foreach($items as $item) {
            if ($item['type']=='dir') {
                $folder[] = $item;
            }
        }

        return $folder;
    }

    /**
     * Get all files within directory
     * 
     * @param string $path
     */
    public function files($path = '')
    {
        $items = $this->filesystem->listContents($path);

        $files = [];
        foreach($items as $item) {
            if ($item['type']=='file') {
                $files[] = $item;
            }
        }

        return $files;
    }

    /**
     * Create Directory
     * 
     * @param string $path
     */
    public function mkdir($path)
    {
        return $this->filesystem->createDir($path);
    }

    /**
     * Remove Directory (deletes directory and its contents)
     * 
     * @param string $path
     */
    public function rmdir($path)
    {
        return $this->filesystem->deleteDir($path);
    }

}
