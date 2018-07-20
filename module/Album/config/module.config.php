<?php
namespace Album;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
//use Zend\ServiceManager\Factory\InvokableFactory;

return [
	/*'controllers' => [
		'factories' => [
			Controller\AlbumController::class => InvokableFactory::class,
		],
	],*/
	'view_manager' => [
		'template_path_stack' => [
			'album' => __DIR__ . '/../view',
		],
	],
	// This lines opens the configuration for the RouteManager
	'router' => [
		// Open configuration for all possible routes
		'routes' => [
			// Define a new route called "album"
			'album' => [
				// Define a "literal" route type:
				'type' => Segment::class,
				// Configure the route itself
				'options' => [
					// Listen to "/album" as uri:
					'route' => '/album[/:action[/:id]]',
					// Define default controller and action to be called when
					// this route is matched
					'defaults' => [
						'controller' => Controller\AlbumController::class,
						'action'     => 'index',
					],
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+'
					],
				],
			],

			'album-list' => [
				'type' => Literal::class,
				'options' => [
					'route'    => '/album/list',
					'defaults' => [
						'controller' => Controller\AlbumController::class,
						'action'     => 'list',
					],
				],
			],
		],
	],
];