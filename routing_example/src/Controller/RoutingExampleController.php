<?php

/**
 * @file
 * Contains \Drupal\routing_example\Controller\RoutingExampleController.
 */

namespace Drupal\routing_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for routing example routes.
 */
class RoutingExampleController extends ControllerBase {

  /**
   * A simple controller method to explain what the routing example is about.
   *
   * @return array
   */
  public function description() {
    $build = array();
    $build['help'] = array(
      '#markup' => $this->t('Routing examples:'),
    );

    $links = array(
      'simple' => array(
        'title' => $this->t('Simple route'),
        'route_name' => 'routing_example.simple',
      ),
      'form' => array(
        'title' => $this->t('Form route'),
        'route_name' => 'routing_example.form',
      ),
      'controller' => array(
        'title' => $this->t('Controller route'),
        'route_name' => 'routing_example.controller',
      ),
      'access' => array(
        'title' => $this->t('Access requirement route'),
        'route_name' => 'routing_example.access',
      )
    );

    $build['links'] = array(
      '#theme' => 'links',
      '#links' => $links,
    );

    return $build;
  }

  /**
   * Tutti i metodi che implementano un'azione hanno
   * un parametro opzionale "$request" attraverso il
   * quale ho accesso ai dati della richiesta HTTP.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return array
   */
  public function simple(Request $request) {
    return array(
      '#markup' => $this->t('Simple routing page callback: @data', array('@data' => print_r($request, TRUE))),
    );
  }

  /**
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function controller() {
    $data = array(
      'key' => 'value',
    );

    return new JsonResponse($data);
  }

  /**
   * @return array
   */
  public function access() {
    return array(
      '#markup' => $this->t('You should be logged to see this page.'),
    );
  }

  /**
   * @return array
   */
  public function only_post() {
    return new Response($this->t('You should see this only with a POST call.'));
  }

}
