<?php

namespace Drupal\eventdispatcher_example\Event;

use Symfony\Component\EventDispatcher\Event;

class ExampleEvent extends Event {

  private $data;

  /**
   * @param $data
   */
  public function __construct($data) {
    $this->data = $data;
  }

  /**
   * @return mixed
   */
  public function getData() {
    return $this->data;
  }

}
