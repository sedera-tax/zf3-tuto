<?php

namespace Blog\Factory;


use Blog\Model\Post;
use Blog\Model\ZendDbSqlCommand;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ZendDbSqlCommandFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 *
	 * @return mixed
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		return new ZendDbSqlCommand($container->get(AdapterInterface::class));
	}

}