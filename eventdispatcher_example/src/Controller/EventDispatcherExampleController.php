<?php

/**
 * @file
 * Contains \Drupal\eventdispatcher_example\Controller\EventDispatcherExampleController.
 */

namespace Drupal\eventdispatcher_example\Controller;

/**
 * Class EventDispatcherExampleController
 *
 * @package Drupal\eventdispatcher_example\Controller
 */
class EventDispatcherExampleController {

  /**
   * @return array
   */
  public function description() {
    $build = array(
      '#markup' => t(
        '<p>Event dispatcher example...</p>'),
    );
    return $build;
  }

  /**
   * @return string
   */
  public function example1() {
    return 'test';
  }

}
