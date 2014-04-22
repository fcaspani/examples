<?php

/**
 * @file
 * Contains \Drupal\servicecontainer_example\Service\SimpleService.
 */

namespace Drupal\servicecontainer_example\Service;

/**
 * Class SimpleService
 * @package Drupal\servicecontainer_example\Service
 */
class SimpleService implements SimpleServiceInterface {

  /**
   * {@inheritdoc}
   */
  public function getData() {
    return 'data';
  }

}
