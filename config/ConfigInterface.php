<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\config;

interface ConfigInterface
{
    /**
     * @param array $config
     * @return mixed
     */
    public function set(array $config);

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default = '');
}