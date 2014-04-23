<?php

namespace Drupal\eventdispatcher_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\eventdispatcher_example\Event\ExampleEvent;
use Drupal\eventdispatcher_example\Event\ExampleEvents;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventForm extends FormBase {

  /** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface */
  private $eventDispatcher;

  /**
   * @param ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_dispatcher')
    );
  }

  /**
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
   */
  public function __construct(EventDispatcherInterface $eventDispatcher) {
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'event_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $form['trigger_event'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Trigger event'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $event = new ExampleEvent(array('key' => 'value'));
    $this->eventDispatcher->dispatch(ExampleEvents::EXAMPLE, $event);
  }
}
