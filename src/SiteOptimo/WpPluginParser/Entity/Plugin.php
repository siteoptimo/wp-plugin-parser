<?php
/**
 * @author Koen Van den Wijngaert <koen@koenvandenwijngaert.be>
 */


namespace SiteOptimo\WpPluginParser\Entity;


class Plugin
{
    /**
     * @var string Plugin slug.
     */
    private $slug;

    /**
     * @var string Plugin name.
     */
    private $name;

    /**
     * @var string Plugin version.
     */
    private $version;

    /**
     * @var string Uri associated with the plugin.
     */
    private $pluginUri;

    /**
     * @var string Short description about the plugin.
     */
    private $description;

    /**
     * @var string The plugin author.
     */
    private $author;

    /**
     * @var string Uri associated with the plugin author.
     */
    private $authorUri;

    /**
     * @var string The plugin's language text domain.
     */
    private $textDomain;

    /**
     * @var string The path containing the language files.
     */
    private $domainPath;

    /**
     * @var bool Is network only plugin? (True/False)
     */
    private $network;

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Plugin
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Plugin
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Plugin
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getPluginUri()
    {
        return $this->pluginUri;
    }

    /**
     * @param string $pluginUri
     *
     * @return Plugin
     */
    public function setPluginUri($pluginUri)
    {
        $this->pluginUri = $pluginUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Plugin
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return Plugin
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorUri()
    {
        return $this->authorUri;
    }

    /**
     * @param string $authorUri
     *
     * @return Plugin
     */
    public function setAuthorUri($authorUri)
    {
        $this->authorUri = $authorUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextDomain()
    {
        return $this->textDomain;
    }

    /**
     * @param string $textDomain
     *
     * @return Plugin
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomainPath()
    {
        return $this->domainPath;
    }

    /**
     * @param string $domainPath
     *
     * @return Plugin
     */
    public function setDomainPath($domainPath)
    {
        $this->domainPath = $domainPath;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNetwork()
    {
        return $this->network;
    }

    /**
     * @param bool $network
     *
     * @return Plugin
     */
    public function setNetwork($network)
    {
        $this->network = $network;

        return $this;
    }
}