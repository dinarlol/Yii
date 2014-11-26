<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Akimbo',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
			'application.modules.message.*',
			'ext.yii-mail.YiiMailMessage',
			'ext.runactions.components.ERunActions',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),'employee',
			'company',
			'search',
			'matrics',
			'utility',
			'message' => array(
        'userModel' => 'User',
        'getNameMethod' => 'getFullName',
        'getSuggestMethod' => 'getSuggest',
        ),
		
	),
		
		
		
		//theme
		//'theme'=>'redplanet',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		/* 
		 * FIXME: for security but forwarding not working after nugget add or edit please change it to form from framework dont use <form tags manually
			'request'=>array(
					'enableCsrfValidation'=>true,
			),
			*/
			
			
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
			/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=akimbo',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling'=>true,
			
				
		),
			
			
			'mail' => array(
					'class' => 'ext.yii-mail.YiiMail',
					'transportType'=>'smtp', /// case sensitive!
					'transportOptions'=>array(
							'host'=>'smtp.gmail.com',
							'username'=>'akimbomail704@gmail.com',
							'password'=>'akimbomail',
							'port'=>'465',
							'encryption'=>'tls',
					),
					'viewPath' => 'application.views.mail',
					'logging' => true,
					'dryRun' => false
			),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
					array(
							'class'=>'CFileLogRoute',
							'levels'=>'trace, info',
							'categories'=>'system.*',
					),
					
				// uncomment the following to show log messages on web pages
			/*
				array(
					'class'=>'CWebLogRoute',
				),
			*/
			
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'akimbo@akimbo.com',
			'HOST' => 'mail.gmail.com',
			'company' => 'Akimbo',
	),
);