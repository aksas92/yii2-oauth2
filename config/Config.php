<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\config;

class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private $_config = [];

    /**
     * @param array $config
     * @return void
     */
    public function set(array $config)
    {
        $this->_config = $config;
    }

    /**
     * @param $key
     * @param null $default
     * @return string|null
     */
    public function get($key, $default = null)
    {
        return isset($this->_config[$key]) ? $this->_config[$key] :
            ($default ?: null);
    }
}