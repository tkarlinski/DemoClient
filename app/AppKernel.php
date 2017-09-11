<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    const ENV_DEVELOPMENT = 'dev';
    const ENV_TESTING = 'test';
    const ENV_ACCEPTANCE  = 'rc';
    const ENV_PRODUCTION = 'prod';

    const DIR_VAR = 'var';
    const DIR_CACHE = 'cache';
    const DIR_LOGS = 'logs';
    const DIR_TEMPORARY = 'tmp';
    const DIR_UPLOADS = 'uploads';

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new EightPoints\Bundle\GuzzleBundle\GuzzleBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * Zwraca ściężkę do zapisu plików
     *
     * @return string
     */
    protected function _getStorageDirectory()
    {
        return dirname($this->getRootDir()) . '/' . self::DIR_VAR . '/' . $this->getEnvironment();
    }

    /**
     * Zwraca ścieżkę do katalogu tymczasowego aplikacji
     *
     * @return string
     */
    public function getTempDir()
    {
        return $this->_getStorageDirectory() . '/' . self::DIR_TEMPORARY;
    }

    /**
     * {@inheritdoc}
     * @see \Symfony\Component\HttpKernel\Kernel::getCacheDir()
     */
    public function getCacheDir()
    {
        return $this->_getStorageDirectory() . '/' . self::DIR_CACHE;
    }

    /**
     * {@inheritdoc}
     * @see \Symfony\Component\HttpKernel\Kernel::getLogDir()
     */
    public function getLogDir()
    {
        return $this->_getStorageDirectory() . '/' . self::DIR_LOGS;
    }

    /**
     * Zwraca ścieżkę do katalogu, w którym są uploadowane pliki
     *
     * @return string
     */
    public function getUploadDir()
    {
        return $this->_getStorageDirectory() . '/' . self::DIR_UPLOADS;
    }
}
