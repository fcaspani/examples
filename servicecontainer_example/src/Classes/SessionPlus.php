<?php
namespace Drupal\servicecontainer_example\Classes;

use Drupal\Core\Session\SessionManager;

class SessionPlus {

  protected $session;

  public function __construct(SessionManager $session) {
    $this->session = $session;
  }

  public function sessionPlusMethod() {

    return 'Hello world!';
  }

}

?>