<?php
/**
 * @author Koen Van den Wijngaert <koen@koenvandenwijngaert.be>
 */
namespace SiteOptimo\WpPluginParser;

use SiteOptimo\WpPluginParser\Entity\Plugin;
use SiteOptimo\WpPluginParser\Exception\WpPluginParserException;

/**
 * Class WpPluginParser
 */
class WpPluginParser
{
    private static $pluginHeaders = [
        'name'        => 'Plugin Name',
        'pluginUri'   => 'Plugin URI',
        'version'     => 'Version',
        'description' => 'Description',
        'author'      => 'Author',
        'authorUri'   => 'Author URI',
        'textDomain'  => 'Text Domain',
        'domainPath'  => 'Domain Path',
        'network'     => 'Network'
    ];

    /**
     * Attempts to open $file as a zip file, and attempt to find plugin metadata.
     *
     * @param $file string Full path to the zip-file.
     *
     * @return \SiteOptimo\WpPluginParser\Entity\Plugin
     * @throws \SiteOptimo\WpPluginParser\Exception\WpPluginParserException
     */
    public static function parsePlugin($file)
    {
        if(!class_exists('\ZipArchive')) {
            throw new WpPluginParserException('Error: WordPress Plugin Parser will not work without the Zip PHP extension.');
        }

        $zipArchive = new \ZipArchive();

        $plugin = new Plugin();

        if ($zipArchive->open($file) !== true) {
            throw new WpPluginParserException('Could not open zip file.');
        }

        $firstName = $zipArchive->getNameIndex(0);

        // Take directory name as plugin slug.
        if (($pos = mb_strpos($firstName, '/')) !== false) {
            $plugin->setSlug(mb_substr($firstName, 0, $pos));
        }

        for ($i = 0; $i < $zipArchive->numFiles; $i++) {
            $fileName = $zipArchive->getNameIndex($i);

            if (mb_substr($fileName, -4) !== '.php') {
                continue;
            }

            if (substr_count($fileName, '/') > 1) {
                continue;
            }

            $fileContent = $zipArchive->getFromIndex($i);

            if ( ! self::hasPluginHeader($fileContent)) {
                continue;
            }

            $pluginData = self::parsePluginHeader($fileContent);

            if (is_null($plugin->getSlug())) {
                // Could not determine plugin slug, so using file name without php extension.
                $plugin->setSlug(substr($fileName, 0, strlen($fileName) - strlen('.php')));
            }

            foreach ($pluginData as $key => $value) {
                // Populate Plugin object.
                $method_name = 'set' . ucfirst($key);
                if (method_exists($plugin, $method_name)) {
                    call_user_func([$plugin, $method_name], $value);
                }
            }
        }

        $zipArchive->close();

        // Return plugin object.
        return $plugin;
    }

    private static function hasPluginHeader($fileContent)
    {
        return mb_stripos($fileContent, 'Plugin Name') !== false;
    }

    private static function parsePluginHeader($fileContent)
    {
        $fileContent = self::normalizePluginFile($fileContent);

        $headers = array_fill_keys(array_keys(self::$pluginHeaders), null);

        foreach (self::$pluginHeaders as $key => $regex) {
            if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $fileContent, $match) && $match[1]) {
                $headers[$key] = self::cleanupHeader($match[1]);
            }
        }

        return $headers;
    }

    private static function normalizePluginFile($fileContent)
    {
        $normalized = str_replace("\r", "\n", $fileContent);

        return $normalized;
    }

    private static function cleanupHeader($str)
    {
        return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
    }
}