<?php

namespace Drupal\routing_example\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class RoutingExampleAccessCheck implements AccessCheckInterface {

  /**
   * Declares whether the access check applies to a specific route or not.
   *
   * @param \Symfony\Component\Routing\Route $route
   *   The route to consider attaching to.
   *
   * @return array
   *   An array of route requirement keys this access checker applies to.
   */
  public function applies(Route $route) {
    $requirements = $route->getRequirements();

    return (array_key_exists('_access_routing_example_access', $requirements));
  }

  /**
   * Checks for access to a route.
   *
   * @param \Symfony\Component\Routing\Route $route
   *   The route to check against.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   *
   * @return bool|null
   *   self::ALLOW, self::DENY, or self::KILL.
   */
  public function access(Route $route, Request $request, AccountInterface $account) {
    if ($account->isAnonymous()) {
      // returning self::DENY here means that this access check has denied access, if
      // exists an other access check that returns self:ALLOW and _access_mode
      // in routing_example.routing.yml for this route was set to ANY, access to this route
      // will be granted. To explicit block access to this route return self::KILL.
      return self::DENY;
    }
    else {
      return self::ALLOW;
    }
  }
}