<?php

namespace ObjectivePHP\Package\Solarium\Config;

use ObjectivePHP\Config\Exception;
use ObjectivePHP\Config\SingleValueDirectiveGroup;
use ObjectivePHP\Primitives\String\Camel;

/**
 * Class SolrClient
 *
 * @package Fei\Gateway\Config
 */
class SolrClient extends SingleValueDirectiveGroup
{


    protected $value  = ['port' => '8983', 'base-path' => '/solr/'];


    /**
     * SolrClient constructor.
     *
     * @param        $host
     * @param string $port
     * @param string $basePath
     * @param        $core
     */
    public function __construct($identifier, $host, $core = null, $basePath = null, $port = null)
    {
        $config = array_merge($this->value, array_filter(compact('host', 'core', 'basePath', 'port')));
        $this->identifier = $identifier;
        $this->setValue($config);

    }

    public function setValue($value)
    {
        foreach ($value as $option => $optionValue) {

            $option = str_replace('-', '_', $option);
            $setter = 'set' . Camel::case($option);

            if (method_exists($this, $setter)) {
                $this->$setter($optionValue);
            } else {
                throw new Exception(sprintf('Unknown configuration option: %s', Camel::case($option)));
            }
        }
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->value['host'];
    }

    /**
     * @param mixed $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->value['host'] = $host;

        return $this;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->value['port'];
    }

    /**
     * @param string $port
     *
     * @return $this
     */
    public function setPort($port)
    {
        $this->value['port'] = $port;

        return $this;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->value['base-path'];
    }

    /**
     * @param string $basePath
     *
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->value['base-path'] = $basePath;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCore()
    {
        return $this->value['core'];
    }

    /**
     * @param mixed $core
     *
     * @return $this
     */
    public function setCore($core)
    {
        $this->value['core'] = $core;

        return $this;
    }

}
