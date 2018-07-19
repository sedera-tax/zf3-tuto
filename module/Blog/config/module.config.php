<?php
namespace Blog;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

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
					// Listen to "/blog" as uri:
					'route' => '/blog',
					// Define default controller and action to be called when
					// this route is matched
					'defaults' => [
						'controller' => Controller\ListController::class,
						'action'     => 'index',
					],
				],
				// The following allows "/blog" to match on its own if no child
				// routes match:
				'may_terminate' => true,
				// Child routes begin:
				'child_routes'  => [
					'detail' => [
						'type' => Segment::class,
						'options' => [
							'route'    => '/:id',
							'defaults' => [
								'action' => 'view',
							],
							'constraints' => [
								'id' => '[1-9]\d*',
							],
						],
					],

					'add' => [
						'type' => Literal::class,
						'options' => [
							'route'    => '/add',
							'defaults' => [
								'controller' => Controller\WriteController::class,
								'action'     => 'add',
							],
						],
					],

					'edit' => [
						'type' => Segment::class,
						'options' => [
							'route'    => '/edit/:id',
							'defaults' => [
								'controller' => Controller\WriteController::class,
								'action' => 'edit',
							],
							'constraints' => [
								'id' => '[1-9]\d*',
							],
						],
					],

					'delete' => [
						'type' => Segment::class,
						'options' => [
							'route'    => '/delete/:id',
							'defaults' => [
								'controller' => Controller\DeleteController::class,
								'action' => 'delete',
							],
							'constraints' => [
								'id' => '[1-9]\d*',
							],
						],
					],
				],
			],
			'view-blog' => [
				'type' => Segment::class,
				'options' => [
					'route' => '/blog/view[/:id]',
					'defaults' => [
						'controller' => Controller\ListController::class,
						'action' => 'view',
						'id' => 1
					],
					'constraints' => [
						'id' => '\d+',
					],
				],
			],
		],
	],
	'service_manager' => [
		'aliases' => [
			//Model\PostRepositoryInterface::class => Model\PostRepository::class,
			Model\PostRepositoryInterface::class => Model\ZendDbSqlRepository::class,
			Model\PostCommandInterface::class => Model\ZendDbSqlCommand::class,
		],
		'factories' => [
			Model\PostRepository::class => InvokableFactory::class,
			Model\ZendDbSqlRepository::class => Factory\ZendDbSqlRepositoryFactory::class,
			Model\PostCommand::class => InvokableFactory::class,
			Model\ZendDbSqlCommand::class => Factory\ZendDbSqlCommandFactory::class,
		]
	],
	'controllers' => [
		'factories' => [
			//Controller\ListController::class => InvokableFactory::class,
			Controller\ListController::class => Factory\ListControllerFactory::class,
			Controller\WriteController::class => Factory\WriteControllerFactory::class,
			Controller\DeleteController::class => Factory\DeleteControllerFactory::class,
		],
	],
	'view_manager' => [
		'template_path_stack' => [
			__DIR__ . '/../view',
		],
	],
	'translator' => [
		'locale' => 'en_US',
		'translation_file_patterns' => [
			[
				'type'     => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern'  => '%s.mo',
			],
		],
	],
];