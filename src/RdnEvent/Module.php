<?php

namespace RdnEvent;

use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;

class Module
{
	public function getConfig()
	{
		return include __DIR__ .'/../../config/module.config.php';
	}

	public function onBootstrap(MvcEvent $event)
	{
		if (PHP_SAPI == 'cli')
		{
			return;
		}

		/** @var Application $application */
		$application = $event->getApplication();
		$services = $application->getServiceManager();
		$events = $application->getEventManager();
		$listeners = $services->get('RdnEvent\Listener\ListenerManager');
		$config = $application->getConfig();

		foreach ($config['rdn_event']['listeners'] as $name)
		{
			$events->attachAggregate($listeners->get($name));
		}
	}
}
