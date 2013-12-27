<?php

return array(
	'rdn_event' => array(
		'listeners' => array(),
	),

	'rdn_event_listeners' => array(
		'factories' => array(),
		'invokables' => array(),
	),

	'service_manager' => array(
		'factories' => array(
			'RdnEvent\Listener\ListenerManager' => 'RdnEvent\Factory\Listener\ListenerManager',
		),
	),
);
