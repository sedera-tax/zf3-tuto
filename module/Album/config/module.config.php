<?php
namespace Album;

use Zend\Router\Http\Literal;

return [
	// This lines opens the configuration for the RouteManager
	'router' => [
		// Open configuration for all possible routes
		'routes' => [
			// Define a new route called "blog"
			'blog' => [
				// Define a "literal" route type:
				'type' => Literal::class,
				// Configure the route itself
				'options' => [
					// Listen to "/album" as uri:
					'route' => '/album',
					// Define default controller and action to be called when
					// this route is matched
					'defaults' => [
						'controller' => Controller\ListController::class,
						'action'     => 'index',
					],
				],
			],
		],
	],
];