<?php

namespace Drupal\servicecontainer_example\Classes;

use Drupal\Core\Mail\Plugin\Mail\PhpMail;

class Newsletter extends PhpMail {

  protected $recipients;

  /**
   * Set array of recipients.
   *
   * @param $recipients
   */
  public function setRecipients($recipients) {
    $this->recipients = $recipients;
  }

  /**
   * Return array of recipients.
   *
   * @return mixed
   */
  public function getRecipients() {
    return $this->recipients;
  }

  /**
   * Send mail to every recipient.
   *
   */
  public function sendNewsletter($subject, $message) {
    foreach ($this->recipients as $recipient) {
      mail($recipient, $subject, $message, NULL, NULL);
    }
  }

}

?>

