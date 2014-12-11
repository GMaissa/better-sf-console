<?php
/**
 * Better Symfony Console file
 *
 * PHP VERSION 5
 *
 * @category  BetterSfConsole
 * @package   BetterSfConsole.Core
 * @author    Guillaume Maïssa <guillaume@maissa.fr>
 * @copyright 2014 Guillaume Maïssa
 * @license   OSL-3
 */

namespace GMaissa\BetterSfConsole;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lcobucci\DependencyInjection\ContainerBuilder;
use Lcobucci\DependencyInjection\ContainerConfig;

/**
 * Extends the Symfony Console Application class to use Dependency Injection
 *
 * @category  BetterSfConsole
 * @package   BetterSfConsole.Core
 * @author    Guillaume Maïssa <guillaume@maissa.fr>
 * @copyright 2014 Guillaume Maïssa
 */
abstract class Application extends BaseApplication implements ContainerAwareInterface
{
    /**
     * Application logo
     * @var string $logo
     */
    private static $logo = false;

    /**
     * Dependency Injection Container
     * ContainerInterface/false $container
     */
    private $container = false;

    /**
     * URL where the manifest.json file is hosted
     * @var string $manifestHost
     */
    private $manifestHost = false;

    /**
     * Constructor.
     *
     * @param string $name    The name of the application
     * @param string $version The version of the application
     *
     * @api
     */
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN', ContainerConfig $containerConfig)
    {
        $builder = new DelegatingBuilder();
        $this->setContainer($builder->getContainer($containerConfig));

        parent::__construct($name, $version);
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Gets the Container.
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Inject the URL where the manifest.json file is hosted
     *
     * @param string $manifestHost URL where the manifest.json file is hosted
     *
     * @return void
     */
    public function setManifestHost($manifestHost)
    {
        $this->manifestHost = $manifestHost;
    }

    /**
     * Get the URL where the manifest.json file is hosted
     *
     * @return string
     */
    public function getManifestHost()
    {
        return $this->manifestHost;
    }

    /**
     * Gets the help message.
     *
     * @return string A help message.
     */
    public function getHelp()
    {
        return self::$logo . parent::getHelp();
    }
}

