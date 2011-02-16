<?php

namespace Sensio\CasBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SensioCasExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('cas.xml');

        $config = array();
        foreach ($configs as $conf) {
            $config = array_merge($config, $conf);
        }

        foreach($config as $key => $value) {
            $container->setParameter('cas.'.$key, $value);
        }
    }

    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return null;
    }

    public function getAlias()
    {
        return 'sensio_cas';
    }

}
