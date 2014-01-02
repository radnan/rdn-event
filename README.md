RdnEvent
========

The **RdnEvent** ZF2 module provides a service locator for event listeners.

## How to install

1. Use `composer` to require the `radnan/rdn-event` package:

   ~~~bash
   $ composer require radnan/rdn-event:1.*
   ~~~

2. Activate the module by including it in your `application.config.php` file:

   ~~~php
   <?php

   return array(
       'modules' => array(
           'RdnEvent',
           // ...
       ),
   );
   ~~~

## How to use

Simply configure your event listeners with the `RdnEvent\Listener\ListenerManager` service locator using the `rdn_event_listeners` configuration option. Listeners are any class that implements the `Zend\EventManager\ListenerAggregateInterface` interface.

~~~php
<?php

return array(
	'rdn_event_listeners' => array(
		'invokables' => array(),
		'factories' => array(),
	),
);
~~~

## How to create listeners

Create your listeners inside your module, register them with the event listener service locator, and finally attach the listener by including it in the `rdn_event[listeners]` configuration option.

Let's create a hello world listener inside our `App` module:

### 1. Create listener class

Create the class `App\Listener\HelloWorld` by extending `RdnEvent\Listener\AbstractListener`:

~~~php
<?php

namespace App\Listener;

use RdnConsole\Listener\AbstractListener;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class HelloWorld extends AbstractListener
{
	public function attach(EventManagerInterface $events)
	{
		$this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'execute'));
	}

	public function execute(EventInterface $event)
	{
		var_dump('Hello World!');
	}
}
~~~

### 2. Register listener with service locator

Place the following in your `module.config.php` file:

~~~php
<?php

return array(
	'rdn_event_listeners' => array(
		'invokables' => array(
			'App:HelloWorld' => 'App\Listener\HelloWorld',
		),
	),
);
~~~

### 3. Attach the listener to the event manager

Now, place the following in your `module.config.php` file:

~~~php
<?php

return array(
	'rdn_event' => array(
		'listeners' => array(
			'App:HelloWorld',
		),
	),
);
~~~

That's it! The module will fetch the listener from the service locator and attach it to the application's event manager.
