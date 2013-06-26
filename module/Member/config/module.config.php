<?php
return array(
		'controllers' => array(
			'invokables' => array(
				'Member\Controller\Member' => 'Member\Controller\MemberController',
			),
		),
		
		'router' => array(
			'routes' => array(
				'member' => array(
					'type' => 'segment',
					'options' => array(
						'route' => '/member[/][:action]',
						'constraints' => array(
							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							//'id' => '[0-9]+',
						),
						'defaults' => array(
							'controller' => 'Member\Controller\Member',
							'action' => 'index',
						),
					),
				),
			),
		),
		
		
		/*
		'translator' => array(
	        //'locale' => 'en_US',
	        'locale' => 'zh_CN',
	        'translation_file_patterns' => array(
	            array(
	                'type'     => 'phparray',
	                'base_dir' => __DIR__ . '/../language',
	                'pattern'  => '%s.php',
	            ),
	        ),
	    ),
	    */

		
		'view_manager' => array(
			'template_path_stack' => array(
				'Member' => __DIR__ . '/../view',
			),
		),
	);
	
