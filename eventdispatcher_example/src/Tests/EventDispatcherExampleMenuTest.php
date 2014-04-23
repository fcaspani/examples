<?php

/**
 * @file
 * Definition of Drupal\eventdispatcher_example\Tests\EventDispatcherExampleMenuTest.
 */

namespace Drupal\eventdispatcher_example\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Test the user-facing menus in Event dispatcher Example.
 *
 * @ingroup block_example
 */
class EventDispatcherExampleMenuTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('eventdispatcher_example');

  /**
   * The installation profile to use with this test.
   *
   * This test class requires the "Tools" block.
   *
   * @var string
   */
  protected $profile = 'minimal';

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => 'Event dispatcher Example Menu Test',
      'description' => 'Test the user-facing menus in Event dispatcher Example.',
      'group' => 'Examples',
    );
  }

  /**
   * Test for a link to the Event dispatcher example in the Tools menu.
   */
  public function testEventDispatcherExampleLink() {
    $this->drupalGet('');
    $this->assertLinkByHref('examples/eventdispatcher_example');
  }

  /**
   * Tests eventdispatcher_example menus.
   */
  public function testEventDispatcherExampleMenu() {
    $this->drupalGet('examples/eventdispatcher_example');
    $this->assertResponse(200, 'Description page exists.');
  }

}
