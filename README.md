WordPress Plugin Parser
=======================

Parse WordPress plugin zip-files to extract a plugin's metadata.

Installation
------------

```bash
composer require siteoptimo/wp-plugin-parser
```

Usage
-----
```php
<?php

use SiteOptimo\WpPluginParser\WpPluginParser;
use SiteOptimo\WpPluginParser\Entity\Plugin;

$zipFile = 'path/to/plugin.zip';

try {
    /** @var Plugin $plugin */
    $plugin = WpPluginParser::parsePlugin($zipFile);
    
    echo $plugin->getName() . ':';
    var_dump($plugin);
} catch(\SiteOptimo\WpPluginParser\Exception\WpPluginParserException $e) {
    // Handle exception.
}
```
