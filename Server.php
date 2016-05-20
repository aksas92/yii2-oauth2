<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2;

use Yii;
use yii\base\Component;
use pfdtk\oauth2\config\ConfigInterface;
use pfdtk\oauth2\config\Config;

class Server extends Component
{
    /**
     * @var array
     */
    private $_config = [];

    /**
     * case:
     *
     * $config = [
     *      'db' => 'default',
     *      'grant_type' => '',
     * ];
     *
     * @param array $config
     * @return void
     */
    public function setConfig(array $config)
    {
        $this->_config = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->bindContainer();
        $this->storeConfig();
    }

    /**
     * handle
     */
    public function handle()
    {
        $bb = ( new \pfdtk\oauth2\repository\ClientRepository())->getClientEntity('asdf123123', 'authorization_code', 'adfasdf123123123', true);
        var_dump($bb);

        $aa = ( new \pfdtk\oauth2\repository\ScopeRepository());
        var_dump($aa->getScopeEntityByIdentifier('scopes_1'));
        //var_dump($aa->finalizeScopes([], 'authorization_code', $bb, null));

        $cc = ( new \pfdtk\oauth2\repository\AccessTokenRepository());
        return 1;
    }

    /**
     * Dependency Injection process
     *
     * @return void
     */
    private function bindContainer()
    {
        $container = Yii::$container;
        $container->setSingleton(ConfigInterface::class, Config::class);
    }

    /**
     * store config
     *
     * @return void
     */
    private function storeConfig()
    {
        $container = Yii::$container;
        $container->get(ConfigInterface::class)->set($this->getConfig());
    }
}