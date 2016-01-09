YorgDirScannerTool
==============
2016-01-09



Utility to scan a directory.



Based on the [DirScanner](https://github.com/lingtalfi/DirScanner).





getFiles
---------------

Return the files (not dirs) in a given folder.


```php
array  getFiles( str:dir, bool:recursive = false, bool:relativePath = false, bool:followSymlinks = false, bool:ignoreHidden = true)
```

With the relativePath option, the returned array contains relative paths;
without the relativePath option, the returned array contains absolute paths.


Example

```php
<?php


use DirScanner\YorgDirScannerTool;

require_once "bigbang.php";


$dir = "service";
a(YorgDirScannerTool::getFiles($dir, true, true)); 
```




    

