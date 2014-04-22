<?php

/**
 * @file
 * Contains \Drupal\servicecontainer_example\Controller\ServiceContainerExampleController.
 */

namespace Drupal\servicecontainer_example\Controller;

/**
 * Class ServiceContainerExampleController
 * @package Drupal\servicecontainer_example\Controller
 */
class ServiceContainerExampleController {

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

}
