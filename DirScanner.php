<?php


namespace DirScanner;


/**
 * DirScanner
 * @author Lingtalfi
 * 2015-11-03
 *
 */
class DirScanner
{

    private $rootDir;
    private $followLinks;

    public function __construct()
    {
        $this->followLinks = false;
    }


    public static function create()
    {
        return new static();
    }

    public function scanDir($dir, $callable)
    {
        $ret = [];
        if (is_callable($callable)) {
            if (is_string($dir)) {
                if (file_exists($dir)) {
                    $dir = realpath($dir);
                    $this->rootDir = $dir;
                    $relDir = null;
                    $this->doScanDir($dir, $relDir, $callable, 0, $ret);
                }
                else {
                    throw new \RuntimeException("Dir not found: $dir");
                }
            }
            else {
                throw new \InvalidArgumentException(sprintf("dir argument must be of type string, %s given", gettype($dir)));
            }
        }
        else {
            throw new \InvalidArgumentException(sprintf("callable argument must be a callable, %s given", gettype($callable)));
        }
        return $ret;
    }

    public function setFollowLinks($followLinks)
    {
        $this->followLinks = (bool)$followLinks;
        return $this;
    }



    //------------------------------------------------------------------------------/
    // 
    //------------------------------------------------------------------------------/
    private function doScanDir($dir, $relDir, $callable, $level, array &$ret)
    {
        if (file_exists($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ('.' !== $file && '..' !== $file) {
                    $path = $dir . '/' . $file;
                    if (null !== $relDir) {
                        $rPath = $relDir . '/' . $file;
                    }
                    else {
                        $rPath = $file;
                    }
                    $ret[] = call_user_func($callable, $path, $rPath, $level);
                    if (is_dir($path) &&
                        (
                            !is_link($path) ||
                            true === $this->followLinks
                        )
                    ) {
                        $this->doScanDir($path, $rPath, $callable, $level + 1, $ret);
                    }
                }
            }
        }
        else {
            $this->error("dir does not exist: $dir");
        }
    }


    protected function error($msg)
    {
        throw new \RuntimeException($msg);
    }
}
