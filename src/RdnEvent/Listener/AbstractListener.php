<?php

namespace RdnEvent\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Stdlib\CallbackHandler;

/**
 * Abstract listener implementing the common detach process.
 */
abstract class AbstractListener implements ListenerAggregateInterface
{
	/**
	 * @var CallbackHandler[]
	 */
	protected $listeners = array();

	abstract public function attach(EventManagerInterface $events);

	public function detach(EventManagerInterface $events)
	{
		foreach ($this->listeners as $index => $listener)
		{
			if ($events->detach($listener))
			{
				unset($this->listeners[$index]);
			}
		}
	}
}
