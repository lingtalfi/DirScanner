DirScanner
==============
2015-11-03 -> 2021-03-08



Utility to scan a directory recursively and do something on every entry.



DirScanner is part of the [universe framework](https://github.com/karayabin/universe-snapshot).




Install
=============


Using the [planet installer](https://github.com/lingtalfi/Light_PlanetInstaller) via [light-cli](https://github.com/lingtalfi/Light_Cli)
```bash
lt install Ling.DirScanner
```

Using the [uni tool](https://github.com/lingtalfi/universe-naive-importer)
```bash
uni import Ling/DirScanner
```



Summary
==========
- [DirScanner api](https://github.com/lingtalfi/DirScanner/blob/master/doc/api/Ling/DirScanner.md) (generated with [DocTools](https://github.com/lingtalfi/DocTools))
- [How to use](#how-to-use)
- [More examples](#more-examples)
- [History Log](#history-log)






How to use
--------------

You can install DirScanner as a [planet](https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md).
 
 
You can use the DirScanner directly, or there is also the [YorgDirScannerTool](https://github.com/lingtalfi/DirScanner/blob/master/YorgDirScannerTool.md)
that might be easier to use for the simplest cases.
 



```php
<?php

use Ling\DirScanner\DirScanner;

require_once "bigbang.php";


$dir = '/path/to/dir';

$scanner = DirScanner::create();
$scanner->setFollowLinks(false); // default is false


if ('cli' === PHP_SAPI) {
    // console version
    $scanner->scanDir($dir, function ($path, $rPath, $level) {
        echo "path=$path; rPath=$rPath; level=$level";
        echo PHP_EOL;
    });

}
else {
    // html version
    echo '<table>';
    echo '<tr><th>path</th><th>relative path</th><th>level</th></tr>';
    $scanner->scanDir($dir, function ($path, $rPath, $level) {
        echo '<tr><td>' . $path . '</td><td>' . $rPath . '</td><td>' . $level . '</td></tr>';
    });
    echo '</table>';
}


```



### The callable

```
void    f (str:path, str:relativePath, int:level, bool:&skipDir)
```

- path: full path to the entry being scanned
- relativePath: relative path starting from the root directory 
- level: deepness starting at 0 for the first level 
- skipDir: bool=false. Set this to true to skip the directory and its content (recursively)



More examples
-------------------


### Get files with a certain extension 

```php
<?php


use Ling\Bat\FileSystemTool;
use Ling\DirScanner\DirScanner;

require_once "bigbang.php";

// get all mp4 files in the service dir
$dir = "service";
a(DirScanner::create()->scanDir($dir, function($path, $rPath, $level){
    if('mp4' === strtolower(FileSystemTool::getFileExtension($rPath))){
        return $rPath; // return as relative path for readability, or return the path if you prefer absolute path
    }
}));
```


### Get list of directories  

```php
<?php


use Ling\DirScanner\YorgDirScannerTool;

require_once "bigbang.php"; // start the local universe


$dirs = YorgDirScannerTool::getDirs("/path/to/dir");

```








History Log
------------------

- 1.13.6 -- 2021-05-31

    - Removing trailing plus in lpi-deps file (to work with Light_PlanetInstaller:2.0.0 api

- 1.13.5 -- 2021-03-08

    - fix YorgDirScannerTool::getFilesWithExtension incorrectly finding file if its name matches the extension 
  
- 1.13.4 -- 2021-03-05

    - update README.md, add install alternative

- 1.13.3 -- 2021-01-07

    - update YorgDirScannerTool::getFilesIgnore, add collectSymlinks argument
  
- 1.13.2 -- 2020-12-08

    - Fix lpi-deps not using natsort.

- 1.13.1 -- 2020-12-04

    - Add lpi-deps.byml file

- 1.13.0 -- 2020-08-18

    - add YorgDirScannerTool::getFilesWithName method
    
- 1.12.0 -- 2019-10-04

    - add YorgDirScannerTool::getFilesWithoutExtension method
    
- 1.11.2 -- 2019-07-18

    - update docTools documentation, add links to source code for classes and methods
        
- 1.11.1 -- 2019-03-26

    - fix YorgDirScannerTool add implementation of 1.11.0 (forgot to implement the thing, duh)

- 1.11.0 -- 2019-03-26

    - update YorgDirScannerTool now ignoreHidden can differentiate between ignoring directories or files


- 1.10.0 -- 2019-03-21

    - add YorgDirScannerTool::getFilesIgnoreMore method

- 1.9.0 -- 2019-03-20

    - add YorgDirScannerTool::getFilesIgnore method

- 1.8.0 -- 2019-03-18

    - update DirScanner, now can filter dirs early

- 1.7.0 -- 2018-06-15

    - add YorgDirScannerTool.getFilesWithPrefix method
    
- 1.6.0 -- 2018-06-11

    - add keyName, keyPath and keyChildren options to NestedFileTreeHelper::getNestedFileTree method
    
- 1.5.0 -- 2018-06-11

    - add NestedFileTreeHelper class
    
- 1.4.1 -- 2017-12-11

    - update YorgDirScannerTool.getFilesWithExtension, extension matching system now accepts "long" extensions like "tpl.php"
    
- 1.4.0 -- 2017-04-18

    - add YorgDirScannerTool.getEntries method
    
- 1.3.0 -- 2016-02-01

    - add YorgDirScannerTool.getFilesWithExtension method
    
- 1.2.0 -- 2016-01-24

    - add YorgDirScannerTool.getDirs
    
- 1.1.0 -- 2016-01-09

    - add YorgDirScannerTool
    - add signature to scanDir method
    
- 1.0.0 -- 2015-11-03

    - initial commit
    
    