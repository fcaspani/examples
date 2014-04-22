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
    //watchdog('eventdispatcher_example', t('Client ip @ip', array('@ip' => $client_ip)));
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
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return array(
      KernelEvents::RESPONSE => array('onKernelResponse', -100),
      KernelEvents::REQUEST => array('onKernelRequest', -100),
    );
  }
}