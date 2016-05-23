<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2;

use Yii;
use yii\base\Component;
use pfdtk\oauth2\config\ConfigInterface;
use pfdtk\oauth2\config\Config;
use pfdtk\oauth2\credentials\UserInterface;

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
     *      'grant_type' => 'authorization_code',
     *      'userModel' => 'app\models\User',
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
        $bb = (new \pfdtk\oauth2\repository\ClientRepository())->getClientEntity('asdf123123', 'authorization_code', 'adfasdf123123123', true);
        var_dump($bb);

        $aa = (new \pfdtk\oauth2\repository\ScopeRepository());
        var_dump($aa->getScopeEntityByIdentifier('scopes_1'));
        //var_dump($aa->finalizeScopes([], 'authorization_code', $bb, null));

        //$cc = (new \pfdtk\oauth2\repository\AccessTokenRepository());
        return 1;
    }

    /**
     * @param $identifier
     * @param $secret
     * @param $name
     * @param $redirectUri
     * @return boolean
     */
    public function addNewClient($identifier, $secret, $name, $redirectUri)
    {
        $clientRepository = new \pfdtk\oauth2\repository\ClientRepository();
        return $clientRepository->addNewClient($identifier, $secret, $name, $redirectUri);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function bindClientGrant(array $data)
    {
        $clientRepository = new \pfdtk\oauth2\repository\ClientRepository();
        return $clientRepository->bindClientGrant($data);
    }

    /**
     * @param $clientIdentifier
     * @param null $grant
     * @return boolean
     */
    public function removeClientGrant($clientIdentifier, $grant = null)
    {
        $clientRepository = new \pfdtk\oauth2\repository\ClientRepository();
        return $clientRepository->removeClientGrant($clientIdentifier, $grant);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function bindClientScope(array $data)
    {
        $clientRepository = new \pfdtk\oauth2\repository\ClientRepository();
        return $clientRepository->bindClientScope($data);
    }

    /**
     * @param $clientIdentifier
     * @param null $scope
     * @return bool
     */
    public function removeClientScope($clientIdentifier, $scope = null)
    {
        $clientRepository = new \pfdtk\oauth2\repository\ClientRepository();
        return $clientRepository->removeClientScope($clientIdentifier, $scope);
    }

    /**
     * init grant
     */
    public function initGrant()
    {
        $grantRepository = new \pfdtk\oauth2\repository\GrantRepository();
        return $grantRepository->initGrant();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function bindGrantScope(array $data)
    {
        $grantRepository = new \pfdtk\oauth2\repository\GrantRepository();
        return $grantRepository->bindGrantScope($data);
    }

    /**
     * @param $grantIdentifier
     * @param null $scope
     * @return bool
     */
    public function removeGrantScope($grantIdentifier, $scope = null)
    {
        $grantRepository = new \pfdtk\oauth2\repository\GrantRepository();
        return $grantRepository->removeGrantScope($grantIdentifier, $scope);
    }

    /**
     * @param $identifier
     * @param $description
     * @return bool
     */
    public function addNewScope($identifier, $description)
    {
        $scopeRepository = new \pfdtk\oauth2\repository\ScopeRepository();
        return $scopeRepository->addNewScope($identifier, $description);
    }

    /**
     * @param $identifier
     */
    public function removeScope($identifier)
    {
        $scopeRepository = new \pfdtk\oauth2\repository\ScopeRepository();
        return $scopeRepository->removeScope($identifier);
    }

    /**
     * Dependency Injection process
     *
     * @return void
     */
    private function bindContainer()
    {
        $config = $this->getConfig();
        $container = Yii::$container;
        $container->setSingleton(ConfigInterface::class, Config::class);
        $container->setSingleton(UserInterface::class, $config['userModel']);
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