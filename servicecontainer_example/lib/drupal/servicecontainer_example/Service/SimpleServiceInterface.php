<?php

/**
 * @file
 * Contains \Drupal\servicecontainer_example\Service\SimpleServiceInterface.
 */

namespace Drupal\servicecontainer_example\Service;

/**
 * Interface SimpleServiceInterface
 *
 * @package Drupal\servicecontainer_example\Service
 */
interface SimpleServiceInterface {

  /**
   * @return mixed
   */
  public function getData();

}
