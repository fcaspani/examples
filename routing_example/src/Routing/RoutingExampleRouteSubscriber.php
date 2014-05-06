<?php

namespace Drupal\routing_example\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RoutingExampleRouteSubscriber extends RouteSubscriberBase {

  /**
   * Alters existing routes for a specific collection.
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   The route collection for adding routes.
   */
  protected function alterRoutes(RouteCollection $collection) {

    // only alter routes for this provider (extension).
    /*if ($provider == 'routing_example') {

      // Find the route we want to alter
      $routeAlter = $collection->get('routing_example.alter');

      if ($routeAlter != NULL) {

        // Make a change to the title.
        $routeAlter->setDefault('_title', 'Routing example - altered title!!');

        // Re-add the collection to override the existing route.
        $collection->add('routing_example.alter', $routeAlter);
      }

      // Find the route we want to add parameter converter to
      $routeConverter = $collection->get('routing_example.request_converter');

      if ($routeConverter != NULL) {
        $parameters = array(
          'model' => array(
            'converter' => 'paramconverter.example',
          ),
        );

        $routeConverter->setOption('parameters', $parameters);
        $collection->add('routing_example.request_converter', $routeConverter);
      }
    }*/
  }
}
