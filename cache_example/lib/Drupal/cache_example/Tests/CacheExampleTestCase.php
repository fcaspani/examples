<?php

/**
 * @file
 * Test case for testing the cache example module.
 */

/**
 * @addtogroup cache_example
 * @{
 */

namespace Drupal\cache_example\Tests;

use Drupal\simpletest\WebTestBase;

class CacheExampleTestCase extends WebTestBase {

  public static $modules = array('cache_example');

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => 'Cache example functionality',
      'description' => 'Test the Cache Example module.',
      'group' => 'Examples',
    );
  }

  /**
   * Load cache example page and test if displaying uncached version.
   *
   * Reload once again and test if displaying cached version. Find reload link
   * and click on it. Clear cache at the end and test if displaying uncached
   * version again.
   */
  public function testCacheExampleBasic() {
    // We need administrative privileges to clear the cache.
    $admin_user = $this->drupalCreateUser(array('administer site configuration'));
    $this->drupalLogin($admin_user);

    // Get uncached output of cache example page and assert some things to be
    // sure.
    $this->drupalGet('examples/cache_example');
    $this->assertText('Source: actual file search');
    // Reload the page; the number should be cached.
    $this->drupalGet('examples/cache_example');
    $this->assertText('Source: cached');

    // Now push the button to remove the count.
    $this->drupalPostForm('examples/cache_example', array(), t('Explicitly remove cached file count'));
    $this->assertText('Source: actual file search');

    // Create a cached item. First make sure it doesn't already exist.
    $this->assertText('Cache item does not exist');
    $this->drupalPostForm('examples/cache_example', array('expiration' => -10), t('Create a cache item with this expiration'));
    // We should now have an already-expired item.
    $this->assertText('Cache item exists and is set to expire');
    // Now do the expiration operation.
    $this->drupalPostForm('examples/cache_example', array('cache_clear_type' => 'expire'), t('Clear or expire cache'));
    // And verify that it was removed.
    $this->assertText('Cache item does not exist');

    // Create a cached item. This time we'll make it not expire.
    $this->drupalPostForm('examples/cache_example', array('expiration' => 'never_remove'), t('Create a cache item with this expiration'));
    // We should now have an never-remove item.
    $this->assertText('Cache item exists and is set to expire at Never expires');
    // Now do the expiration operation.
    $this->drupalPostForm('examples/cache_example', array('cache_clear_type' => 'expire'), t('Clear or expire cache'));
    // And verify that it was not removed.
    $this->assertText('Cache item exists and is set to expire at Never expires');
    // Now do full removal.
    $this->drupalPostForm('examples/cache_example', array('cache_clear_type' => 'remove_tag'), t('Clear or expire cache'));
    // And verify that it was removed.
    $this->assertText('Cache item does not exist');
  }

}
