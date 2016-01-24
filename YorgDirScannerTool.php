<?php


namespace DirScanner;


/**
 * YorgDirScannerTool
 * @author Lingtalfi
 * 2016-01-09
 *
 */
class YorgDirScannerTool
{


    /**
     * Return the list of directories of a given folder.
     *
     *
     * @param $dir
     * @param bool $recursive
     * @param bool $relativePath , whether or not to return the results as relative path (default is absolute paths)
     * @param bool $followSymlinks
     * @param bool $ignoreHidden
     * @return array
     *
     */
    public static function getDirs($dir, $recursive = false, $relativePath = false, $followSymlinks = false, $ignoreHidden = true)
    {
        return DirScanner::create()->setFollowLinks($followSymlinks)->scanDir($dir, function ($path, $rPath, $level) use ($relativePath, $recursive, $ignoreHidden) {
            if (0 === $level || true === $recursive) {
                if (is_dir($path)) {
                    if (true === $ignoreHidden && 0 === strpos($rPath, '.')) {
                        return null;
                    }
                    if (true === $relativePath) {
                        return $rPath;
                    }
                    return $path;
                }
            }
        });
    }
    
    
    /**
     * Return the list of files (not dirs) of a given folder.
     * 
     *
     * @param $dir
     * @param bool $recursive
     * @param bool $relativePath , whether or not to return the results as relative path (default is absolute paths)
     * @param bool $followSymlinks
     * @param bool $ignoreHidden
     * @return array
     *
     */
    public static function getFiles($dir, $recursive = false, $relativePath = false, $followSymlinks = false, $ignoreHidden = true)
    {
        return DirScanner::create()->setFollowLinks($followSymlinks)->scanDir($dir, function ($path, $rPath, $level) use ($relativePath, $recursive, $ignoreHidden) {
            if (0 === $level || true === $recursive) {
                if (is_file($path)) {
                    if (true === $ignoreHidden && 0 === strpos($rPath, '.')) {
                        return null;
                    }
                    if (true === $relativePath) {
                        return $rPath;
                    }
                    return $path;
                }
            }
        });
    }

    
//    public static function getFilesWithExtension($dir, $extension = null, $recursive = false, $relativePath = false, $followSymlinks = false, $ignoreHidden = true)
//    {
//
//    }
}
