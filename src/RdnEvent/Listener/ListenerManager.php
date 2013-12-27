<?php

namespace RdnEvent\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

/**
 * Service locator for event listeners.
 */
class ListenerManager extends AbstractPluginManager
{
	public function validatePlugin($plugin)
	{
		if ($plugin instanceof ListenerAggregateInterface)
		{
			return true;
		}

		throw new Exception\RuntimeException(sprintf(
			'Listener of type %s is invalid; must implement Zend\EventManager\ListenerAggregateInterface'
			, is_object($plugin) ? get_class($plugin) : gettype($plugin)
		));
	}
}
