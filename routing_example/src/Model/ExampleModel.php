<?php

namespace Drupal\routing_example\Model;

/**
 * Class ExampleModel
 * @package Drupal\routing_example\Model
 */
class ExampleModel {

  private $name;
  private $value;

  /**
   *
   */
  public function __construct($value) {
    $this->name = 'example';
    $this->value = $value;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @return int
   */
  public function getValue() {
    return $this->value;
  }

}
