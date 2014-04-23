<?php

/**
 * @file
 * Contains \Drupal\eventdispatcher_example\EventListener\EventDispatcherEventListener.
 */

namespace Drupal\eventdispatcher_example\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\eventdispatcher_example\Event\ExampleEvent;
use Drupal\eventdispatcher_example\Event\ExampleEvents;

/**
 * Class EventDispatcherEventListener
 *
 * @package Drupal\eventdispatcher_example\EventListener
 */
class EventDispatcherEventListener implements EventSubscriberInterface {

  /**
   * @param GetResponseEvent $event
   */
  public function onKernelRequest(GetResponseEvent $event) {
    $client_ip = $event->getRequest()->getClientIp();
    watchdog('eventdispatcher_example', t('Client ip @ip', array('@ip' => $client_ip)));
  }

  /**
   * @param FilterResponseEvent $event
   */
  public function onKernelResponse(FilterResponseEvent $event) {
    $redirect = $event->getRequest()->query->get('redirect');
    if ($redirect == '1') {
      $event->setResponse(new RedirectResponse(url('<front>')));
    }
  }

  /**
   * @param ExampleEvent $event
   */
  public function onExampleEvent(ExampleEvent $event) {
    $data = $event->getData();
    watchdog('eventdispatcher_example', print_r($data, TRUE));
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return array(
      // Symfony defined events
      KernelEvents::RESPONSE => array('onKernelResponse', -100),
      KernelEvents::REQUEST => array('onKernelRequest', -100),
      // Example module defined events (defined in ExampleEvents and dispatched in EventForm)
      ExampleEvents::EXAMPLE => array('onExampleEvent', 0),
    );
  }
}
