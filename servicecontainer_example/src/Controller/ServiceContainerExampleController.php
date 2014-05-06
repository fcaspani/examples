<?php

namespace Drupal\servicecontainer_example\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ServiceContainerExampleController
 * @package Drupal\servicecontainer_example\Controller
 */
class ServiceContainerExampleController extends ControllerBase {

  /**
   * @return array
   */
  public function description() {
    $build = array();
    $build['help'] = array(
      '#markup' => $this->t('Service container examples:'),
    );

    $links = array(
      'existing_service' => array(
        'title' => $this->t('Existing service'),
        'route_name' => 'servicecontainer_example.existing_service',
      ),
      'existing_service_get' => array(
        'title' => $this->t('Existing service get'),
        'route_name' => 'servicecontainer_example.existing_service_get',
      ),
      'consume_custom_service' => array(
        'title' => $this->t('Custom service'),
        'route_name' => 'servicecontainer_example.consume_custom_service',
      ),
      'consume_custom_service_with_depends' => array(
        'title' => $this->t('Custom service vith depends'),
        'route_name' => 'servicecontainer_example.consume_custom_service_with_depends',
      ),
    );

    $build['links'] = array(
      '#theme' => 'links',
      '#links' => $links,
    );

    return $build;
  }

  /**
   * Consume service exposed by a static method in \Drupal
   *
   * @return array
   */
  public function existingService() {
    /** @var \Drupal\Core\Session\AccountInterface $currentUserService */
    $currentUser = \Drupal::currentUser();

    $build = array(
      '#markup' => t('Logged username: @username',
        array(
          '@username' => $currentUser->getUsername(),
        )
      ),
    );

    return $build;
  }

  /**
   * Consume service exposed by \Drupal->service()
   *
   * Get the service "date" and return custom format date.
   * 
   * @return mixed
   */
  public function existingServiceGet() {

    // Get service's object that I need (class Date)
    $date = \Drupal::service('date');

    // Invoke method format for customize the format of the date
    $new_date = $date->format(time(), $type = 'custom', $format = 'd M Y', $timezone = NULL, $langcode = NULL);

    // Return custom format date (Year day month) by implements the relative method (@see class \Drupal\Core\Datetime\Date)
    $build = array(
      '#markup' => t('The new custom format date is: @customdate',
        array(
          '@customdate' => $new_date,
        )
      ),

    );

    return $build;

  }

  /**
   * This method consume method of a new service: class Newsletter
   *
   * @return array
   */
  public function consumeCustomService() {

    /*
     *
     *  Find service that you have create (See your_module.services.yml to get service's id).
     *  Use static method service(String $id) to select and get a Newsletter object.
     *  Then, ServiceContainer will make an instance of class Newsletter for us.
     *
     */

    $newsletter = \Drupal::service('newsletter');

    // Set default values: recipients, subject and message.

    $recipients = array('fcaspani@wellnet.it', 'caspani87@gmail.com');

    $newsletter->setRecipients($recipients);
    $subject = 'Test';
    $message = 'Hi, this is a test.';

    // Consume our service: launch method for send newsletter to recipients.
    $newsletter->sendNewsletter($subject, $message);

    // Return a message
    $build = array(
      '#markup' => t('Mail sent to: @recipients',
        array(
          '@recipients' => implode(',', $recipients),
        )
      ),
    );

    return $build;
  }

  /**
   * This method consume method of a new service that depends from other services (class ServicePlus)
   *
   * @return array
   */
  public function consumeCustomServiceWithDepends() {

    $sessionPlus = \Drupal::service('session_plus');

    $depends = $sessionPlus->sessionPlusMethod();
    $build = array(
      '#markup' => t('Test service with depends: @depends',
        array(
          '@depends' => $depends,
        )
      ),
    );

    return $build;

  }

}

