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
use Drupal\routing_example\Model\ExampleModel;

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
      'request' => array(
        'title' => $this->t('Request route'),
        'route_name' => 'routing_example.request',
        // I parametri il cui nome combacia con quelli definiti in routing_example.routing.yml
        // vengono sostituiti nella URL creata. Tutti i parametri in più vengono
        // aggiunti alla query string.
        'route_parameters' => array('param' => 'param', 'simple' => 'foo', 'multiple' => array('bar', 'baz')),
      ),
      'request_converter' => array(
        'title' => $this->t('Request route - converted parameter'),
        'route_name' => 'routing_example.request_converter',
        'route_parameters' => array('model' => '5'),
      ),
      'fixed_arguments' => array(
        'title' => $this->t('Request route - fixed arguments'),
        'route_name' => 'routing_example.fixed_arguments',
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
      ),
      'defaults' => array(
        'title' => $this->t('Set defaults value'),
        'route_name' => 'routing_example.defaults',
      ),
      'links' => array(
        'title' => $this->t('Routing example - links'),
        'route_name' => 'routing_example.links',
      ),
      'alter' => array(
        'title' => $this->t('Alter route info'),
        'route_name' => 'routing_example.alter',
      ),
    );

    $build['links'] = array(
      '#theme' => 'links',
      '#links' => $links,
    );

    return $build;
  }

  /**
   * @return array
   */
  public function simple() {
    return array(
      '#markup' => $this->t('Simple routing page callback'),
    );
  }

  /**
   * Tutti i metodi che implementano un'azione hanno
   * un parametro opzionale "$request" attraverso il
   * quale ho accesso ai dati della richiesta HTTP.
   * Se il controller ha degli altri parametri, il
   * parametro request è sempre l'ultimo. I parametri
   * vengono associati in base al nome della variabile
   * e non in base all'ordine.
   *
   * @param $param
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return array
   */
  public function request($param, Request $request) {
    $simple = $request->get('simple');
    $multiple = $request->get('multiple');

    $build = array();
    $build['help'] = array(
      '#markup' => $this->t('Request routing page callback:'),
    );

    $items = array(
      $this->t('Method: @method', array('@method' => $request->getMethod())),
      $this->t('Path argument: @param', array('@param' => $param)),
      $this->t('QueryString: @simple', array('@simple' => $simple)),
      $this->t('QueryString: @multiple', array('@multiple' => implode(', ', $multiple))),
    );

    $build['list'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
    );

    return $build;
  }

  /**
   * @param ExampleModel $model
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return array
   */
  public function converter(ExampleModel $model, Request $request) {
    $build = array();
    $build['help'] = array(
      '#markup' => $this->t('Converted parameter:'),
    );

    $items = array(
      $this->t('Raw: @raw', array('@raw' => $request->attributes->get('_raw_variables')->get('model'))),
      $this->t('Converted name: @converted_name', array('@converted_name' => $model->getName())),
      $this->t('Converted value: @converted_value', array('@converted_value' => $model->getValue())),
    );

    $build['list'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
    );

    return $build;
  }

  /**
   * @param $custom_arg
   * @return array
   */
  public function fixed_arguments($custom_arg) {
    $build = array();
    $build['help'] = array(
      '#markup' => $this->t('Argument for this route has been statically set into routing_example.routing.yml.'),
    );

    $build['list'] = array(
      '#theme' => 'item_list',
      '#items' => array(
        $this->t('Argument custom_arg: @custom_arg', array('@custom_arg' => $custom_arg)),
      ),
    );

    return $build;
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
  public function only_post() {
    return new Response($this->t('You should see this only with a POST call.'));
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
  public function defaults() {
    return array(
      '#markup' => $this->t('Title of this page has been provided by a _title_callback.'),
    );
  }

  /**
   * @return string
   */
  public function defaultsTitleCallback() {
    return 'Routing example - defaults';
  }

  /**
   * @return string
   */
  public function links() {
    $link1 = $this->l('link1', 'routing_example.description');

    return array(
      '#markup' => $this->t('!link to routing example description page', array('!link' => $link1)),
    );
  }

  /**
   * @return array
   */
  public function alter() {
    return array(
      '#markup' => $this->t('Title of this route should be %title, but it has been altered by %controller.', array(
          '%title' => 'Routing example - alter',
          '%controller' => 'RoutingExampleRouteSubscriber',
        )),
    );
  }
}
