DirScanner
==============
2015-11-03



Utility to scan a directory recursively and do something on every entry.




How to use
--------------

You can install DirScanner as a [planet](https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md).
 
 

The 

```php
<?php

use DirScanner\DirScanner;

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
void    f (str:path, str:relativePath, int:level)
```

- path: full path to the entry being scanned
- relativePath: relative path starting from the root directory 
- level: deepness starting at 0 for the first level 



History Log
------------------
    
- 1.0.0 -- 2015-11-03

    - initial commit
    
    