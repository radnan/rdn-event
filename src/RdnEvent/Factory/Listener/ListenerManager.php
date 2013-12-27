<?php

namespace RdnEvent\Factory\Listener;

use RdnEvent\Listener;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListenerManager implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $services)
	{
		$config = $services->get('Config');
		$config = new Config($config['rdn_event_listeners']);

		$listeners = new Listener\ListenerManager($config);
		$listeners->setServiceLocator($services);

		return $listeners;
	}
}
