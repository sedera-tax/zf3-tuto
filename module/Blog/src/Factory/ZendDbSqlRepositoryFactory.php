<?php

namespace Blog\Factory;


use Blog\Model\Post;
use Blog\Model\ZendDbSqlRepository;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ZendDbSqlRepositoryFactory implements FactoryInterface {
	/**
	 * @param ContainerInterface $container
	 * @param string $requestedName
	 * @param array|null $options
	 *
	 * @return mixed
	 */
	public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
		return new ZendDbSqlRepository(
			$container->get(AdapterInterface::class),
			new ReflectionHydrator(),
			new Post('', '')
		);
	}

}